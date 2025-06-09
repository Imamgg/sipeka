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
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        $semesters = ['Odd', 'Even'];

        $startHour = fake()->numberBetween(7, 16);
        $startMinute = fake()->randomElement([0, 15, 30, 45]);
        $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);

        $durationHours = fake()->randomElement([1, 1.5, 2]);
        $endHour = $startHour + floor($durationHours);
        $endMinute = ($startMinute + ($durationHours - floor($durationHours)) * 60) % 60;

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
