<?php

namespace App\Livewire\Siswa;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class TableKehadiran extends Component
{
    public $bulan, $absensi, $student, $user;
    public array $jumlahKehadiran = [
        'h' => 0,
        'i' => 0,
        's' => 0,
        'a' => 0,
        'o' => 0,
    ];

    public function mount($bulan, $id) {
        $this->bulan = $bulan;
        $this->student = Student::find($id);
    }

    public function render()
    {
        $this->dispatch('load-table-kehadiran');
        return view('livewire.siswa.table-kehadiran');
    }

    #[On('load-table-kehadiran')]
    public function loadTable() {
        $this->absensi = Attendance::where('student_id', $this->student->id)
            ->whereAll(['tanggal'], 'like', $this->bulan.'%')
            ->get();

        $h = 0;
        $i = 0;
        $s = 0;
        $a = 0;
        $o = 0;

        if ($this->absensi) {
            foreach ($this->absensi as $item) {
                if ($item->status === StatusAbsensi::hadir->value) {
                    $h++;
                }
                if ($item->status === StatusAbsensi::alpha->value) {
                    $a++;
                }
                if ($item->status === StatusAbsensi::izin->value) {
                    $i++;
                }
                if ($item->status === StatusAbsensi::sakit->value) {
                    $s++;
                }
                if ($item->status === StatusAbsensi::others->value) {
                    $o++;
                }
            }
        }
        $this->jumlahKehadiran = [
            'h' => $h,
            'i' => $i,
            's' => $s,
            'a' => $a,
            'o' => $o,
        ];
    }
}
