<?php

namespace App\Livewire\Guru\Report;

use App\Models\Attendance;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class ReportSiswa extends Component
{
    public $student, $absensi, $bulan;
    
    public function mount($id) {
        $this->bulan = now()->format('Y-m');
        $this->student = Student::find($id);
    }

    public function render()
    {
        $this->dispatch('show-table-laporan');
        return view('livewire.guru.report.report-siswa');
    }

    #[On('show-table-laporan')]
    public function showTable() {
        $this->absensi = Attendance::where('class_room_id', $this->student->kelas_id)
        ->where('student_id', $this->student->id)
        ->whereAll(['tanggal'], 'like', $this->bulan.'%')
        ->get();
    }
}
