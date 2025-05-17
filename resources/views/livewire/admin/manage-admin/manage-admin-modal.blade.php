<div>
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
                <flux:heading size="lg">restore user</flux:heading>
                <flux:text class="mt-2">you're activating this user</flux:text>
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

    <flux:modal name="remove-user" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete user?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this user permanently</p>
                    <div class="border-1 border-red-500 p-2 m-2">
                        <p>Nama<span class="font-black ml-9 text-red-500">: {{ $nama }}</span></p>
                        <p>Username<span class="font-black ml-2 text-red-500">: {{ $username }}</span></p>
                        <p>Role<span class="font-black ml-11 text-red-500">: {{ $role }}</span></p>
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
