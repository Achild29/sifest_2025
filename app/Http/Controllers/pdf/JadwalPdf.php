<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class JadwalPdf extends Controller
{
    public $jadwal, $kelas, $bulan, $name_file_LS;
    public function pdfDownload(Request $request) {
        $data = json_decode($request->data, true);
        $this->getData($data);
        $mpdf = new Mpdf();
        $html = view('pdf.PdfJadwal',[
            'schedules' => $this->jadwal,
            'kelas' => $this->kelas,
            'bulan' => $this->bulan
        ])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output($this->name_file_LS, 'I');
    }

    protected function getData($data) {
        $this->kelas = ClassRoom::find($data['data']['kelasId']);
        $this->bulan = $data['data']['bulan'] ?? Carbon::createFromFormat('Y-m', $data['data']['bulan'])->format('M-Y');
        $this->jadwal = Schedule::where('kelas_id', $data['data']['kelasId'])
        ->where('teacher_id', $data['data']['teacherId'])
        ->whereAny([
            'tanggal'
        ],  'like', '%'. $data['data']['bulan'] .'%')->get();
        $this->name_file_LS = 'Jadwal_'.str_replace(' ', '-', $this->kelas->name).'_'. $this->bulan;
    }
}
