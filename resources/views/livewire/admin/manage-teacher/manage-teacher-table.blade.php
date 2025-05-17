<div class="mt-10">
    <div class="w-72 mb-5"
        x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }"
    >
        <flux:input 
        icon="magnifying-glass"
        label="Cari Siswa"
        description="keywords pencarian: Nama, Nisn dan Kelas"
        wire:model.live="search"
        placeholder="Search..."
        @focus="focusSearch()"
        @blur="searchFocused = false"
        />
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama</th>
                  <th class="border px-4 py-2 whitespace-pre">NIP</th>
                  <th class="border px-4 py-2 whitespace-pre">Email</th>
                  <th class="border px-4 py-2 whitespace-pre">Kelas</th>
                  <th class="border px-4 py-2 whitespace-pre">Alamat</th>
                  <th class="border px-4 py-2 whitespace-pre">No. Telp</th>
                  <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($teachers && $teachers->isNotEmpty())
                    @foreach ($teachers as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->teacher->nip }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">
                                @if ($user->teacher && $user->teacher->classRooms && $user->teacher->classRooms->count())
                                    {{ $user->teacher->classRooms->pluck('name')->implode(', ') }}
                                @else
                                    <em>Tidak memiliki kelas</em>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $user->teacher->alamat}}</td>
                            <td class="border px-4 py-2">{{ $user->teacher->no_telp}}</td>
                            
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Edit {{ $user->name }}'s account">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        wire:click="showEdit({{ $user->id }})">
                                            <flux:icon.pencil-square/>
                                            Edit
                                        </button>
                                    </flux:tooltip>
                                    <flux:tooltip content="Delete Teacher: {{ $user->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="showConfirmDelete({{ $user->id }})">
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
