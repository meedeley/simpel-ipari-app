<div>
    <div>
        <h1 class="text-2xl font-bold"># Pengaturan Status Laporan</h1>
        <p class="text-sm text-gray-500">Tentukan status yang sesuai di sini.</p>
    </div>

    <div class="py-4 flex justify-end">
        <flux:button variant="primary" icon="plus-circle" class="cursor-pointer" wire:click="$dispatch('openModal')">
            Tambah Status Laporan
        </flux:button>
    </div>

    <div>
        <livewire:report-status-table />
        <livewire:report-status.form />
        <livewire:utils.modal-confirmation />
    </div>
</div>
