<?php

namespace App\Livewire\Guru\Report;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Report extends Component
{
    public $classRooms, $selectedClass, $selectedStudent;

    public function render()
    {
        return view('livewire.guru.report.report');
    }

    public function mount() {
        $this->classRooms = ClassRoom::where('teacher_id', Auth::user()->teacher->id)
        ->get();
    }

    public function reportClass() {
        $this->validate([
            'selectedClass' => 'required'
        ],[
            'selectedClass.required' => 'Harap pilih kelas'
        ]);
        
        return redirect()->route('guru.laporan.kelas', $this->selectedClass);
    }

    public function reportStudent() {
        $this->validate([
            'selectedClass' => 'required',
            'selectedStudent' => 'required'
        ],[
            'selectedClass.required' => 'Harap pilih kelas',
            'selectedStudent.required' => 'Harap pilih siswa'
        ]);

        return redirect()->route('guru.laporan.siswa', $this->selectedStudent);
    }
}
