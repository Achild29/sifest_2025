<div>
    <div class="bg-zinc-200 dark:bg-zinc-800 py-24 sm:py-32 rounded-2xl shadow-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Manage Kelas</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">{{ $classRooms->count() }} Jumlah Kelas</dt>
                <div class="self-center">
                    <flux:tooltip content="add user admin" position="bottom">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="manageKelas"
                        >
                            <flux:icon.book-open/>
                            Manage Kelas
                            <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>
            
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Absensi</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Scan Masuk/Pulang | Manual</dt>
                <div class="self-center">
                    <flux:tooltip content="goto Manage Teacher" position="bottom"> 
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="guruAbsensi"
                        >
                        <flux:icon.clipboard-document-list/>
                        Absensi
                        <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>

            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Report</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Laporan Absensi</dt>
                <div class="self-center">
                    <flux:tooltip content="goto Manage Teacher" position="bottom">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="guruLaporan"
                        >
                        <flux:icon.presentation-chart-line/>
                        Report Absensi
                        <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>
            </dl>
        </div>
    </div>
</div>
