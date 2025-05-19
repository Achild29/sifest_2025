@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Jadwal</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Manage Kelas | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection
@php
    use App\Models\Schedule;
@endphp
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Manage Jadwal</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage schedule to your class</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>
    
    <div class="w-72"
        x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }"
    >
        <flux:input 
        icon="magnifying-glass"
        label="Cari"
        description="keywords pencarian: Nama kelas"
        wire:model.live="search"
        placeholder="Search..."
        @focus="focusSearch()"
        @blur="searchFocused = false"
        />
    </div>
    @if ($classRooms && $classRooms->isNotEmpty())
            <div class="text-center">
                <flux:heading size="xl" class="font-black mb-5" level="1">Daftar Kelas yg anda memiliki</flux:heading>
            </div>
        
        <div class="overflow-x-auto border rounded-lg shadow-2xl">
            <table class="min-w-full table-auto border">
                <thead class="bg-zinc-100 dark:bg-zinc-800">
                    <tr class="text-lg">
                    <th class="w-4 px-4 py-2 border ">No.</th>
                    <th class="border px-4 py-2 whitespace-pre">Nama</th>
                    <th class="border px-4 py-2 whitespace-pre">Jumlah Murid</th>
                    <th class="border px-4 py-2 whitespace-pre">Jumlah Jadwal</th>
                    <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                    </tr>
                </thead>
                <tbody class="text-lg">
                    @foreach ($classRooms as $kelas)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $kelas->name }}</td>
                            <td class="border px-4 py-2 text-center"> {{ $kelas->students->count() . " Siswa"}} </td>
                            <td class="border px-4 py-2 text-center">
                                @php
                                    $jadwalKelas = Schedule::where('kelas_id', $kelas->id)
                                        ->where('teacher_id', $guru->id)
                                        ->get();
                                @endphp
                                @if ($jadwalKelas && $jadwalKelas->isNotEmpty())
                                    {{ $jadwalKelas->count() }} 
                                @else
                                    <span class="text-red-500 italic" >Belum ada jadwal</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Lihat semua jadwal di kelas: {{ $kelas->name }}">
                                        <flux:button variant="primary" icon='arrow-up-right' wire:click='detailJadwal({{$kelas->id}})'
                                        class="focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        >Lihat Jadwal</flux:button>
                                    </flux:tooltip>
                                    <flux:tooltip content="Buat jadwal untuk kelas: {{ $kelas->name }}">
                                        <flux:button variant="primary" icon='plus' wire:click='addJadwal({{$kelas->id}})'
                                        class="focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 bg-emerald-500 hover:bg-emerald-700">
                                            Buat Jadwal
                                        </flux:button>
                                    </flux:tooltip>
                                </div>
                            </td>
                        </tr>
                    @endforeach                  
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            <flux:button class="
            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
            bg-indigo-500 hover:bg-indigo-700
            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400
            " variant="primary"
            icon="arrow-up-left"
            wire:click='gotoManageKelas'
            >
                Manage Kelas
            </flux:button>
        </div>
        <div class="grid my-auto mt-24 items-center text-center bg-rose-100 lg:h-[550px] h-96 rounded-2xl shadow-2xl">
            <flux:heading size="xl" class="font-extrabold text-red-500" level="1">
                Anda belum memiliki Kelas <br>
                Silahkan Membuat kelas terlebih dahulu
            </flux:heading>
        </div>
    @endif

    <flux:modal name="addJadwal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add schedule</flux:heading>
                <flux:text class="mt-2">Anda akan menambahkan Jadwal pada kelas</flux:text>
            </div>
            <flux:input label="Kelas" wire:model='name' disabled readonly />
            <flux:input label="Date of birth" wire:model='tanggal' type="date" />
            <flux:select wire:model.live="kegiatan" label='Kegiatan'>
                <flux:select.option selected>Online/Offline</flux:select.option>
                <flux:select.option value="online">Online</flux:select.option>
                <flux:select.option value="offline">Offline</flux:select.option>
            </flux:select>
            <flux:input label="Link" wire:key="{{$kegiatan}}" wire:model='link' 
            description="boleh dikosongkan jika offline"
            placeholder="https://meet.google.com/tgi-urmt-guh"/>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click='storeJadwal'>Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
