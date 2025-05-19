@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">
                    Home
                </span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi') }}" class="hidden sm:flex">Absensi</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi.kelas', $kelas->id) }}" class="hidden sm:flex">Kelas {{ $kelas->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi') }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item>Absensi Manual</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <div class="md:flex">
        <div class="grid">
            <flux:heading size="xl" class="font-extrabold" level="1">Absensi Manual Kelas: <span class="text-red-500">{{ $kelas->name }}</span></flux:heading>
            <flux:text class="mb-2 mt-2 font-semibold">This page you can manage an attendace of your students in Class: <span class="text-red-500">{{ $kelas->name }}</span> Manually</flux:text>
        </div>
        <flux:spacer />
        <div class="flex gap-3 md:grid md:gap-0 justify-center">
            <flux:text class="mb-2 mt-2 font-semibold" class="flex gap-2">
                <flux:icon.calendar variant="mini"/>
                    {{ now()->format('d M Y') }}
                </flux:text>
            <flux:text class="mb-2 mt-2 font-semibold" class="flex gap-2">
                <flux:icon.clock variant="mini"/>
                    {{ now()->format('H:i') }}
                </flux:text>
        </div>
    </div>
    <div class="bg-zinc-200 dark:bg-zinc-800 py-5 sm:py-5 rounded-2xl shadow-2xl text-center mt-3">
        <div class="lg:flex gap-4 justify-center">
            <h1 class="text-4xl font-black">
                Please Make sure you click the right button
            </h1>
            <div class="flex gap-2 justify-center mt-2">
                <div class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                bg-indigo-500 hover:bg-indigo-700
                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                    <flux:icon.arrow-down-on-square />
                    Masuk
                </div>
                <div class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                bg-indigo-500 hover:bg-indigo-700
                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                    <flux:icon.inbox-arrow-down />
                    Izin
                </div>
                <div class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                bg-indigo-500 hover:bg-indigo-700
                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                    <flux:icon.beaker />
                    Sakit
                </div>
            </div>
        </div>
        <flux:separator variant="subtle" class="my-2" />
        <h1 class="text-3xl">
            This action cannot be reversed, Even User Admin.
        </h1>
    </div>
    <flux:separator variant="subtle" class="mb-5 mt-2"/>

    <div class="flex justify-center ">
        <flux:heading size="xl" class="font-extrabold" level="1">Daftar Murid di Kelas: {{ $kelas->name }}</flux:heading>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">NISN</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama Murid</th>
                  <th class="border px-4 py-2 whitespace-pre">status</th>
                  <th class="border px-4 py-2 whitespace-pre w-40">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($murid && $murid->isNotEmpty())
                    @foreach ($murid as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->nisn }}</td>
                            <td class="border px-4 py-2">{{ $user->user->name }}</td>
                            <td class="border px-4 py-2">
                                @if ($user->attandances->isNotEmpty())    
                                    @foreach ($user?->attandances as $item)
                                        @if ($item->status == 'hadir')
                                            {{ $item->message }}
                                        @else
                                           {{ $item->message }}
                                        @endif
                                    @endforeach    
                                @else
                                    <span class="text-red-500">Belum absen masuk</span>
                                @endif
                            </td>
                            
                            <td class="border px-4 py-2">
                                <div class="grid gap-2 lg:flex lg:gap-3 justify-evenly">
                                    @if (
                                    $user->attandances->contains('status', 'hadir') ||
                                    $user->attandances->contains('status', 'others') || 
                                    $user->attandances->contains('status', 'izin') || 
                                    $user->attandances->contains('status', 'alpha') || 
                                    $user->attandances->contains('status', 'sakit') )
                                        @if ($user->attandances->contains('status', 'hadir') || 
                                        $user->attandances->contains('status', 'izin') || 
                                        $user->attandances->contains('status', 'alpha') || 
                                        $user->attandances->contains('status', 'sakit')
                                        )
                                            no need action
                                        @endif
                                        
                                    @else
                                        <flux:tooltip content="Absen Masuk untuk {{ $user->user->name }}">
                                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                            bg-indigo-500 hover:bg-indigo-700
                                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                            wire:click="absenMasuk({{ $user->id }})"
                                        >
                                                <flux:icon.arrow-down-on-square/>
                                                Masuk
                                            </button>
                                        </flux:tooltip>
                                        <flux:tooltip content="Izin untuk {{ $user->user->name }}">
                                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                            bg-indigo-500 hover:bg-indigo-700
                                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                            wire:click="absenIzin({{ $user->id }})"
                                        >
                                                <flux:icon.inbox-arrow-down/>
                                                izin
                                            </button>
                                        </flux:tooltip>
                                        <flux:tooltip content="{{ $user->user->name }} Sakit">
                                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                            bg-indigo-500 hover:bg-indigo-700
                                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                            wire:click="absenSakit({{ $user->id }})"
                                        >
                                                <flux:icon.beaker/>
                                                sakit
                                            </button>
                                        </flux:tooltip>
                                    @endif
                                    @if ($user->attandances->isNotEmpty() && $user->attandances->contains('status', 'others'))
                                        <flux:tooltip content="Absen Pulang untuk {{ $user->user->name }}">
                                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                            bg-indigo-500 hover:bg-indigo-700
                                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                            wire:click="pulang({{ $user->attandances[0]['id'] }})"
                                            >
                                                <flux:icon.arrow-up-on-square />
                                                Pulang
                                            </button>
                                        </flux:tooltip>
                                    @endif
                                    
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

</div>
