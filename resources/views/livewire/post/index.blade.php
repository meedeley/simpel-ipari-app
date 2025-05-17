<div>
    <div>
        <h1 class="text-2xl font-bold"># Pengaturan Tulisan</h1>
        <p class="text-sm text-gray-500">Tentukan Tulisan tulisan disini.</p>
    </div>

    <div class="py-4 flex justify-end">
        <flux:button variant="primary" icon="plus-circle" class="cursor-pointer">
           <a href="{{ route('posts.create') }}" wire:navigate>Tambah Tulisan</a>
        </flux:button>
    </div>

    <div>
        <livewire:post-table />
        <livewire:utils.modal-confirmation />
    </div>
</div>
