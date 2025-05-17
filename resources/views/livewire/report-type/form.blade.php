@php
    $title = $isEdited ? 'Ubah Tipe Laporan' : 'Tambah Tipe Laporan Baru';
    $subtitle = $isEdited
        ? 'Isi formulir untuk mengubah data Tipe Laporan'
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

                <flux:input type="text" wire:model="name" label="Nama Tipe Laporan"
                    placeholder="Masukkan Nama Tipe Laporan" required />
                <flux:error wire:model="name" />


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
