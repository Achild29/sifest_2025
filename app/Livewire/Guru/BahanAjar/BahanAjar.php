<?php

namespace App\Livewire\Guru\BahanAjar;

use App\Models\ClassRoom;
use App\Models\Modul;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class BahanAjar extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination;

    public $search = '';
    public $kelas, $selectedClass, $namaModul, $modul;
    public $modulId, $kelasSelected, $kelasBaru, $kelasSelectedId, $kelasSelectedBaru;

    public function render()
    {
        $data = Modul::where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('classRoom', function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })->paginate(3);
        return view('livewire.guru.bahan-ajar.bahan-ajar', [
            'moduls' => $data,
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function mount() {
        $this->kelas = ClassRoom::where('teacher_id', Auth::user()->teacher->id)->get();
    }

    public function addModul() {
        $this->validate([
            'namaModul' => 'required',
            'selectedClass' => 'required',
            'modul' => [
                'required',
                'mimes:pdf,doc,docx,ppt,pptx',
                'max:10240'
            ]
        ],[
            'namaModul.requied' => 'Nama Modul tidak boleh Kosong',
            'selectedClass.required' => 'Kelas Tidak Boleh Kosong',
            'modul.required' => 'Pilih Modul yg akan di upload',
            'modul.mimes' => 'Format Modul tidak valid',
            'modul.max' => 'Ukuran maximal modul adalah 10MB'
        ]);
        $nameFile = now()->timestamp . '-' . Str::replace(' ', '_', $this->namaModul) .'.'. $this->modul->extension();
        $this->modul->storePubliclyAs('assets/modul', $nameFile, 'public');
        $filePath = 'assets/modul/' . $nameFile;
        if (Storage::disk('public')->exists($filePath)) {
            DB::beginTransaction();
            try {
                Modul::create([
                    'name' => $this->namaModul,
                    'modul_path' => $nameFile,
                    'extension' => $this->modul->extension(),
                    'teacher_id' => Auth::user()->teacher->id,
                    'class_room_id' => $this->selectedClass
                ]);
                DB::commit();
                return redirect()->route('bahan.ajar')->success('Berhasil menambahkan Modul Baru');
            } catch (\Exception $e) {
                DB::rollBack();
                Toaster::error('Gagal menambahkan modul: '.$e->getMessage());
            }
        }
    }

    public function showEdit($id) {
        $modul = Modul::find($id);
        $this->namaModul = $modul->name;
        $this->kelasSelectedId = ClassRoom::find($modul->classRoom->id);
        $this->kelasBaru = ClassRoom::where('id', '!=', $modul->classRoom->id)->get();
        $this->modulId = $id;
        Flux::modal('edit-modul')->show();
    }

    public function editModul() {
        $modul = Modul::find($this->modulId);
        $judul = $this->namaModul;
        $kelas = $this->selectedClass;
        $file = $this->modul;
        
        DB::beginTransaction();
        try {
            if (!is_null($judul)) $modul->name = $judul;
            if (!is_null($kelas)) $modul->class_room_id = $kelas;
            if (!is_null($file)) {
                $this->validate([
                    'modul' => [
                        'mimes:pdf,doc,docx,ppt,pptx',
                        'max:10240'
                    ]
                ],[
                'modul.mimes' => 'Format Modul tidak valid',
                'modul.max' => 'Ukuran maximal modul adalah 10MB' 
                ]);
                $oldFilePath = 'assets/modul/' . $modul->modul_path;
                if (Storage::disk('public')->exists($oldFilePath)) Storage::disk('public')->delete($oldFilePath);

                $newNameFile = now()->timestamp . '-' . Str::replace(' ', '_', $modul->name) .'.'. $file->extension();
                $file->storePubliclyAs('assets/modul', $newNameFile, 'public');
                $newFilePath = 'assets/modul/' . $newNameFile;
                if (Storage::disk('public')->exists($newFilePath)) {
                    $modul->modul_path = $newNameFile;
                    $modul->extension = $file->extension();
                } 
            }
            $modul->save();
            DB::commit();
            return redirect()->route('bahan.ajar')->success('Berhasil update data');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }

    public function showShare($id) {
        $modul = Modul::find($id);
        $this->modulId = $id;
        $this->kelasSelected = $modul->classRoom->name;
        $this->kelasBaru = ClassRoom::where('id', '!=', $modul->classRoom->id)->get();
        Flux::modal('share-modul')->show();
    }
    
    public function shareModul() {
        $modul = Modul::find($this->modulId);
        DB::beginTransaction();
        try {
            if (!is_null($this->kelasSelectedBaru)) {
                $c = count($this->kelasSelectedBaru);
                for ($i=0; $i < $c; $i++) { 
                    Modul::create([
                        'name' => $modul->name,
                        'modul_path' => $modul->modul_path,
                        'extension' => $modul->extension,
                        'teacher_id' => Auth::user()->teacher->id,
                        'class_room_id' => $this->kelasSelectedBaru[$i]
                    ]);
                    DB::commit();
                }
                return redirect()->route('bahan.ajar')->success('Berhasil share Modul ke '.$c.' kelas');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('eror:'.$e->getMessage());
        }
        
    }

    public function showDelete($id) {
        $this->modulId = $id;
        Flux::modal('delete-modul')->show();
    }

    public function deleteModul() {
        $modul = Modul::find($this->modulId);
        $pathFile = 'assets/modul/' . $modul->modul_path;
        if (Storage::disk('public')->exists($pathFile)) Storage::disk('public')->delete($pathFile);
        if (!Storage::disk('public')->exists($pathFile)) {
            DB::beginTransaction();
            try {
                $modul->delete();
                DB::commit();
                return redirect()->route('bahan.ajar')->warning('Berhasil Hapus Modul');
            } catch (\Exception $e) {
                DB::rollBack();
                Toaster::error('Gagal: '. $e->getMessage());
            }
        }
    }

    public function gotoManageKelas() {
        return redirect()->route('manage.kelas');
    }
}
