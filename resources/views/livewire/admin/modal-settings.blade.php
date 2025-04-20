<div>
    <flux:modal name="edit-username" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="username" label="Username" description="username must be unique" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateUsername">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-nama" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="nama" label="Name" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateNama">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-email" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
            <flux:input wire:model="email" type="email" label="Email" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="updateEmail">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-reset" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Reset Password?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to reset password.</p>
                    <p>This action make password to default password.</p>
                    <p>Default Password is <span class="font-black">password</span></p>
                    <p>And make you to log out</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="resetPassword" icon="arrow-path" variant="danger">reset</flux:button>
            </div>
        </div>
    </flux:modal>

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

    <flux:modal name="delete-account" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete account?</flux:heading>
            <flux:text class="mt-2">
                <p>You're about to delete this account?</p>
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button type="submit" variant="danger" icon="trash" wire:click="deleteAccount">Delete account</flux:button>
        </div>
    </div>
</flux:modal>
</div>
