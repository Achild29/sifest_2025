<div>
    <x-slot:title>Aplikasi Absensi | Settings | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Settings</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage your account</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <ul class="divide-y divide-gray-100">
        {{-- Nama --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.user variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Nama</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $nama }} </flux:text>
                </div>
            </div>
        </li>
        {{-- NIP / Username --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.identification variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">NISN / Username</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $nisn }} </flux:text>
                </div>
            </div>
        </li>
        {{-- Kelas --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.book-open variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Kelas</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $kelas ?? '-' }} </flux:text>
                </div>
            </div>
        </li>
        {{-- QR --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.qr-code variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Absensi QR-Code</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">digunakan untuk scan masuk dan scan pulang</flux:text>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:tooltip content="lohat QR Code">
                <a href="{{ asset('storage/qr_code/'. $qr_code) }}" target="_blank">
                    <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                    bg-indigo-500 hover:bg-indigo-700
                    dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                    >
                        <flux:icon.qr-code/>
                        lihat
                    </button>
                </a>
                </flux:tooltip>
        </div>
        </li>        
        {{-- Alamat --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.home-modern variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Alamat</flux:heading>
                    <div class="flex gap-2">
                        <flux:text class="mt-2 ml-5" variant="strong">{{ $alamat }}</flux:text>
                    </div>
                </div>
            </div>
        </li>
        {{-- Nama Wali --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.users variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Nama Orang Tua / Wali</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $wali }} </flux:text>
                </div>
            </div>
        </li>
        {{-- No Telpon --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.phone variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Nomor Handphone Orang Tua / Wali</flux:heading>
                    <div class="flex gap-2">
                        <flux:text class="mt-2 ml-5" variant="strong">{{ $no_telp_wali }}</flux:text>
                    </div>
                </div>
            </div> 
        </li>
        {{-- Email --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.at-symbol variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Email</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $email }} </flux:text>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="edit-email">
                    <flux:tooltip content="Edit Email ">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        >
                            <flux:icon.pencil-square/>
                            Edit
                        </button>
                    </flux:tooltip>
                </flux:modal.trigger>
            </div>
        </li>
        {{-- Password --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.key variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Password</flux:heading>
                    <div class="flex gap-2">
                        <flux:text class="mt-2 ml-5" variant="strong">Change Password ?</flux:text>
                    </div>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="edit-password">
                    <flux:tooltip content="ubah Password">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        >
                            <flux:icon.pencil-square/>
                            Edit
                        </button>
                    </flux:tooltip>
                </flux:modal.trigger>
            </div>
        </li>
        {{-- tampilan    --}}
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.moon variant="solid" class="hidden dark:flex size-12 text-amber-600" />
                    <flux:icon.sun variant="solid" class="dark:hidden size-12 text-indigo-500" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Tampilan</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong" class="hidden sm:flex">Dark mode atau Light Mode ?</flux:text>        
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <div class="bg-zinc-50 dark:bg-transparent rounded-lg">
                    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                        <flux:radio value="light" icon="sun">Light</flux:radio>
                        <flux:radio value="dark" icon="moon">Dark</flux:radio>
                        <flux:radio value="system" icon="computer-desktop">System</flux:radio>
                    </flux:radio.group>
                </div>
            </div>
        </li>
    </ul>
    <livewire:siswa.settings-modal />
</div>
