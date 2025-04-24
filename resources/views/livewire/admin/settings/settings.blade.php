@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> Home
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >
            <div class="flex gap-2">
                <flux:icon.cog-6-tooth variant="mini" /> Settings
            </div>
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Settings | {{  Auth::user()->role->name ?? "| Sprinter" }} </x-slot:title>
@endsection

<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Settings</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage your account</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <ul class="divide-y divide-gray-100">
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.user variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Username</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $username }} </flux:text>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="edit-username">
                    <flux:tooltip content="Edit username">
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
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.identification variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Nama</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">{{ $nama }} </flux:text>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="edit-nama">
                    <flux:tooltip content="Edit Nama">
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
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.key variant="solid" class="text-indigo-500 dark:text-amber-600 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Password</flux:heading>
                    <div class="flex gap-2">
                        <flux:text class="mt-2 ml-5" variant="strong">forgot password ?</flux:text>
                        <flux:modal.trigger name="edit-reset">
                            <flux:tooltip content="Reset Password">
                                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                bg-indigo-500 hover:bg-indigo-700
                                dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                >
                                    <flux:icon.arrow-path/>
                                    reset password
                                </button>
                            </flux:tooltip>
                        </flux:modal.trigger>
                    </div>
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="edit-password">
                    <flux:tooltip content="Edit Password">
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
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="flex-none">
                    <flux:icon.trash variant="solid" class="text-red-700 dark:text-red-300 size-12" />
                </div>
                <div class="min-w-0 flex-auto">
                    <flux:heading size="lg" class="font-bold">Delete account</flux:heading>
                    <flux:text class="mt-2 ml-5" variant="strong">Hapus akun ini ?</flux:text>                        
                </div>
            </div>
            <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                <flux:modal.trigger name="delete-account">
                    <flux:tooltip content="Delete this account?">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                        bg-red-500 hover:bg-red-700"
                        >
                            <flux:icon.trash />
                            Delete
                        </button>
                    </flux:tooltip>
                </flux:modal.trigger>
            </div>
        </li>
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
    <livewire:admin.settings.settings-modal />
      
</div>
