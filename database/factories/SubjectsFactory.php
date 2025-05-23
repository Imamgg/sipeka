<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectsFactory extends Factory
{
  public function definition(): array
  {
    return [
      'code_subject' => fake()->unique()->numerify('SUBJ-####'),
      'subject_name' => fake()->word(),
      'description' => fake()->sentence(),
    ];
  }
}
