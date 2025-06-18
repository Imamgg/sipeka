<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginRequest
 *
 * Handles authentication requests with comprehensive error handling for various scenarios:
 *
 * LOGIN FORMATS SUPPORTED:
 * - Email: standard email format validation
 * - NIS: numeric, minimum 4 digits (for students)
 * - NIP: numeric, minimum 10 digits (for teachers/staff)
 *
 * ERROR SCENARIOS HANDLED:
 * 1. Validation Errors:
 *    - Empty login/password fields
 *    - Invalid email format
 *    - Invalid NIS/NIP format
 *    - Password too short (< 6 characters)
 *
 * 2. Authentication Errors:
 *    - Email/NIS/NIP not found in system
 *    - Incorrect password
 *    - Account not linked to user (for students/teachers)
 *
 * 3. Account Status Errors:
 *    - Unverified email (if verification required)
 *    - Inactive/suspended account
 *    - Insufficient role/permissions
 *
 * 4. Rate Limiting:
 *    - Too many failed login attempts
 *    - Lockout period with clear countdown
 *
 * 5. System Errors:
 *    - Database connection issues
 *    - Unexpected exceptions
 *
 * @package App\Http\Requests\Auth
 */

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Email, NIS, atau NIP harus diisi.',
            'login.string' => 'Email, NIS, atau NIP harus berupa teks.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa teks.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $login = $this->input('login');
        $password = $this->input('password');

        // Validate password length
        if (strlen($password) < 6) {
            throw ValidationException::withMessages([
                'password' => 'Password harus minimal 6 karakter.',
            ]);
        }

        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($login) ?
            (strlen($login) >= 10 ? 'nip' : 'nis') : 'email');

        $credentials = ['password' => $password];
        $authenticated = false;
        $errorMessage = '';

        try {
            switch ($loginType) {
                case 'email':
                    // Validate email format
                    if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
                        $errorMessage = 'Format email tidak valid.';
                        break;
                    }

                    $user = \App\Models\User::where('email', $login)->first();
                    if (!$user) {
                        $errorMessage = 'Email tidak terdaftar dalam sistem.';
                        break;
                    }

                    // Check user status
                    $statusError = $this->validateUserStatus($user);
                    if ($statusError) {
                        $errorMessage = $statusError;
                        break;
                    }

                    $credentials['email'] = $login;
                    $authenticated = Auth::attempt($credentials, $this->boolean('remember'));

                    if (!$authenticated) {
                        $errorMessage = 'Password yang Anda masukkan salah.';
                    }
                    break;

                case 'nis':
                    // Validate NIS format (should be numeric and appropriate length)
                    if (!is_numeric($login) || strlen($login) < 4) {
                        $errorMessage = 'Format NIS tidak valid. NIS harus berupa angka minimal 4 digit.';
                        break;
                    }

                    $student = \App\Models\Student::where('nis', $login)->first();
                    if (!$student) {
                        $errorMessage = 'NIS tidak terdaftar dalam sistem.';
                    } elseif (!$student->user) {
                        $errorMessage = 'Akun siswa belum dikaitkan dengan user. Hubungi administrator.';
                    } else {
                        // Check user status
                        $statusError = $this->validateUserStatus($student->user);
                        if ($statusError) {
                            $errorMessage = $statusError;
                            break;
                        }

                        $credentials['email'] = $student->user->email;
                        $authenticated = Auth::attempt($credentials, $this->boolean('remember'));

                        if (!$authenticated) {
                            $errorMessage = 'Password yang Anda masukkan salah.';
                        }
                    }
                    break;

                case 'nip':
                    // Validate NIP format (should be numeric and appropriate length)
                    if (!is_numeric($login) || strlen($login) < 10) {
                        $errorMessage = 'Format NIP tidak valid. NIP harus berupa angka minimal 10 digit.';
                        break;
                    }

                    $teacher = \App\Models\Teacher::where('nip', $login)->first();
                    if (!$teacher) {
                        $errorMessage = 'NIP tidak terdaftar dalam sistem.';
                    } elseif (!$teacher->user) {
                        $errorMessage = 'Akun guru belum dikaitkan dengan user. Hubungi administrator.';
                    } else {
                        // Check user status
                        $statusError = $this->validateUserStatus($teacher->user);
                        if ($statusError) {
                            $errorMessage = $statusError;
                            break;
                        }

                        $credentials['email'] = $teacher->user->email;
                        $authenticated = Auth::attempt($credentials, $this->boolean('remember'));

                        if (!$authenticated) {
                            $errorMessage = 'Password yang Anda masukkan salah.';
                        }
                    }
                    break;

                default:
                    $errorMessage = 'Format login tidak dikenali. Gunakan email, NIS, atau NIP.';
            }
        } catch (\Exception $e) {
            $errorMessage = 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.';
        }

        if (!$authenticated) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => $errorMessage ?: 'Kombinasi login dan password tidak cocok.',
            ]);
        }

        // Additional user status validation
        $user = $this->getUserByLogin($login, $loginType);
        $statusError = $this->validateUserStatus($user);
        if ($statusError) {
            throw ValidationException::withMessages([
                'login' => $statusError,
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' .
                ceil($seconds / 60) . ' menit.',
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
    }

    /**
     * Check if user account is active and accessible.
     *
     * @param \App\Models\User $user
     * @return string|null Error message if user cannot login, null if user is valid
     */
    private function validateUserStatus($user): ?string
    {
        if (!$user) {
            return null;
        }

        // Check if user has email_verified_at (if email verification is required)
        if (is_null($user->email_verified_at) && config('auth.must_verify_email', false)) {
            return 'Akun Anda belum diverifikasi. Silakan cek email untuk link verifikasi.';
        }

        // Check if user account is suspended/inactive (if you have status field)
        if (method_exists($user, 'isActive') && !$user->isActive()) {
            return 'Akun Anda telah dinonaktifkan. Hubungi administrator untuk informasi lebih lanjut.';
        }

        // Check if user has necessary role/permissions
        if (method_exists($user, 'hasRole')) {
            $allowedRoles = ['admin', 'teacher', 'student'];
            $hasValidRole = false;

            foreach ($allowedRoles as $role) {
                if ($user->hasRole($role)) {
                    $hasValidRole = true;
                    break;
                }
            }

            if (!$hasValidRole) {
                return 'Akun Anda tidak memiliki akses ke sistem ini.';
            }
        }

        return null;
    }

    /**
     * Get user by login credentials for additional checks.
     *
     * @param string $login
     * @param string $loginType
     * @return \App\Models\User|null
     */
    private function getUserByLogin(string $login, string $loginType): ?\App\Models\User
    {
        switch ($loginType) {
            case 'email':
                return \App\Models\User::where('email', $login)->first();

            case 'nis':
                $student = \App\Models\Student::where('nis', $login)->first();
                return $student ? $student->user : null;

            case 'nip':
                $teacher = \App\Models\Teacher::where('nip', $login)->first();
                return $teacher ? $teacher->user : null;

            default:
                return null;
        }
    }
}
