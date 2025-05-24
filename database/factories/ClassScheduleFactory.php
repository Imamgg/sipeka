<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Subjects;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassScheduleFactory extends Factory
{
  public function definition(): array
  {
    // Days of the week for scheduling
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    // Semesters
    $semesters = ['Odd', 'Even'];

    // Generate a random start time between 7:00 and 16:00
    $startHour = fake()->numberBetween(7, 16);
    $startMinute = fake()->randomElement([0, 15, 30, 45]);
    $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);

    // End time is 1-2 hours after start time
    $durationHours = fake()->randomElement([1, 1.5, 2]);
    $endHour = $startHour + floor($durationHours);
    $endMinute = ($startMinute + ($durationHours - floor($durationHours)) * 60) % 60;

    // If we roll over to the next hour
    if ($endMinute < $startMinute) {
      $endHour++;
    }

    $endTime = sprintf('%02d:%02d:00', $endHour, $endMinute);

    return [
      'class_id' => Classes::factory(),
      'teacher_id' => Teacher::factory(),
      'subject_id' => Subjects::factory(),
      'day' => fake()->randomElement($days),
      'semester' => fake()->randomElement($semesters),
      'start_time' => $startTime,
      'end_time' => $endTime,
    ];
  }
}
