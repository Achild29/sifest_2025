<?php

use Faker\Factory as Faker;

$faker = Faker::create('id_ID');
?>
@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item >Manage Admin</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | List Users | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    
    <flux:heading size="xl" class="font-extrabold" level="1">List Users</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can find list of Users with role Admin, Except your account</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <flux:modal.trigger name="add-user">
        <div class="flex justify-end mb-2">
            <flux:tooltip content="add user admin" position="bottom">
                <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded cursor-pointer transition-all duration-200
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600
                bg-emerald-500 hover:bg-emerald-700 shadow-xl"
                >
                    <flux:icon.user-plus variant="solid"/>
                    add user
                </button>
            </flux:tooltip>
        </div>
    </flux:modal.trigger>

    <flux:separator variant="subtle" class="my-5"/>
    <div class="flex justify-center mb-2">
        <flux:heading size="xl" class="font-extrabold" level="1">Daftar Users yg masih aktif</flux:heading>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama</th>
                  <th class="border px-4 py-2 whitespace-pre">Username</th>
                  <th class="border px-4 py-2 whitespace-pre">Email</th>
                  <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($admin && $admin->isNotEmpty())
                    @foreach ($admin as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->username }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="reset password {{ $user->name }}'s account">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2
                                        bg-amber-600 hover:bg-amber-500 focus-visible:outline-amber-400"
                                        wire:click="showReset({{ $user->id }})"
                                        >
                                            <flux:icon.arrow-path/>
                                            reset
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

    <flux:separator variant="subtle" class="my-10"/>
    <div class="flex justify-center mb-2">
        <flux:heading size="xl" class="font-extrabold" level="1">Daftar Users yg sudah tidak aktif</flux:heading>
    </div>

    <div class="overflow-x-auto border rounded-lg shadow-2xl">
        <table class="min-w-full table-auto border">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr class="text-lg">
                  <th class="w-4 px-4 py-2 border ">No.</th>
                  <th class="border px-4 py-2 whitespace-pre">Nama</th>
                  <th class="border px-4 py-2 whitespace-pre">Username</th>
                  <th class="border px-4 py-2 whitespace-pre">Email</th>
                  <th class="border px-4 py-2 whitespace-pre w-4">action</th>
                </tr>
              </thead>
              <tbody class="text-lg">
                @if ($adminDeleted && $adminDeleted->isNotEmpty())
                    @foreach ($adminDeleted as $user)    
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->username }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex gap-3 justify-evenly">
                                    <flux:tooltip content="reset password {{ $user->name }}'s account">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                                        bg-indigo-500 hover:bg-indigo-700
                                        dark:bg-amber-600 dark:hover:bg-amber-500 dark:focus-visible:outline-amber-400"
                                        wire:click="showRestore({{ $user->id }})"
                                        >
                                            <flux:icon.arrow-path/>
                                            restore
                                        </button>
                                    </flux:tooltip>

                                    <flux:tooltip content="Delete user: {{ $user->name }} ?">
                                        <button class="flex items-center gap-2 text-[13px] text-white font-semibold py-[6px] px-3.5 w-fit rounded-[5px] cursor-pointer transition-all duration-200
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600
                                        bg-red-500 hover:bg-red-700"
                                        wire:click="showConfirmDelete({{ $user->id }})"
                                        >
                                            <flux:icon.trash />
                                            Delete
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

    <flux:modal name="add-user" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add user</flux:heading>
                <flux:text class="mt-2">menambahakan user dengan role admin.</flux:text>
            </div>
                
            <flux:field>
                <flux:label class="gap-0.5">Full Name<span class="text-red-500">*</span></flux:label>
                <flux:badge size="sm">required</flux:badge>
                <flux:input wire:model="nama" placeholder="{{ $faker->name() }}"/>
                <flux:error name="nama" />
            </flux:field>
            <flux:field>
                <flux:label class="gap-0.5">Username<span class="text-red-500">*</span></flux:label>
                <flux:badge size="sm">required</flux:badge>
                <flux:input wire:model="username" placeholder="{{ $faker->userName() }}"/>
                <flux:error name="username" />
            </flux:field>
            <flux:field>
                <flux:label class="gap-0.5">Email<span class="text-red-500">*</span></flux:label>
                <flux:badge size="sm">required</flux:badge>
                <flux:input wire:model="email" placeholder="{{ $faker->unique()->safeEmail }}"/>
                <flux:error name="email" />
            </flux:field>

            <flux:input readonly variant="filled" value="password" copyable label="Password"
            description="Default password is 'password'" icon="key"/>

            <flux:separator variant="subtle" class="my-5"/>
            <flux:spacer />

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" icon="plus-circle" variant="primary" wire:click="addUser">add User</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="reset-password" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make password to default to this account details.</flux:text>
            </div>
            <flux:input wire:model="nama" readonly variant="filled" label="Name" invalid />
            <flux:input readonly variant="filled" value="password" copyable label="Password"
                description="Default password is 'password'" icon="key" invalid/>

            <flux:separator variant="subtle" class="my-5"/>
            <flux:spacer />

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" icon="arrow-path" variant="primary" wire:click="resetPassword">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="restore-user" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make password to default to this account details.</flux:text>
            </div>
            <flux:input wire:model="nama" readonly variant="filled" label="Name" invalid />
            <flux:input readonly variant="filled" value="password" copyable label="Password"
                description="Default password is 'password'" icon="key" invalid/>

            <flux:separator variant="subtle" class="my-5"/>
            <flux:spacer />

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" icon="arrow-path" variant="primary" wire:click="restoreUser">Restore user</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-user" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete user?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this user.</p>
                    <div class="border-1 border-red-500 p-2 m-2">
                        <p>Nama<span class="font-black ml-9 text-red-500">: {{ $nama }}</span></p>
                        <p>Username<span class="font-black ml-2 text-red-500">: {{ $username }}</span></p>
                        <p>Role<span class="font-black ml-11 text-red-500">: {{ $user->role }}</span></p>
                    </div>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="removeUser">Delete user</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="remove-user" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete user?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this user permanently</p>
                    <div class="border-1 border-red-500 p-2 m-2">
                        <p>Nama<span class="font-black ml-9 text-red-500">: {{ $nama }}</span></p>
                        <p>Username<span class="font-black ml-2 text-red-500">: {{ $username }}</span></p>
                        <p>Role<span class="font-black ml-11 text-red-500">: {{ $user->role }}</span></p>
                    </div>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteUser">Delete user</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
