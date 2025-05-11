@php
    use App\Models\Student;
@endphp

@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Laporan Absensi</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Laporan Absensi | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection

<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Laporan Absensi</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can see an attendences of your student or by class</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="py-24 sm:py-32 bg-zinc-50 dark:bg-zinc-800 rounded-2xl shadow-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                        <flux:tooltip content="add user admin" position="bottom">
                            <flux:modal.trigger name="select-class">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                                    <flux:icon.presentation-chart-line/>
                                    Laporan Kelas
                                    <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                                </button>
                            </flux:modal.trigger>
                        </flux:tooltip>         
                    </dd>
                    <dt class="text-base/7 text-gray-600 dark:text-white">Laporan per-kelas</dt>
                </div>
                <flux:spacer />    
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                        <flux:tooltip content="add user admin" position="bottom">
                            <flux:modal.trigger name="select-class-student">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                                    <flux:icon.chart-pie/>
                                    Laporan Siswa
                                    <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                                </button>
                            </flux:modal.trigger>
                        </flux:tooltip>
                    </dd>
                    <dt class="text-base/7 text-gray-600 dark:text-white">Laporan per-Siswa</dt>
                </div>
            </dl>
        </div>
    </div>

    <flux:modal name="select-class" class="min-w-[22rem]" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Please Select Class?</flux:heading>
                <flux:text class="mt-2">
                    <p>Please Select a class that you want to see a report</p>
                </flux:text>
            </div>

            <flux:select wire:model.live="selectedClass" label="Kelas">
                <flux:select.option selected>pilih kelas</flux:select.option>
                @foreach ($classRooms as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="reportClass">get a report</flux:button>
            </div>
        </div>
    </flux:modal>      

    <flux:modal name="select-class-student" class="min-w-[22rem]" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Please Select Class?</flux:heading>
                <flux:text class="mt-2">
                    <p>Please Select a class that you want to see a report</p>
                </flux:text>
            </div>

            <flux:select wire:model.live="selectedClass" label="Kelas" >
                <flux:select.option selected>pilih kelas</flux:select.option>
                @foreach ($classRooms as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model.live="selectedStudent" label="Nama Siswa" wire:key="{{ $selectedClass }}">
                <flux:select.option selected>pilih siswa</flux:select.option>
                @foreach (Student::where('kelas_id', $selectedClass)->get() as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->user->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="reportStudent">get a report</flux:button>
            </div>
        </div>
    </flux:modal>      
</div>
