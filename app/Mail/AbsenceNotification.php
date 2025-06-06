<?php

namespace App\Mail;

use App\Models\Presence;
use App\Models\Student;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $presence;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student, Presence $presence, User $user)
    {
        $this->student = $student;
        $this->presence = $presence;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Ketidakhadiran - ' . $this->presence->subject->subject_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.absence-notification',
            with: [
                'student' => $this->student,
                'presence' => $this->presence,
                'user' => $this->user,
                'url' => route('student.attendances.index')
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
