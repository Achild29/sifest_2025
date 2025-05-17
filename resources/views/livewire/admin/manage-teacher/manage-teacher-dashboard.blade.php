@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >Manage Teacher</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Manage Teachers | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Manage Teachers</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage Teachers, you can Add, Edit and Delete Students</flux:text>
    <flux:text class="mb-2 mt-2 font-semibold">Default Username is '<span class="font-black">NIP</span>' | Default Password is '<span class="font-black">password</span>'</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 px-4 py-3 mb-5 bg-zinc-50 dark:bg-zinc-700 rounded-2xl shadow-lg">
        <div class="grid grid-cols-1  mx-auto lg:mx-0">
            <flux:heading size="lg" class="font-extrabold" level="1">Layout Tampilan</flux:heading>
            <div class="flex space-x-2">
                <span class="{{ $isGridView ? 'text-zinc-300 dark:text-zinc-500' : '' }}">Table</span>
                <flux:switch wire:model.live="isGridView" />
                <span class="{{ $isGridView ? '' : 'text-zinc-300 dark:text-zinc-500' }}">Grid</span>
            </div>
        </div>
        <div class="text-center">
            <flux:heading size="xl" class="font-extrabold" level="1">Data Guru</flux:heading>
            <flux:text>Jumlah: <span class="font-bold text-red-500">{{$jumlahSiswa}}</span> guru</flux:text>
        </div>
        <div class="flex justify-center lg:justify-end">
            <flux:tooltip content="add new teacher">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl" wire:click="addNewTeacher">
                    <flux:icon.plus-circle variant="solid" />
                    Add Teachers
                </button>
            </flux:tooltip>
        </div>
        <livewire:admin.manage-teacher.manage-teacher-modal />
    </div>

    <flux:separator variant="subtle"/>

    <div>
        @if ($isGridView)
            @livewire('admin.manage-teacher.manage-teacher-grid', key($isGridView))
        @else
            @livewire('admin.manage-teacher.manage-teacher-table', key($isGridView))
        @endif
    </div>
</div>
