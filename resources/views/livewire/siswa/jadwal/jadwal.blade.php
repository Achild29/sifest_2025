@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('siswa.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Jadwal</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Manage Kelas | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Jadwal</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you see your schedule for your class</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="w-72">
        <flux:input type="month" label="Bulan" wire:model.live="bulan" />
    </div>
    @if ($schedules && $schedules->isNotEmpty())
        <div class="grid lg:grid-cols-2 gap-2 my-10">
            <div class="grid col-span-2">
                <div class="text-center">
                    <flux:heading size="xl" class="font-extrabold" level="1">Jadwal Kelas<br>
                        {{ $kelas->name }}
                    </flux:heading>
                </div>
                <div class="grid justify-end">
                    @php
                        $jadwal = [
                            'data' => [
                                'kelasId' => $kelasId,
                                'teacherId' => $guruId,
                                'bulan' => $this->bulan
                            ]
                        ];
                        $data = json_encode($jadwal, true);
                        // $data = $jadwal;
                    @endphp
                    <flux:tooltip content="Download jadwal" position="bottom">
                        <form action="{{ route('jadwal.pdf') }}" method="post">
                            @csrf
                            <input type="hidden" name="data" value="{{ $data }}">
                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                            bg-emerald-500 hover:bg-emerald-700 shadow-xl" wire:key($bulan) type="submit">
                                <flux:icon.pdf />
                                download PDF
                            </button>
                        </form>
                    </flux:tooltip>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto border rounded-lg shadow-2xl">
            <table class="min-w-full table-auto border">
                <thead class="bg-zinc-100 dark:bg-zinc-800">
                    <tr class="text-lg">
                    <th class="w-4 px-4 py-2 border ">No.</th>
                    <th class="border px-4 py-2 whitespace-pre">Tanggal</th>
                    <th class="border px-4 py-2 whitespace-pre">Kegiatan</th>
                    <th class="border px-4 py-2 whitespace-pre">link</th>
                    </tr>
                </thead>
                <tbody class="text-lg">
                    @foreach ($schedules as $item)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $item->tanggal }}</td>
                            <td class="border px-4 py-2 text-center"> {{ $item->kegiatan }} </td>
                            <td class="border px-4 py-2 text-center"> {{ $item->link }} </td>
                            
                        </tr>
                    @endforeach                  
                </tbody>
            </table>
        </div>
    @else
        <div class="grid my-auto mt-24 items-center text-center bg-rose-100 lg:h-[550px] h-96 rounded-2xl shadow-2xl">
            <flux:heading size="xl" class="font-extrabold text-red-500" level="1">Anda belum memiliki jadwal</flux:heading>
        </div>
    @endif

</div>
