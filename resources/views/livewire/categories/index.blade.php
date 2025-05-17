<div>
    <div>
        <h1 class="text-2xl font-bold"># Pengaturan Kategori</h1>
        <p class="text-sm text-gray-500">Tentukan kategori tulisan disini.</p>
    </div>

    <div class="py-4 flex justify-end">
        <flux:button variant="primary" icon="plus-circle" class="cursor-pointer" wire:click="$dispatch('openModal')">
            Tambah Kategori
        </flux:button>
    </div>

    <div>
        <livewire:category-table />
        <livewire:categories.form />
        <livewire:utils.modal-confirmation />
    </div>
</div>
