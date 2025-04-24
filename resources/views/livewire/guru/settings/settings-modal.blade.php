<div>
    {{-- modal email --}}
    <flux:modal name="edit-email" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="email" type="email" label="Email" badge="Required" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateEmail">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    {{-- modal alamat --}}
    <flux:modal name="edit-alamat" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:textarea wire:model="alamat" label="Alamat" rows="3" badge="Required"/>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateAlamat">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    {{-- modal Telpon --}}
    <flux:modal name="edit-telp" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input.group label="No. Telp" badge="Required">
                <flux:input.group.prefix>08</flux:input.group.prefix>
                <flux:input type="phone" wire:model="no_telp"/>
            </flux:input.group>
            <flux:error name="no_telp" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateHp">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    {{-- modal password --}}
    <flux:modal name="edit-password" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="old_password" type="password" viewable label="Password lama" placeholder="enter your old password" />
            <flux:input wire:model="password_new" type="password" viewable label="Password baru" placeholder="enter your new password" />
            <flux:input wire:model="password_conf" type="password" viewable  label="Password konfirmasi" placeholder="please re-enter your password" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updatePassword">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    
</div>
