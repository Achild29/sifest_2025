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
    
    <div class="grid lg:grid-cols-3 gap-5 mb-5">
        @foreach ($teachers as $item)
            <div class="grid gap-2 p-2 rounded-2xl dark:bg-zinc-800 bg-zinc-100 shadow-lg">
                <div class="grid grid-cols-2">
                    <div class="flex justify-center p-5 h-64 rounded-2xl bg-amber-100">
                        <img src="{{ asset($profil_path = $item->profil_path ? 'storage/assets/profile_pictures/'.$item->profil_path : 'storage/assets/avatar.png') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain rounded-2xl shadow-xl">
                    </div>
                    <div>
                        <div class="p-4 w-full text-center col-span-2">
                            <flux:heading size="lg" class="font-bold" level="1"> {{ $item->name }} </flux:heading>
                        </div>
                        <div class="p-2 w-full row-span-2 col-span-2">
                            <flux:text>NIP: 
                                <span class="font-bold"> {{ $item->teacher->nip }} </span>
                            </flux:text>
                            <flux:text>Email: 
                                <span class="font-bold"> {{ $item->email }} </span>
                            </flux:text>
                            <flux:text>Kelas: 
                                @if ($item->teacher && $item->teacher->classRooms && $item->teacher->classRooms->count())
                                    @if ($item->teacher->classRooms->count() > 1)
                                        <br>
                                        @foreach ($item->teacher->classRooms as $kelas)
                                            <span class="font-bold ml-2">
                                                {{$loop->iteration}}. {{$kelas->name}}
                                            </span>
                                            @unless ($loop->last)
                                                <br>
                                            @endunless
                                        @endforeach
                                    @else
                                        <span class="font-bold">
                                            {{ $item->teacher->classRooms->pluck('name')->implode(', ') }}
                                        </span>
                                    @endif
                                @else
                                    <em class="text-red-500">Tidak memiliki kelas</em>
                                @endif
                            </flux:text>
                            <flux:text>Alamat: 
                                <span class="font-bold"> {{ $item->teacher->alamat }} </span>
                            </flux:text>
                            <flux:text>nomor telp: 
                                <span class="font-bold"> {{ $item->teacher->no_telp }} </span>
                            </flux:text>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <flux:tooltip content="Edit {{ $item->name }}'s account" >
                        <flux:button icon="pencil-square" wire:click="showEdit({{ $item->id }})" >Edit</flux:button>
                    </flux:tooltip>
                    
                    <flux:tooltip content="Hapus {{ $item->name }}'s account">
                        <flux:button icon="trash" variant="danger" wire:click="showConfirmDelete({{$item->id}})">Delete</flux:button>
                    </flux:tooltip>
                </div>
            </div>
        @endforeach        
    </div>
    {{ $teachers->links() }}
</div>
