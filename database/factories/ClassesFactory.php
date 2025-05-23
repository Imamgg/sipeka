<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
  public function definition(): array
  {
    $level = fake()->randomElement([10, 11, 12]);
    $major = fake()->randomElement(['IPA', 'IPS']);
    $number = fake()->numberBetween(1, 3);

    return [
      'class_name' => ($level === 10 ? 'X' : ($level === 11 ? 'XI' : 'XII')) . ' ' .
        $major . ' ' . $number,
      'level' => $level,
      'major' => $major,
      'academic_year' => '2024/2025',
    ];
  }
}
