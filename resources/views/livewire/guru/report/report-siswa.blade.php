@php
    use Carbon\Carbon;
    use App\Enums\StatusAbsensi;

    $Bulan = Carbon::createFromFormat('Y-m', $this->bulan)->format('M-Y');
@endphp
@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /><span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.laporan') }}">Laporan Absensi</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Laporan Absensi Siswa</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Laporan Absensi Siswa | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Laporan Absensi Siswa: 
        <span class="text-red-500">{{ $student->user->name }}</span>
    </flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can see an attendences of your student</flux:text>
    
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="sm:grid xl:grid-cols-3 gap-4 px-5 py-5 mb-16 sm:mb-5">
        <div class="w-full h-24 bg-zinc-100 dark:bg-zinc-800 rounded-2xl shadow-2xl p-2">
            <flux:input type="month" label="Bulan" wire:model.live="bulan" />
        </div>
        <div class="w-full h-24 col-span-2 mb-16 mt-2 sm:mt-0 sm:mb-0">
            <div class="py-5 sm:py-4 bg-zinc-50 dark:bg-zinc-800 rounded-2xl shadow-2xl">
                <div class="mx-auto max-w-7xl lg:px-5">
                    <dl class="grid grid-cols-1 gap-x-5 gap-y-5 text-center lg:grid-cols-2">
                        <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-3xl">{{ $student->user->name }}</dd>
                            <dt class="text-base/7 text-gray-600 dark:text-white">{{ $student->nisn }} @ {{ $student->classRoom->name }}</dt>
                        </div>
                        <flux:tooltip content="Download laporan untuk '{{ $student->user->name }}'">
                            <button class="mx-auto flex max-w-xs flex-col gap-y-2 cursor-pointer 
                            border w-fit rounded-2xl py-[6px] px-3.5 transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400
                            " wire:click="sendData('download-pdf')">
                                <dt class="text-base/7 font-bold text-white flex gap-2 self-center">
                                    <flux:icon.pdf />
                                    export to pdf
                                </dt>
                                <dt class="text-base/7 font-bold text-white">Laporan Siswa: <span class="text-red-500">{{ $student->user->name }}</span></dt>
                            </button>
                        </flux:tooltip> 
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex justify-center mb-2">
        <flux:heading size="xl" class="font-extrabold" level="1">
            Daftar Kehadiran <span class="text-red-500">{{ $student->user->name }}</span> | 
            di bulan <span class="text-red-500">{{ $Bulan }}</span>
        </flux:heading>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Tanggal</th>
                  <th class="border px-4 py-2">status</th>
                  <th class="border px-4 py-2 whitespace-pre">Keterangan</th>
                </tr>
                </thead>
                <tbody class="text-lg">
                    @for ($i = 1; $i <= 31; $i++)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $i }}</td>
                            <td class="border px-4 py-2 text-center">{{ sprintf('%02d', $i).'-'.$Bulan }}</td>
                            @if ($absensi && $absensi->isNotEmpty())
                                @foreach ($absensi as $item)
                                    @if ($item->tanggal === $bulan.'-'.sprintf('%02d', $i))
                                        <td class="border px-4 py-2 text-center">
                                            {{ Str::substr(Str::upper($item->status), 0, 1) }}
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            {{ $item->message }}
                                        </td>
                                    @endif
                                @endforeach
                            @endif
                        </tr>
                    @endfor
                    <tr>
                        <td rowspan="5" colspan="2" class="border px-4 py-2 text-center text-2xl" >Jumlah Kehadiran</td>
                        <td class="border px-4 py-2 bg-green-200 dark:bg-green-800">Hadir</td>
                        <td class="border px-4 py-2 text-center bg-green-200 dark:bg-green-800">{{ $jumlahKehadiran['h'] }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-cyan-200 dark:bg-cyan-800">Izin</td>
                        <td class="border px-4 py-2 bg-cyan-200 text-center dark:bg-cyan-800">{{ $jumlahKehadiran['i'] }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-amber-200 dark:bg-amber-600">Sakit</td>
                        <td class="border px-4 py-2 bg-amber-200 text-center dark:bg-amber-600">{{ $jumlahKehadiran['s'] }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-red-200 dark:bg-red-800">Alpha</td>
                        <td class="border px-4 py-2 bg-red-200 text-center dark:bg-red-800">{{ $jumlahKehadiran['a'] }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 ">Others</td>
                        <td class="border px-4 py-2 text-center">{{ $jumlahKehadiran['o'] }}</td>
                    </tr>
                </tbody> 
        </table>
    </div>
</div>
