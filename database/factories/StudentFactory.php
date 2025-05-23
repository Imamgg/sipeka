<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
  public function definition(): array
  {
    $gender = fake()->randomElement(['M', 'F']);

    return [
      'user_id' => User::factory()->create(['role' => 'student'])->id,
      'class_id' => Classes::factory(),
      'nis' => fake()->unique()->numerify('2023####'),
      'nisn' => fake()->unique()->numerify('00########'),
      'place_of_birth' => fake()->city(),
      'date_of_birth' => fake()->dateTimeBetween('-20 years', '-10 years'),
      'gender' => $gender,
      'address' => fake()->address(),
      'father_name' => fake()->name('male'),
      'mother_name' => fake()->name('female'),
    ];
  }
}
