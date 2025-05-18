@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
    use App\Enums\StatusAbsensi;

    $Bulan = Carbon::createFromFormat('Y-m', $bulan)->format('M-Y');
@endphp
<div>
    <div class="sm:grid xl:grid-cols-8 gap-4 px-5 py-5">
        <div class="w-full h-24 col-span-2 bg-zinc-100 dark:bg-zinc-800 rounded-2xl lg:shadow-md shadow p-2">
            <flux:input type="month" label="Bulan" wire:model.live="bulan" />
        </div>
        <div class="w-full h-30 lg:flex gap-3 col-span-6 mb-16 mt-2 sm:mt-0 sm:mb-0 bg-zinc-100 dark:bg-zinc-800 rounded-2xl lg:shadow-md shadow items-center">
            <div class="w-full h-24 py-4 mb-8">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-lg justify-center">{{ $student->user->name }}</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-lg justify-center">{{ $student->nisn }}</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-lg justify-center text-red-500">{{ $student->classRoom->name ?? 'Belum ada kelas' }}</flux:text>
            </div>
            <div class="w-full h-24 bg-green-200 dark:bg-green-800 rounded-xl mb-2 sm:mb-0 py-5 lg:py-3">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center">Hadir</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">{{ $jumlahKehadiran['h'] }}</flux:text>
            </div>
            <div class="w-full h-24 bg-cyan-200 dark:bg-cyan-800 rounded-xl mb-2 sm:mb-0 py-5 lg:py-3">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center">Izin</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">{{ $jumlahKehadiran['i'] }}</flux:text>
            </div>
            <div class="w-full h-24 bg-amber-200 dark:bg-amber-600 rounded-xl mb-2 sm:mb-0 py-5 lg:py-3">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center">Sakit</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">{{ $jumlahKehadiran['s'] }}</flux:text>
            </div>
            <div class="w-full h-24 bg-red-200 dark:bg-red-800 rounded-xl mb-2 sm:mb-0 py-5 lg:py-3">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center">Alpha</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">{{ $jumlahKehadiran['a'] }}</flux:text>
            </div>
            <div class="w-full h-24 border rounded-xl py-5 lg:py-3">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center">Others</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">{{ $jumlahKehadiran['o'] }}</flux:text>
            </div>
            <button wire:click="sendData('view-pdf')" class="lg:hidden w-full h-24 border rounded-xl my-2 py-5 lg:py-3
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                bg-indigo-500 hover:bg-indigo-700 cursor-pointer 
                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400">
                <flux:text class="font-semibold flex gap-2 text-xl lg:text-2xl justify-center"> View PDF</flux:text>
                <flux:text class="font-semibold flex gap-2 text-lg lg:text-xl justify-center">
                    <flux:icon.pdf />
                </flux:text>
            </button>
        </div>
    </div>
    <div class="hidden justify-end mb-2  mt-[550px] lg:flex lg:mt-0">
        <flux:tooltip content="add user admin" position="bottom">
            <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
            bg-emerald-500 hover:bg-emerald-700 shadow-xl"
            wire:click="sendData('download-pdf')"
            >
                <flux:icon.pdf />
                download PDF
            </button>
        </flux:tooltip>
    </div>
    <div class="hidden lg:flex overflow-x-auto border mt-5 rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Tanggal</th>
                  <th class="border px-4 py-2">status</th>
                  <th class="border px-4 py-2 whitespace-pre">Keterangan</th>
                </tr>
                </thead>
                <tbody class="text-lg">
                    @for ($i = 1; $i <= 31; $i++)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $i }}</td>
                            <td class="border px-4 py-2 text-center">{{ sprintf('%02d', $i).'-'.$Bulan }}</td>
                            @if ($absensi && $absensi->isNotEmpty())
                                @foreach ($absensi as $item)
                                    @if ($item->tanggal === $bulan.'-'.sprintf('%02d', $i))
                                        <td class="border px-4 py-2 text-center">
                                            {{ Str::substr(Str::upper($item->status), 0, 1) }}
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            {{ $item->message }}
                                        </td>
                                    @endif
                                @endforeach
                            @endif
                        </tr>
                    @endfor
                </tbody> 
        </table>
    </div>
</div>
@push('sendData')
    <script src="{{ asset('js/sendData.js') }}"></script>
@endpush
