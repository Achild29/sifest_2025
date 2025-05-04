@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden md:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >Manage Students</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Manage Students | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Manage Students</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage Students, you can Add, Edit and Delete Students</flux:text>
    <flux:text class="mb-2 mt-2 font-semibold">Default Username is '<span class="font-black">NISN</span>' | Default Password is '<span class="font-black">password</span>'</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <flux:modal.trigger name="create-student">
        <div class="flex justify-end mb-2">
            <flux:tooltip content="add new student">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl">
                    <flux:icon.plus-circle variant="solid" />
                    Add Students
                </button>
            </flux:tooltip>
        </div>
    </flux:modal.trigger>
    <livewire:admin.manage-students.manage-students-modal />

    <div class="overflow-x-scroll border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama</th>
                  <th class="border px-4 py-2 whitespace-pre">NISN</th>
                  <th class="border px-4 py-2 whitespace-pre">Email</th>
                  <th class="border px-4 py-2 whitespace-pre">Kelas</th>
                  <th class="border px-4 py-2 whitespace-pre">Wali Murid</th>
                  <th class="border px-4 py-2 whitespace-pre">no. Wali</th>
                  <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($students && $students->isNotEmpty())
                    @foreach ($students as $student)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $student->name }}</td>
                            <td class="border px-4 py-2">{{ $student->Student->nisn }}</td>
                            <td class="border px-4 py-2">{{ $student->email }}</td>
                            <td class="border px-4 py-2 text-center">{{ $student->Student->classRoom->name ?? '-'}}</td>
                            <td class="border px-4 py-2">{{ $student->Student->nama_wali_murid}}</td>
                            <td class="border px-4 py-2">{{ $student->Student->no_telp_wali}}</td>
                            
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Edit {{ $student->name }}'s account">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        wire:click="edit({{ $student->id }})">
                                            <flux:icon.pencil-square/>
                                            Edit
                                        </button>
                                    </flux:tooltip>
                                    <flux:tooltip content="Delete Student: {{ $student->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="delete({{ $student->id }})">
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
    <div class="flex fixed bottom-5 right-5">
        {{-- toasterHub --}}
    </div>
</div>