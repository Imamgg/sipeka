<?php

namespace App\View\Components;

use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminUpcomingSchedule extends Component
{
  public $todaySchedules;
  public $tomorrowSchedules;
  public $daysTranslation;

  /**
   * Create a new component instance.
   */
  public function __construct()
  {
    // Ambil hari ini dan besok dalam format hari bahasa Inggris
    $today = Carbon::now()->format('l'); // Contoh: "Monday"
    $tomorrow = Carbon::now()->addDay()->format('l'); // Contoh: "Tuesday"

    // Ambil semua jadwal untuk hari ini, urutkan berdasarkan waktu mulai
    $this->todaySchedules = ClassSchedule::with(['class', 'teacher.user', 'subject'])
      ->where('day', $today)
      ->orderBy('start_time')
      ->limit(3)
      ->get();

    // Ambil semua jadwal untuk besok, urutkan berdasarkan waktu mulai
    $this->tomorrowSchedules = ClassSchedule::with(['class', 'teacher.user', 'subject'])
      ->where('day', $tomorrow)
      ->orderBy('start_time')
      ->limit(3)
      ->get();

    // Terjemahan untuk nama hari
    $this->daysTranslation = [
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu',
      'Sunday' => 'Minggu',
    ];
  }
  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View
  {
    return view('components.admin-upcoming-schedule', [
      'todaySchedules' => $this->todaySchedules,
      'tomorrowSchedules' => $this->tomorrowSchedules,
      'daysTranslation' => $this->daysTranslation
    ]);
  }
}
