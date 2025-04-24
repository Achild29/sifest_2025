<?php

use Faker\Factory as Faker;

$faker = Faker::create('id_ID');
?>
<div class="mt-5">
    <div class="bg-zinc-200 dark:bg-zinc-800 py-24 sm:py-32 rounded-2xl shadow-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">{{ $admin->count(); }} Admin</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Jumlah User Admin yg terdaftar</dt>
                <div class="self-center">
                    <flux:tooltip content="add user admin" position="bottom">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="manageUsers"
                        >
                            <flux:icon.users/>
                            Manage admin
                            <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>
            
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">{{ $siswa->count(); }} Siswa</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Jumlah User Siswa yg terdaftar</dt>
                <div class="self-center">
                    <flux:tooltip content="goto Manage Teacher">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="manageStudents"
                        >
                        <flux:icon.user-group/>
                        Manage Students
                        <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>

            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">{{ $guru->count(); }} Guru</dd>
                <dt class="text-base/7 text-gray-600 dark:text-white">Jumlah User Guru yg terdaftar</dt>
                <div class="self-center">
                    <flux:tooltip content="goto Manage Teacher">
                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                        bg-indigo-500 hover:bg-indigo-700
                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                        wire:click="manageTeachers"
                        >
                        <flux:icon.user-group/>
                        Manage Teachers
                        <flux:icon.arrow-up-right vairant="solid" class="size-4"/>
                        </button>
                    </flux:tooltip>
                </div>
            </div>
            </dl>
        </div>
    </div>

</div>
