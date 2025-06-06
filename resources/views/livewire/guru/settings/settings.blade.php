@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >
            <div class="flex gap-2">
                <flux:icon.cog-6-tooth variant="mini" /> 
                <span class="hidden sm:flex">Settings</span>
            </div>
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Settings | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
@php
    $profil_path = Auth::user()->profil_path ?? 'storage/assets/avatar.png';
    if (!is_null(Auth::user()->profil_path)) {
        $profil_path = 'storage/assets/profile_pictures/'.Auth::user()->profil_path;
    }
@endphp
<div>
    
    <flux:heading size="xl" class="font-extrabold" level="1">Settings</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage your account</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="md:grid grid-cols-3 gap-4 px-4 py-4 leading-10">
        <div class="p-4 bg-zinc-200 dark:bg-zinc-800 rounded-xl row-span-2 text-center shadow-xl mb-5">
            <h1>Profil Picture</h1>
            <div class="flex flex-col items-center">
                <a href="{{ asset($profil_path) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset($profil_path) }}" alt="Profile Picture" class="w-[150px] h-auto border rounded-2xl mb-2">
                </a>
                <flux:input type="file" wire:model="photo" description="change photo profile"/>
                <flux:button class="mt-2" wire:click="changePhoto">Button</flux:button>
                <h5 class="mt-5">{{ $nama }}</h5>
                <p class="text-black-1">{{ $email }}</p>
            </div>
        </div>
        <div class="p-4 w-full bg-zinc-200 dark:bg-zinc-800 rounded-xl col-span-2 shadow-xl mb-5">
            <h1 class="text-2xl font-bold ml-5">Profil Detail</h1>
            <p class="ml-5">Your account role is <span class="font-bold">Guru</span></p>
        </div>
        <div class="p-4 w-full bg-zinc-200 dark:bg-zinc-800 rounded-xl row-span-3 col-span-2 shadow-xl">
            <ul class="divide-y divide-gray-100">
                {{-- Nama --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.user variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Nama</flux:heading>
                            <flux:text class="mt-2 ml-5" variant="strong">{{ $nama }} </flux:text>
                        </div>
                    </div>
                </li>
                {{-- NIP / Username --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.identification variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">NIP / Username</flux:heading>
                            <flux:text class="mt-2 ml-5" variant="strong">{{ $nip }} </flux:text>
                        </div>
                    </div>
                </li>
                {{-- Email --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.at-symbol variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Email</flux:heading>
                            <flux:text class="mt-2 ml-5" variant="strong">{{ $email }} </flux:text>
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <flux:modal.trigger name="edit-email">
                            <flux:tooltip content="Edit Email ">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold lg:py-1.5 px-2 lg:px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
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
                {{-- No Telpon --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.phone variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Nomor Hp.</flux:heading>
                            <div class="flex gap-2">
                                <flux:text class="mt-2 ml-5" variant="strong">{{ $no_telp }}</flux:text>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <flux:modal.trigger name="edit-telp">
                            <flux:tooltip content="Edit nomor telpon">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold lg:py-1.5 px-2 lg:px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
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
                {{-- Alamat --}}
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.home-modern variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Alamat</flux:heading>
                            <div class="flex gap-2">
                                <flux:text class="mt-2 ml-5" variant="strong">{{ $alamat }}</flux:text>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <flux:modal.trigger name="edit-alamat">
                            <flux:tooltip content="Edit Alamat">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold lg:py-1.5 px-2 lg:px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
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
                            <flux:icon.key variant="solid" class="text-indigo-500 dark:text-amber-600 lg:size-12 size-8" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Password</flux:heading>
                            <div class="flex gap-2">
                                <flux:text class="mt-2 ml-5" variant="strong">Change Password?</flux:text>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <flux:modal.trigger name="edit-password">
                            <flux:tooltip content="ubah Password">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold lg:py-1.5 px-2 lg:px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
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
                <li class="sm:flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="flex-none">
                            <flux:icon.moon variant="solid" class="hidden dark:flex lg:size-12 size-8 text-amber-600" />
                            <flux:icon.sun variant="solid" class="dark:hidden lg:size-12 size-8 text-indigo-500" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <flux:heading size="xl" class="font-bold text-indigo-500 dark:text-amber-600">Tampilan</flux:heading>
                            <flux:text class="mt-2 ml-5" variant="strong" class="hidden sm:flex">Dark mode atau Light Mode ?</flux:text>        
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <div class="rounded-lg">
                            <flux:switch x-data x-model="$flux.dark" label="Toggle" class="sm:hidden mt-5"  />
                            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" class="hidden sm:flex">
                                <flux:radio value="light" icon="sun">Light</flux:radio>
                                <flux:radio value="dark" icon="moon">Dark</flux:radio>
                                <flux:radio value="system" icon="computer-desktop">System</flux:radio>
                            </flux:radio.group>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <livewire:guru.settings.settings-modal />
</div>
