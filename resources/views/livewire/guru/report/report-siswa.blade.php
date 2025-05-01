@php
    use Carbon\Carbon;
    use App\Enums\StatusAbsensi;

    $Bulan = Carbon::createFromFormat('Y-m', $this->bulan)->format('M-Y');
    $h = 0;
    $izin = 0;
    $s = 0;
    $a = 0;
    $o = 0;
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
                        <div class="mx-auto flex max-w-xs flex-col gap-y-2 sm:mt-2">
                            <a href="">
                                <dt class="text-base/7 text-gray-600 dark:text-white">export to pdf</dt>
                                <dt class="text-base/7 text-gray-600 dark:text-white">Laporan Siswa: {{ $student->user->name }}</dt>
                            </a>
                        </div>                        
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
                                        @if ($item->status === StatusAbsensi::hadir->value )
                                            @php
                                                $h++;
                                            @endphp
                                        @endif
                                        @if ($item->status === StatusAbsensi::izin->value )
                                            @php
                                                $izin++;
                                            @endphp
                                        @endif
                                        @if ($item->status === StatusAbsensi::alpha->value )
                                            @php
                                                $a++;
                                            @endphp
                                        @endif
                                        @if ($item->status === StatusAbsensi::sakit->value )
                                            @php
                                                $s++;
                                            @endphp
                                        @endif
                                        @if ($item->status === StatusAbsensi::others->value )
                                            @php
                                                $o++;
                                            @endphp
                                        @endif
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
                        <td class="border px-4 py-2 text-center bg-green-200 dark:bg-green-800">{{ $h }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-cyan-200 dark:bg-cyan-800">Izin</td>
                        <td class="border px-4 py-2 bg-cyan-200 text-center dark:bg-cyan-800">{{ $izin }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-amber-200 dark:bg-amber-600">Sakit</td>
                        <td class="border px-4 py-2 bg-amber-200 text-center dark:bg-amber-600">{{ $s }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 bg-red-200 dark:bg-red-800">Alpha</td>
                        <td class="border px-4 py-2 bg-red-200 text-center dark:bg-red-800">{{ $a }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2 ">Others</td>
                        <td class="border px-4 py-2 text-center">{{ $o }}</td>
                    </tr>
                </tbody> 
        </table>
    </div>
</div>
