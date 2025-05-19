@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Absensi</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection

<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Absensi</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage an attendace of your students</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    @if ($ClassRooms && $ClassRooms->isNotEmpty())
        <div class="flex justify-center mb-2">
            <flux:heading size="xl" class="font-extrabold" level="1">Daftar Kelas yg anda memiliki</flux:heading>
        </div>

        <div class="overflow-x-auto border rounded-lg shadow-2xl">
            <table class="min-w-full table-auto border">
                <thead class="bg-zinc-100 dark:bg-zinc-800">
                    <tr class="text-lg">
                    <th class="w-4 px-4 py-2 border ">No.</th>
                    <th class="border px-4 py-2 whitespace-pre">Nama</th>
                    <th class="border px-4 py-2 whitespace-pre">Jumlah Murid</th>
                    <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                    </tr>
                </thead>
                <tbody class="text-lg">
                    @if ($ClassRooms && $ClassRooms->isNotEmpty())
                        @foreach ($ClassRooms as $kelas)    
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $kelas->name }}</td>
                                <td class="border px-4 py-2 text-center"> {{ $kelas->students->count() . " Siswa"}} </td>
                                <td class="border px-4 py-2">
                                    <div class="flex gap-3 justify-evenly">
                                        <flux:tooltip content="lakukan absensi: {{ $kelas->name }}">
                                            <a href="{{ route('guru.absensi.kelas', $kelas->id) }}">
                                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                                bg-indigo-500 hover:bg-indigo-700
                                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                                >
                                                    <flux:icon.clipboard-document-list/>
                                                    Absensi
                                                </button>
                                            </a>
                                        </flux:tooltip>
                                    </div>
                                </td>
                            </tr>
                        @endforeach                  
                    @else
                        <tr class="">
                            <td colspan="2" class="px-4 py-2 text-right text-red-500 font-semibold italic">Belum ada data </td>
                        </tr>                    
                    @endif

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
    
</div>
