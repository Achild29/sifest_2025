@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('manage.kelas') }}" class="hidden sm:flex">Manage Kelas</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('detail.kelas', $kelas->id) }}" class="hidden sm:flex">Detail Kelas</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('detail.kelas', $kelas->id) }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item>Assign Students to Class</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Add Students | {{  Auth::user()->role->name }} </x-slot:title>
@endsection

<div>
    <div class="flex gap-2">
        <a href="{{ route('detail.kelas', $kelas->id) }}">
            <flux:button size="sm" icon="arrow-long-left">back</flux:button>
        </a>
        <flux:heading size="xl" class="font-extrabold" level="1">Assign Students to Class: {{ $kelas->name }}</flux:heading>
    </div>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can find list of students in this class room, edit name, edit desctiption</flux:text>
    
    <flux:separator variant="subtle" class="my-5"/>

    <div class="">
        <div class="grid lg:grid-cols-3 gap-2 my-2">
            <div class="w-72"
                x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }"
            >
                <flux:input 
                icon="magnifying-glass"
                label="Cari Siswa"
                description="keywords pencarian: Nama dan NISN"
                wire:model.live="search"
                placeholder="Search..."
                @focus="focusSearch()"
                @blur="searchFocused = false"
                />
            </div>
            <div class="text-center">
                <flux:heading size="xl" class="font-extrabold" level="1">Daftar Murid yg tidak memiliki kelas</flux:heading>
                <flux:text>Jumlah: <span class="font-bold text-red-500">{{$users->count()}}</span> siswa</flux:text>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 gap-5 my-5">
            @foreach ($murid as $item)
                <div class="bg-zinc-100 dark:bg-zinc-800 border lg:grid gap-2 border-zinc-200 dark:border-zinc-800 p-5 rounded-xl h-96 w-[360px] lg:w-full">
                    <div class="h-64 flex rounded-2xl p-2 justify-center bg-cyan-100 dark:bg-amber-100 shadow">
                        <img src="{{ asset($profil_path = $item->profil_path ? 'storage/assets/profile_pictures/'.$item->profil_path : 'storage/assets/avatar_students.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain rounded-2xl shadow-xl">
                    </div>
                    <div class="grid lg:grid-cols-2 gap-2">
                        <div class="grid">
                            <h4 class="font-raleway font-bold mt-2.5">{{ $item->name }}</h4>
                            <p> {{ $item->student->nisn ?? '-'  }} </p>
                        </div>
                        <div class="grid lg:justify-end items-center justify-center">
                            <flux:tooltip content="Add siswa {{ $item->name }} to Class: {{ $kelas->name  }}" position="bottom">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                wire:click="showConfirm({{ $item->id }})"
                                >
                                <flux:icon.user-plus/>
                                Assign
                                </button>
                            </flux:tooltip>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($murid->count() > 0)
            {{ $murid->links() }}
        @else
            Belum ada data
        @endif
    </div>

    <flux:modal name="add-students" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add {{ $nama }}?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to add <span class="font-bold text-red-500">{{ $nama }}</span></p>
                    <p>to this class: <span class="font-bold text-red-500">{{ $kelas->name }}</span></p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" icon="plus" variant="primary" wire:click="addStudent">add</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
