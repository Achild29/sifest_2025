@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi') }}">Absensi</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Absensi Kelas</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Absensi | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Absensi Class: <span class="text-red-500">{{ $kelas->name }}</span></flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage an attendace of your students in Class: <span class="text-red-500">{{ $kelas->name }}</span></flux:text>
    <flux:text class="mb-2 mt-2 font-semibold">if you're going to make student <span class="text-red-500">alpha</span>. Please Make sure you again. This action cannot be reversed, Even User Admin.</flux:text>

    <div class="bg-zinc-200 dark:bg-zinc-800 py-5 sm:py-8 rounded-2xl shadow-2xl my-5">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <dl class="grid grid-cols-1 gap-x-8 gap-y-5 text-center lg:grid-cols-3">
            <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white self-center">
                    <flux:tooltip content="lakukan absensi Masuk">
                        <a href="{{   route('guru.absensi.scan.masuk', $kelas->id) }}">
                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                            >
                                <flux:icon.arrow-down-on-square />
                                Absensi Masuk
                            </button>
                        </a>
                    </flux:tooltip>
                </dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Absen Scan Masuk</dt>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white self-center">
                    <flux:tooltip content="lakukan absensi Pulang">
                        <a href="">
                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                            >
                                <flux:icon.arrow-up-on-square />
                                Absensi Pulang
                            </button>
                        </a>
                    </flux:tooltip>
                </dd>
              <dt class="text-base/7 text-gray-600 dark:text-white">Absen Scan Pulang</dt>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white self-center">
                    <flux:tooltip content="lakukan absensi manual">
                        <a href="{{ route('guru.absensi.kelas.manual', $kelas->id) }}">
                            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                            >
                                <flux:icon.clipboard-document-list/>
                                Absensi Manual
                            </button>
                        </a>
                    </flux:tooltip>
                </dd>
              <dt class="text-base/7 text-gray-600 dark:text-white">Absen Manual</dt>
            </div>
          </dl>
        </div>
    </div>

    <div class="flex justify-center mb-2">
        <h1 class="text-xl font-bold sm:text-2xl md:text-3xl lg:text-4xl ">Daftar Hadir Kelas <span class="text-red-500">{{ $kelas->name }}</span> 
        pada <span class="text-green-500"> {{ now()->format('d M Y') }}</span></h1>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">NISN</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama Murid</th>
                  <th class="border px-4 py-2 whitespace-pre">status</th>
                  <th class="border px-4 py-2 whitespace-pre">keterangan</th>
                  <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($murid && $murid->isNotEmpty())
                    @foreach ($murid as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->nisn }}</td>
                            <td class="border px-4 py-2">{{ $user->user->name }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if ($user->attandances && $user->attandances->isNotEmpty()) 
                                    @if ( $user->attandances[0]['status'] == 'hadir')
                                    <span class="text-green-500">{{ $user->attandances[0]['status'] }}</span>
                                    @endif
                                    @if ( $user->attandances[0]['status'] == 'others')
                                    <span class="text-amber-500">{{ $user->attandances[0]['status'] }}</span>
                                    @endif
                                    @if ( $user->attandances[0]['status'] == 'izin')
                                    <span class="text-gray-500">{{ $user->attandances[0]['status'] }}</span>
                                    @endif
                                    @if ( $user->attandances[0]['status'] == 'sakit')
                                    <span class="text-blue-500">{{ $user->attandances[0]['status'] }}</span>
                                    @endif
                                    @if ( $user->attandances[0]['status'] == 'alpha')
                                    <span class="text-red-500">{{ $user->attandances[0]['status'] }}</span>
                                    @endif
                                @else
                                    belum absen
                                @endif
                            </td>
                            @if ($user->attandances && $user->attandances->isNotEmpty())
                                <td class="border px-4 py-2">{{ $user->attandances[0]['message'] }}</td>
                            @else
                                <td class="border px-4 py-2 text-center">-</td>
                            @endif
                            @if ($user->attandances && $user->attandances->isNotEmpty())
                                <td class="border px-4 py-2 text-center">-</td>
                            @else
                                <td class="border px-4 py-2 text-center">
                                    <flux:tooltip content="Delete kelas: {{ $kelas->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="alphaAbsensi({{ $user->id }})"
                                        >
                                            <flux:icon.exclamation-triangle />
                                            Alpha
                                        </button>
                                    </flux:tooltip>
                                </td>
                            @endif
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
