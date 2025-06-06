<x-mail::message>
# Notifikasi Ketidakhadiran

Halo **{{ $user->name }}**,

Kami ingin memberitahukan bahwa **{{ $student->user->name }}** tercatat **tidak hadir** pada pertemuan berikut:

**Mata Pelajaran:** {{ $presence->subject->subject_name }}  
**Kelas:** {{ $presence->classes->class_name }}  
**Tanggal:** {{ \Carbon\Carbon::parse($presence->date)->format('d F Y') }}  
**Waktu:** {{ $presence->start_time }} - {{ $presence->end_time }}  
**Topik:** {{ $presence->topic }}

Mohon untuk melakukan konfirmasi mengenai ketidakhadiran ini dengan menghubungi guru yang bersangkutan.

<x-mail::button :url="$url">
Lihat Rekap Absensi
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
