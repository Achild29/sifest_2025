<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfLayout extends Controller
{
    public $bulan, $Bulan, $student, $jumlahKehadiran, $absensi, $name_file_LS;

    public function getDataSiswa(Request $request) {
        $this->bulan = $request->bulan;
        $this->Bulan = Carbon::createFromFormat('Y-m', $this->bulan)->format('M-Y');
        $studentId = $request->studentId;
        $this->student = Student::find($studentId);
        $this->jumlahKehadiran = $request->jumlahKehadiran;
        $this->absensi = Attendance::where('student_id', $this->student->id)
            ->whereAll(['tanggal'], 'like', $this->bulan.'%')
            ->get();
        $this->name_file_LS = 'Laporan_Absensi_'.str_replace(' ', '-', $this->student->user->name).'_'. $this->Bulan;
    }
    public function viewPdf(Request $request) {
        $this->getDataSiswa($request);
        $mpdf = new Mpdf();
        $html = view('pdf.PdfLayout',[
            'Bulan' => $this->Bulan,
            'bulan' => $this->bulan,
            'student' => $this->student,
            'jumlahKehadiran' => $this->jumlahKehadiran,
            'absensi' => $this->absensi
        ])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output($this->name_file_LS, 'I');
    } 

    public function downloadPdf(Request $request) {
        $this->getDataSiswa($request);
        $mpdf = new Mpdf();
        $html = view('pdf.PdfLayout',[
            'Bulan' => $this->Bulan,
            'bulan' => $this->bulan,
            'student' => $this->student,
            'jumlahKehadiran' => $this->jumlahKehadiran,
            'absensi' => $this->absensi
        ])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output($this->name_file_LS, 'D');
    }   

    public function downloadPdfLandscape(Request $request) {
        $bulan = $request->bulan;
        $Bulan = $request->Bulan;
        $kelasId = $request->kelasId;
        $kelas = ClassRoom::find($kelasId);
                
        $absensi = Attendance::where('class_room_id', $kelasId)
            ->whereAll(['tanggal'], 'like', $bulan.'%')
            ->get();
                    
        $mpdf = new Mpdf(['orientation' => 'L', 'format' => 'Legal']);
        $html = view('pdf.PdfLayoutLandscape', [
            'bulan' => $bulan,
            'Bulan' => $Bulan,
            'kelas' => $kelas,
            'absensi' => $absensi
        ]);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('testing', 'I');
    }
}
