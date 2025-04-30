<?php

namespace App\Livewire\Guru\Report;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\ClassRoom;
use Livewire\Attributes\On;
use Livewire\Component;

class ReportKelas extends Component
{
    public $bulan, $kelasId, $absensi, $kelas, $hadir;

    public function mount($id) {
        $this->bulan = now()->format('Y-m');
        $this->kelas = ClassRoom::find($id);
        $this->kelasId = $id;
    }

    public function render()
    {
        $this->dispatch('show-table');
        return view('livewire.guru.report.report-kelas');
    }
    
    
    #[On('show-table')]
    public function showTable() {
        $this->absensi = Attendance::where('class_room_id', $this->kelasId)
            ->whereAll(['tanggal'], 'like', $this->bulan.'%')
            ->get();
    }
}
