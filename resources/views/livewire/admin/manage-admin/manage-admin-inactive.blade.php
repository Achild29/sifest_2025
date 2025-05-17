<div class="mt-10">
    <div class="grid grid-cols-2">
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
        <div class="text-end">
            <flux:text>Jumlah: <span class="font-bold text-red-500">{{$users->count()}}</span> siswa</flux:text>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 gap-5 mb-5">
        @foreach ($users as $item)
            <div class="grid gap-2 p-2 rounded-2xl dark:bg-zinc-800 bg-zinc-100 shadow-lg">
                <div class="grid grid-cols-2">
                    <div class="flex justify-center p-5 h-64 rounded-2xl bg-amber-100">
                        <img src="{{ asset($profil_path = $item->profil_path ? 'storage/assets/profile_pictures/'.$item->profil_path : 'storage/assets/avatar.png') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain rounded-2xl shadow-xl">
                    </div>
                    <div class="">
                        <div class="p-4 w-full text-center col-span-2">
                            <flux:heading size="lg" class="font-bold" level="1"> {{ $item->name }} </flux:heading>
                        </div>
                        <div class="p-2 w-full row-span-2 col-span-2">
                            <flux:text>username: 
                                <span class="font-bold"> {{ $item->username }} </span>
                            </flux:text>
                            <flux:text>Role:
                                <span class="font-bold"> {{ $item->role }} </span>
                            </flux:text>
                            <flux:text>Email:<br>
                                <span class="font-bold lg:ml-2"> {{ $item->email }} </span>
                            </flux:text>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <flux:tooltip content="reset password {{ $item->name }}'s account" >
                        <flux:button icon="arrow-path" wire:click="showRestore({{ $item->id }})" variant="primary" >restore</flux:button>
                    </flux:tooltip>
                    <flux:tooltip content="reset password {{ $item->name }}'s account" >
                        <flux:button icon="trash" wire:click="showConfirmDelete({{ $item->id }})" variant="danger" >delete</flux:button>
                    </flux:tooltip>
                </div>
            </div>
        @endforeach
    </div>
    @if ($users->count() > 0)
        {{ $users->links() }}
    @else
        Belum ada data
    @endif
</div>