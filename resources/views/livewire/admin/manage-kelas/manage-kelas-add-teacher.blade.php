@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">
                    Home
                </span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.manage.kelas') }}" class="hidden lg:flex">Manage Kelas</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.manage.kelas') }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item >assign Teacher to class</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | List Users | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Assign Teacher to this Class: {{ $kelas->name }}</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage class. Class that have not teacher</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="flex justify-center mb-2">
        <flux:heading size="xl" class="font-extrabold" level="1">Daftar Guru</flux:heading>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama Guru</th>
                  <th class="border px-4 py-2 whitespace-pre">NIP</th>
                  <th class="border px-4 py-2 whitespace-pre">Kelas</th>
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
                            <td class="border px-4 py-2">
                                @if ($user->teacher && $user->teacher->classRooms && $user->teacher->classRooms->count())
                                    {{ $user->teacher->classRooms->pluck('name')->implode(', ') }}
                                @else
                                    <em>Tidak memiliki kelas</em>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Assign Teacher to this Class {{ $kelas->name  }}" position="bottom">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        wire:click="showConfirm({{ $user->id }})"
                                        >
                                        <flux:icon.user-plus/>
                                        Assign
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

    <flux:modal name="add-teacher" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Assign teacher?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to assign
                        <span class="font-bold text-red-500">
                            {{ $teacherName }}
                        </span>
                        this Class
                        <span class="font-bold text-red-500">
                            {{ $kelas->name }}
                        </span>
                    </p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" icon="user-plus" wire:click="assignTeacher" >Assign</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
