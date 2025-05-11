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

    <div class="flex justify-center mb-2">
        <flux:heading size="xl" class="font-extrabold" level="1">Daftar Murid yg tidak memiliki kelas</flux:heading>
    </div>

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
                @if ($murid && $murid->isNotEmpty())
                    @foreach ($murid as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->student->nisn }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="Add siswa {{ $user->name }} to Class: {{ $kelas->name  }}" position="bottom">
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
