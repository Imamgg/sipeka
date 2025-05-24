<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'class' => $this->whenLoaded('class', function () {
        return [
          'id' => $this->class->id,
          'class_name' => $this->class->class_name
        ];
      }),
      'teacher' => $this->whenLoaded('teacher', function () {
        return [
          'id' => $this->teacher->id,
          'name' => $this->teacher->user->name ?? 'N/A'
        ];
      }),
      'subject' => $this->whenLoaded('subject', function () {
        return [
          'id' => $this->subject->id,
          'subject_name' => $this->subject->subject_name
        ];
      }),
      'day' => $this->day,
      'semester' => $this->semester,
      'start_time' => $this->start_time,
      'end_time' => $this->end_time,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
