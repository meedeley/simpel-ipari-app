@php
    $title = $isEdited ? 'Ubah Status Laporan' : 'Tambah Status Laporan Baru';
    $subtitle = $isEdited
        ? 'Isi formulir untuk mengubah data Status Laporan'
        : 'Isi formulir untuk menambahkan data atasan';
@endphp

<div>
    <flux:modal wire:model="isOpen" name="form-modal" class="md:w-[64rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $title }}</flux:heading>
                <flux:text class="mt-2">{{ $subtitle }}</flux:text>
            </div>

            <form wire:submit="save" class="space-y-4">

                <flux:input type="text" wire:model="name" label="Nama Status Laporan"
                    placeholder="Masukkan Status Laporan" required />
                <flux:error wire:model="name" />


                <flux:textarea type="text" wire:model="description" label="Deksripsi Laporan"
                    placeholder="Masukkan Deskripsi Laporan" required />
                <flux:error wire:model="description" />

                <div class="float-end">
                    <flux:button variant="danger" type="button" wire:click="close">
                        Batal
                    </flux:button>

                    <flux:button type="submit" class="mt-4" :loading="false">
                        {{ $isEdited ? 'Ubah' : 'Simpan' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
