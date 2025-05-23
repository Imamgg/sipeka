<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
  public function definition(): array
  {
    $gender = fake()->randomElement(['M', 'F']);

    return [
      'user_id' => User::factory()->create(['role' => 'teacher'])->id,
      'nip' => fake()->unique()->numerify('19########' . fake()->numberBetween(1, 2) . '####'),
      'place_of_birth' => fake()->city(),
      'date_of_birth' => fake()->dateTimeBetween('-50 years', '-25 years'),
      'gender' => $gender,
      'address' => fake()->address(),
      'phone_number' => fake()->phoneNumber()
    ];
  }
}
