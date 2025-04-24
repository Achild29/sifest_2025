<?php
use Faker\Factory as Faker;

$faker = Faker::create('id_ID');
?>

<div>
    <flux:modal name="create-student" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Students</flux:heading>
                <flux:text class="mt-2">Add new Student's account</flux:text>
            </div>

            <flux:input wire:model="nama" label="Nama Siswa" placeholder="{{ $faker->firstName .' '. $faker->lastName }}" badge="Required" />
            <flux:input wire:model="nisn" label="nisn" placeholder="{{ $faker->numerify('##########') }}" type="number" min="1" badge="Required" />
            <flux:input wire:model="email" label="Email" placeholder="{{ $faker->unique()->safeEmail }}" type="email" badge="Required" />
            <flux:textarea wire:model="alamat" label="Alamat" placeholder="{{ $faker->address }}" badge="Required" />
            <flux:input wire:model="wali_murid" label="Wali Murid" placeholder="{{ $faker->name }}" badge="Required" />
            <flux:input.group label="No. Telp Wali Murid" badge="Required">
                <flux:input.group.prefix>08</flux:input.group.prefix>
                <flux:input placeholder="{{ $faker->numerify('##########') }}" type="phone" wire:model="no_telp"/>
            </flux:input.group>
            <flux:error name="no_telp" />
            <flux:input wire:model="password" readonly variant="filled" value="password" copyable label="Password"
            description="Default password is 'password'" icon="key"/>
            <flux:separator variant="subtle"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="store">Add Student</flux:button>
                
            </div>
        </div>
    </flux:modal>

    <flux:modal name="update-student" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Students</flux:heading>
                <flux:text class="mt-2">update <span class="font-black">{{ $nama }}</span>'s account</flux:text>
            </div>

            <flux:input wire:model="nama" label="Nama Siswa" />
            <flux:input wire:model="nisn" label="nisn" type="number" min="1"/>
            <flux:input wire:model="email" label="Email" type="email"/>
            <flux:textarea wire:model="alamat" label="Alamat" />
            <flux:input wire:model="wali_murid" label="Wali Murid" />

            <flux:input.group label="No. Telp Wali Murid">
                <flux:input.group.prefix>08</flux:input.group.prefix>
                <flux:input type="phone" wire:model="no_telp"/>
            </flux:input.group>
            <flux:error name="no_telp" />
            
            <flux:input.group label="Password"
            description="Default password is 'password'">
            <flux:modal.trigger name="reset-student">
                <flux:button icon="arrow-path" variant="danger">reset-password</flux:button>
            </flux:modal.trigger>
                <flux:input wire:model="password" readonly variant="filled" value="password" copyable  icon="key"/>
            </flux:input.group>

            <flux:separator variant="subtle"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="update">Update Student</flux:button>
                
            </div>
        </div>
    </flux:modal>

    <flux:modal name="reset-student" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Reset Pasword?</flux:heading>
                <flux:text class="mt-2">You're about to reset password this account</flux:text>
            </div>

            <flux:input wire:model="nama" label="Nama account" disabled variant="filled" invalid/>
            <flux:input wire:model="password" label="Password" disabled variant="filled" value="password" copyable invalid
            description="Reset password make password to default, Default password is 'password'" icon="key"
            />

            <flux:separator variant="subtle"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" icon="arrow-path" variant="danger" wire:click="resetPassword">reset password</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-student" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Student</flux:heading>
                <flux:text class="mt-2">Delete <span class="font-black">{{ $nama }}</span>'s account ?</flux:text>
            </div>

            <flux:input wire:model="nama" label="Nama Siswa" disabled variant="filled" invalid/>
            <flux:input wire:model="nisn" label="nisn" disabled variant="filled" invalid/>
            <flux:input wire:model="email" label="Email" disabled variant="filled" invalid/>
            <flux:textarea wire:model="alamat" label="Alamat" disabled variant="filled" invalid/>
            <flux:input wire:model="wali_murid" label="Wali Murid" disabled variant="filled" invalid/>

            <flux:input.group label="No. Telp Wali Murid">
                <flux:input.group.prefix>08</flux:input.group.prefix>
                <flux:input wire:model="no_telp" disabled variant="filled" invalid />
            </flux:input.group>
            <flux:error name="no_telp" />
                     
            <flux:separator variant="subtle"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" id="tombol-fokus">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" icon="trash" wire:click="removeStudent">Delete Student</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
