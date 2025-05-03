<?php

namespace App\Livewire\Guru\Report;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\ClassRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function sendData($url_path) {
        $data = [
            'bulan' => $this->bulan,
            'Bulan' => Carbon::createFromFormat('Y-m', $this->bulan)->format('M-Y'),
            'kelasId' => $this->kelasId,
            'teacherId' => Auth::user()->teacher->id
        ];
        
        $url = route($url_path);
        $jsonData = json_encode($data);
        $csrfToken = csrf_token();

        $this->js("
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '$url';
            form.target = '_blank';
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '$csrfToken';
            form.appendChild(csrfInput);

            const data = JSON.parse('$jsonData');
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    if (typeof data[key] === 'object' && data[key] !== null) {
                        for (const subKey in data[key]) {
                            if (data[key].hasOwnProperty(subKey)) {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key + '[' + subKey + ']'; // Format array di PHP
                                input.value = data[key][subKey];
                                form.appendChild(input);
                            }
                        }
                    } else {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = data[key];
                        form.appendChild(input);
                    }
                }
            }

            document.body.appendChild(form);
            form.submit();
        ");
    }
}
