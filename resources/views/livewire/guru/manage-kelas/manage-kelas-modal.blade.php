<div>
    <flux:modal name="add-kelas" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">add a new Class</flux:heading>
                <flux:text class="mt-2">Membuat kelas Baru.</flux:text>
            </div>
            <flux:input wire:model="nama" label="Nama Kelas" placeholder="XII IPA 1" />
            <flux:textarea wire:model="description" label="Deskripsi Kelas" placeholder="Tahun Ajaran 2023/2024" rows="3" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="addKelas">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
    
    <flux:modal name="delete-kelas" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete class rooms?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this class rooms.</p>
                    <p class="text-red-500">{{ $nama }} | {{ $jumlahMurid }} Murid</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteKelas" >Delete class</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="add-murid" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">add a student</flux:heading>
                <flux:text class="mt-2">Tambahkan murid ke kelas ini.</flux:text>
            </div>
            <flux:select wire:model="nisn" label="NISN Murid" placeholder="Pilih siswa"/>
            

            <flux:input wire:model="nama" label="Nama Murid" readonly />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" wire:click="addKelas">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
