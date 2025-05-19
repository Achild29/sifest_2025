@php
    use Illuminate\Support\Str;
    use App\Enums\StatusAbsensi;
@endphp
@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.laporan') }}" class="hidden sm:flex">Laporan Absensi</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.laporan') }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item>
            <span class="hidden sm:flex">Laporan Absensi</span>
            Kelas
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Laporan Absensi Kelas | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection

<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Laporan Absensi Kelas: 
        <span class="text-red-500">{{ $kelas->name }}</span>
    </flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can see an attendences of your student in class: 
        <span class="text-red-500">{{ $kelas->name }}</span>
    </flux:text>
    
    <flux:separator variant="subtle" class="mb-5"/>
    <div class="sm:grid xl:grid-cols-3 gap-4 px-5 py-5 mb-16 sm:mb-5">
        <div class="w-full h-24 bg-zinc-100 dark:bg-zinc-800 rounded-2xl lg:shadow-md shadow p-2">
            <flux:input type="month" label="Bulan" wire:model.live="bulan" />
        </div>
        <div class="w-full h-24 bg-zinc-100 dark:bg-zinc-800 rounded-2xl lg:shadow-md shadow col-span-2 mb-16 mt-2 sm:mt-0 sm:mb-0">
            <div class="py-5 sm:py-4 ">
                <div class="mx-auto max-w-7xl lg:px-5">
                    <dl class="grid gap-x-5 gap-y-3 text-center lg:grid-cols-2">
                        <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-3xl">{{ $kelas->students->count() }}</dd>
                            <dt class="text-base/7 text-gray-600 dark:text-white">Jumlah Siswa</dt>
                        </div> 
                        <flux:tooltip content="Download laporan Bulanan untuk '{{ $kelas->name }}'">
                            <button class="mx-auto flex max-w-xs flex-col cursor-pointer shadow
                            w-fit rounded-2xl py-[6px] px-3.5 transition-all duration-200
                            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                            bg-indigo-500 hover:bg-indigo-700
                            dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                            wire:click="sendData('download-pdf-landscape')">
                                <dt class="text-base/7 font-bold text-white flex gap-2 self-center">
                                    <flux:icon.pdf />
                                    export to pdf
                                </dt>
                                <dt class="text-base/7 font-bold text-white">Laporan Bulanan Kelas: <span class="text-red-500">{{ $kelas->name }}</span></dt>
                            </button>
                        </flux:tooltip>                        
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    {{ $bulan }}
    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama Murid</th>
                  @for ($i = 1; $i <= 31; $i++)
                    <th class="border px-4 py-2 whitespace-pre w-4">{{ $i }}</th>  
                  @endfor
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($absensi && $absensi->isNotEmpty())
                    @foreach ($absensi as $item)  
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $item->student->user->name }}</td>
                            @for ($i = 1; $i <= 31; $i++)
                                @if ($item->tanggal === $bulan.'-'.sprintf('%02d', $i))
                                    <td class="border px-4 py-2 text-center">
                                        {{ Str::substr(Str::upper($item->status), 0, 1) }}
                                    </td>
                                @else
                                    <td class="border px-4 py-2 text-center">
                                       -
                                    </td>
                                @endif
                            @endfor
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
