@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('manage.kelas') }}" class="hidden sm:flex">Manage Kelas</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('manage.kelas') }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item>Detail Kelas</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Kelas Detail | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection

<div>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Detail kelas {{ $kelas->name }}</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can find list of students in this class room, edit name, edit desctiption</flux:text>

    <div class="py-2 sm:py-5">
        <div class="mx-auto">
            <dl class="grid grid-cols-1 gap-x-5 gap-y-5 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col">
                    <dd class="order-first text-xl font-semibold tracking-tight text-gray-900 sm:text-2xl dark:text-white">{{ $kelas->name }}</dd>
                    <div class="self-center">
                        <flux:modal.trigger name="edit-nama">
                            <flux:tooltip content="edit nama kelas" position="bottom">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                >
                                    <flux:icon.pencil-square/>
                                    Edit Name
                                </button>
                            </flux:tooltip>
                        </flux:modal.trigger>
                    </div>
                </div>
                
                <div class="mx-auto flex max-w-xs flex-col">
                    <dd class="order-first text-xl font-semibold tracking-tight text-gray-900 sm:text-2xl dark:text-white">{{ $kelas->students->count(); }} Siswa</dd>
                    <div class="self-center">
                        <flux:tooltip content="tambahkan Siswa ke kelas ini" position="bottom">
                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                            wire:click="addStudents"
                            >
                            <flux:icon.user-plus/>
                            Add Students
                            </button>
                        </flux:tooltip>
                    </div>
                </div>

                <div class="mx-auto flex max-w-xs flex-col">
                    <dd class="order-first text-lg font-semibold tracking-tight text-gray-900 sm:text-2xl dark:text-white">Deskripsi Kelas</dd>
                    <dt class="text-base/7 text-gray-600 dark:text-white">{{ $kelas->description }}</dt>
                    <div class="self-center">
                        <flux:modal.trigger name="edit-description" >
                            <flux:tooltip content="Edit Deskripsi Kelas" position="bottom">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                >
                                <flux:icon.pencil-square/>
                                Edit descriptions
                                </button>
                            </flux:tooltip>
                        </flux:modal.trigger>
                    </div>
                </div>
            </dl>
        </div>
    </div>

    <flux:separator variant="subtle" class="my-5"/>

    <div class="flex justify-center mb-2">
    </div>

    <div class="">
        <div class="grid lg:grid-cols-3 gap-2 my-2">
            <div class="w-72"
                x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }"
            >
                <flux:input 
                icon="magnifying-glass"
                label="Cari Siswa"
                description="keywords pencarian: Nama dan Nisn"
                wire:model.live="search"
                placeholder="Search..."
                @focus="focusSearch()"
                @blur="searchFocused = false"
                />
            </div>
            <div class="text-center">
                <flux:heading size="xl" class="font-extrabold" level="1">Daftar Murid yg sudah terdaftar di Kelas: {{ $kelas->name }}</flux:heading>
                <flux:text>menampilkan: <span class="font-bold text-red-500">{{$isGridView ? $murid->count() : $students->count()}}</span> siswa</flux:text>
            </div>
            <div class="grid justify-end">
                <flux:heading size="lg" class="font-extrabold" level="1">Layout Tampilan</flux:heading>
                <div class="flex space-x-2">
                    <span class="{{ $isGridView ? 'text-zinc-300 dark:text-zinc-500' : '' }}">Table</span>
                    <flux:switch wire:model.live="isGridView" />
                    <span class="{{ $isGridView ? '' : 'text-zinc-300 dark:text-zinc-500' }}">Grid</span>
                </div>
            </div>
        </div>
        
        @if ($isGridView)
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
                                <flux:tooltip content="Keluarkan siswa: {{ $item->name }} dari kelas {{ $kelas->name }}" position="bottom">
                                    <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 bg-red-500 hover:bg-red-700"
                                    wire:click="showConfirm({{ $item->id }})"
                                    >
                                    <flux:icon.trash/>
                                    Delete
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
        @else
            <div class="overflow-x-auto border rounded-lg shadow-2xl">
                <table class="min-w-full table-auto border">
                    <thead class="bg-zinc-100 dark:bg-zinc-800">
                        <tr class="text-lg">
                        <th class="w-4 px-4 py-2 border ">No.</th>
                        <th class="border px-4 py-2 whitespace-pre">Nama Murid</th>
                        <th class="border px-4 py-2 whitespace-pre">NISN</th>
                        <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-lg">
                        @if ($students && $students->isNotEmpty())
                            @foreach ($students as $user)    
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->student->nisn }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex gap-3 justify-evenly">
                                            <flux:tooltip content="Keluarkan siswa: {{ $user->name }} dari kelas {{ $kelas->name }}?">
                                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                                bg-red-500 hover:bg-red-700"
                                                wire:click="showConfirm({{ $user->id }})"
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
            <div class="mt-5">
                {{ $students->links() }}
            </div>
        @endif
    </div>

    

    <flux:modal name="edit-nama" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="nama" label="Name"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateNama">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    <flux:modal name="edit-description" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:textarea wire:model="description" label="Deskripsi Kelas" rows="3"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateDeskripsi">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="remove-student" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Remove Student?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this student</p>
                    <p>Name: <span class="font-bold text-red-500">{{ $namaSiswa }}</span></p> 
                    <p>from this Class: <span class="font-bold text-red-500">{{ $kelas->name }}</span></p> 
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" icon="backspace" wire:click="removeStudent" >Remove Student</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
