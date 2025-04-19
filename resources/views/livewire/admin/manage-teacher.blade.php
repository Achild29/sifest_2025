<div>
    <x-slot:title>Aplikasi Absensi | Manage Teachers | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Manage Teachers</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage Teachers, you can Add, Edit and Delete Students</flux:text>
    <flux:text class="mb-2 mt-2 font-semibold">Default Username is '<span class="font-black">NIP</span>' | Default Password is '<span class="font-black">password</span>'</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <flux:modal.trigger name="create-teacher">
        <div class="flex justify-end mb-2">
            <flux:tooltip content="add new teacher">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl">
                    <flux:icon.plus-circle variant="solid" />
                    Add Teachers
                </button>
            </flux:tooltip>
        </div>
    </flux:modal.trigger>
    <livewire:admin.modal-teacher />

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
                            @if ($user->teacher && $user->teacher->classRooms->isNotEmpty())
                                @foreach ($user->Teacher->classRooms as $class)
                                    <td class="border px-4 py-2">{{ $class->name }}</td>
                                @endforeach
                            @else
                                <td class="border px-4 py-2">Tidak memiliki kelas</td>
                            @endif
                            <td class="border px-4 py-2">{{ $user->teacher->alamat}}</td>
                            <td class="border px-4 py-2">{{ $user->teacher->no_telp}}</td>
                            
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Edit {{ $user->name }}'s account">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        wire:click="edit({{ $user->id }})">
                                            <flux:icon.pencil-square/>
                                            Edit
                                        </button>
                                    </flux:tooltip>
                                    <flux:tooltip content="Delete Teacher: {{ $user->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="delete({{ $user->id }})">
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
