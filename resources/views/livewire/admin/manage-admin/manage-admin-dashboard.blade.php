@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >Manage Admin</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | List Users | {{  Auth::user()->role->name }} </x-slot:title>
@endsection

<div>
    <flux:heading size="xl" class="font-extrabold" level="1">List Users</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can find list of Users with role Admin, Except your account</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 px-4 py-3 mb-5 bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow-lg">
        <div class="grid grid-cols-1  mx-auto lg:mx-0">
            @if ($isActive)
                <flux:tooltip content="show inactive user">
                    <flux:button variant="primary" icon="face-frown" class="bg-rose-200 text-red-500" wire:click='showDeletedUser'>inactive User</flux:button>
                </flux:tooltip>
            @else
                <flux:tooltip content="show active user">
                    <flux:button variant="primary" icon="face-smile" wire:click='showActiveUser'>Active User</flux:button>
                </flux:tooltip>
                
            @endif
        </div>
        <div class="text-center">
            @if ($isActive)
                <flux:heading size="xl" class="font-extrabold" level="1">Data admin Active</flux:heading>
            @else
                <flux:heading size="xl" class="font-extrabold" level="1">Data admin <span class="italic text-rose-500">inactive</span></flux:heading>
            @endif
        </div>
        <div class="flex justify-center lg:justify-end">
            <flux:tooltip content="add new user">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl" wire:click="addUser">
                    <flux:icon.plus-circle variant="solid" />
                    Add Students
                </button>
            </flux:tooltip>
        </div>
    </div>

    <livewire:admin.manage-admin.manage-admin-modal />

    @if ($isActive)
        <div class="mt-10">
            <div class="grid grid-cols-2">
                <div class="w-72 mb-5"
                    x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }"
                >
                    <flux:input 
                    icon="magnifying-glass"
                    label="Cari Siswa"
                    description="keywords pencarian: Nama dan Username"
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
                                <img src="{{ asset($profil_path = $item->profil_path ? 'storage/assets/profile_pictures/'.$item->profil_path : 'storage/assets/avatar_admin.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain rounded-2xl shadow-xl">
                            </div>
                            <div class="">
                                <div class="p-4 w-full text-center col-span-2">
                                    <flux:heading size="lg" class="font-bold" level="1"> {{ $item->name }} </flux:heading>
                                </div>
                                <div class="p-2 w-full row-span-2 col-span-2">
                                    <flux:text>Username: 
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
                                <flux:button icon="arrow-path" variant="primary" wire:click="showReset({{ $item->id }})"
                                variant="primary"
                                class="bg-indigo-500 hover:bg-indigo-700 dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"    
                                >
                                    reset
                                </flux:button>
                            </flux:tooltip>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $users->links() }}
        </div>
    @else
        @livewire('admin.manage-admin.manage-admin-inactive', key($isActive))
    @endif
</div>
