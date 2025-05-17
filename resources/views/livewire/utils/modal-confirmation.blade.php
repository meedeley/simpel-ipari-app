<div>
    <flux:modal wire:model="isOpen" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus</flux:heading>
                <flux:text class="mt-2">
                    <p>Anda akan menghapus data ini.</p>
                    <p>Tindakan ini tidak dapat dibatalkan.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirm" variant="danger">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>


