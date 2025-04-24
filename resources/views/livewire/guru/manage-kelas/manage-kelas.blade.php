@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> Home
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Kelas</flux:breadcrumbs.item>
    </flux:breadcrumbs>
@endsection

<div>
    <x-slot:title>Aplikasi Absensi | Manage Kelas | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Manage Kelas</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage your class</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <flux:modal.trigger name="add-kelas">
        <div class="flex justify-end mb-2">
            <flux:tooltip content="tambahkan kelas" position="bottom">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl"
                >
                    <flux:icon.plus-circle variant="solid"/>
                    add kelas
                </button>
            </flux:tooltip>
        </div>
    </flux:modal.trigger>
    {{-- edit This --}}
    <livewire:guru.manage-kelas.manage-kelas-modal />

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
                                    <flux:tooltip content="Detail Kelas: {{ $kelas->name }}">
                                    <a href="{{ route('detail.kelas', $kelas->id) }}">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        >
                                            <flux:icon.arrow-top-right-on-square/>
                                            detail
                                        </button>
                                    </a>
                                    </flux:tooltip>

                                    <flux:tooltip content="Delete kelas: {{ $kelas->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="showConfirmDelete({{ $kelas->id }})"
                                        >
                                            <flux:icon.trash />
                                            Delete
                                        </button>
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
</div>
