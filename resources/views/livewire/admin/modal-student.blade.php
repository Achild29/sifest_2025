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

            <flux:input wire:model="nama" label="Nama Siswa" placeholder="{{ $faker->firstName .' '. $faker->lastName }}" />
            <flux:input wire:model="nisn" label="nisn" placeholder="{{ $faker->numerify('##########') }}" type="number" min="1"/>
            <flux:input wire:model="email" label="Email" placeholder="{{ $faker->unique()->safeEmail }}" type="email"/>
            <flux:textarea wire:model="alamat" label="Alamat" placeholder="{{ $faker->address }}" />
            <flux:input wire:model="wali_murid" label="Wali Murid" placeholder="{{ $faker->name }}" />
            <flux:input.group label="No. Telp Wali Murid">
                <flux:input.group.prefix>08</flux:input.group.prefix>
                <flux:input placeholder="{{ $faker->numerify('##########') }}" type="phone" wire:model="no_telp"/>
            </flux:input.group>
            <flux:error name="no_telp" />
            <flux:input wire:model="password" readonly variant="filled" value="password" copyable label="Password"
            description="Default password is 'password'" icon="key"/>
            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="store">Add User</flux:button>
                
            </div>
        </div>
    </flux:modal>
</div>
