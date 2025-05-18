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
        @foreach ($siswa as $item)
            <div class="grid gap-2 p-2 rounded-2xl dark:bg-zinc-800 bg-zinc-100 shadow-lg">
                <div class="grid grid-cols-2">
                    <div class="flex justify-center p-5 h-64 rounded-2xl bg-amber-100">
                        <img src="{{ asset($profil_path = $item->profil_path ? 'storage/assets/profile_pictures/'.$item->profil_path : 'storage/assets/avatar_students.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain rounded-2xl shadow-xl">
                    </div>
                    <div>
                        <div class="p-4 w-full text-center col-span-2">
                            <flux:heading size="lg" class="font-bold" level="1"> {{ $item->name }} </flux:heading>
                        </div>
                        <div class="p-2 w-full row-span-2 col-span-2">
                            <flux:text>NISN: 
                                <span class="font-bold"> {{ $item->student->nisn }} </span>
                            </flux:text>
                            <flux:text>Email: 
                                <span class="font-bold"> {{ $item->email }} </span>
                            </flux:text>
                            <flux:text>Kelas: 
                                <span class="font-bold"> {{ $item->student->classRoom->name ?? '-' }} </span>
                            </flux:text>
                            <flux:text>Wali murid: 
                                <span class="font-bold"> {{ $item->student->nama_wali_murid }} </span>
                            </flux:text>
                            <flux:text>nomor telp: 
                                <span class="font-bold"> {{ $item->student->no_telp_wali }} </span>
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
    {{ $siswa->links() }}
</div>
