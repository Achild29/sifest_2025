<?php

namespace App\Livewire\Siswa;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class TableKehadiran extends Component
{
    public $bulan, $absensi, $student;
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
    
    public function sendData($url_path) {
        $data = [
            'bulan' => $this->bulan,
            'studentId' => $this->student->id,
            'jumlahKehadiran' => $this->jumlahKehadiran
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

        // return redirect()->route('testing-pdf', ['data' => $data]);
    }
}
