@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;

    $Bulan = Carbon::createFromFormat('Y-m', $bulan)->format('M-Y');
@endphp
@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item >
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
@endsection
<div>
    <div class="grid grid-cols-3 xl:grid-cols-3 gap-4 px-4 py-4">
        <div class="w-full h-24 rounded-xl col-span-2">
            <flux:text class="font-semibold flex gap-2 text-xl lg:text-3xl">
                Status Kehadiran Hari Ini:
            </flux:text>
            <flux:text class="flex gap-2 text-lg lg:text-3xl justify-center">
                @if ($absenHariIni)
                    @if ($absenHariIni['status'] === 'hadir')
                        <span class="text-green-500">{{ Str::ucfirst($absenHariIni['status']) }}</span>
                    @endif
                    @if ($absenHariIni['status'] === 'izin')
                        <span class="text-cyan-500">{{ Str::ucfirst($absenHariIni['status']) }}</span>
                    @endif
                    @if ($absenHariIni['status'] === 'sakit')
                        {{ Str::ucfirst($absenHariIni['status']) }}
                    @endif
                    @if ($absenHariIni['status'] === 'alpha')
                        <span class="text-red-500">{{ Str::ucfirst($absenHariIni['status']) }}</span>
                    @endif
                    @if ($absenHariIni['status'] === 'others')
                        <span class="text-yellow-300">{{ $absenHariIni['message'] }}</span>
                    @endif
                @else
                    <span class="text-red-500">Belum Absen</span>
                @endif
            </flux:text>
        </div>
        <div class="w-full h-24 rounded-xl px-2 py-2">
            <flux:text class="font-semibold flex gap-2 lg:text-3xl">
                <flux:icon.calendar variant="solid" class="lg:size-10"/>
                {{ now()->format('d M Y') }}
            </flux:text>
            <flux:text class="font-semibold flex gap-2 lg:text-3xl">
                <flux:icon.clock variant="solid" class="lg:size-10"/>
                    {{ now()->format('H:i') }}
            </flux:text>
        </div>
    </div>

    @livewire('siswa.table-kehadiran', [
        'bulan' => $bulan, 
        'id' => $user->student->id
    ], key($bulan))
</div>
