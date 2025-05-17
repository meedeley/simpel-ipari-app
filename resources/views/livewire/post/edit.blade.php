<div class="container mx-auto py-16 px-6 lg:px-8">
    <div
        class="bg-gradient-to-r from-blue-50 via-indigo-50 to-blue-100 dark:from-blue-900 dark:via-indigo-900 dark:to-blue-800 rounded-xl p-8 border border-blue-100 dark:border-blue-800 shadow-lg transition duration-300 hover:shadow-xl mb-10">
        <div class="flex items-center justify-between">
            <div class="text-center sm:text-left">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-2 tracking-tight">Tambah
                    Tulisan</h1>
                <p class="text-base text-gray-600 dark:text-gray-400">Tambahkan tulisan yang sesuai di sini.</p>
            </div>
            <div class="hidden md:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-400 dark:text-blue-500 opacity-70"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="update" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 transform hover:-translate-y-1 p-6">
            <label
                class="block text-gray-700 dark:text-gray-300 font-medium mb-3 text-sm uppercase tracking-wider">Kategori</label>
            <div class="relative">
                <flux:select wire:model="categoryId" placeholder="Pilih Kategori"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <flux:select.option>Pilih Kategori</flux:select.option>
                    @foreach ($categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            @error('categoryId')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 transform hover:-translate-y-1 p-6">
            <label
                class="block text-gray-700 dark:text-gray-300 font-medium mb-3 text-sm uppercase tracking-wider">Judul
                Tulisan</label>
            <div class="relative">
                <flux:input label="" wire:model="title" placeholder="Masukan Judul Tulisan Disini"
                    class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 transition-all duration-300" />
            </div>
            @error('title')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg border border-gray-100 dark:border-gray-700 transition-all duration-300 lg:col-span-2 p-6">
            <flux:textarea rows="5" wire:model="content" label="Konten Tulisan" />
            @error('content')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="lg:col-span-2 mt-8 flex justify-end space-x-4">
            <flux:button type="button" wire:click="cancel" icon="trash" variant="danger" :loading="false"
                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg shadow transition-all duration-300 hover:shadow-lg flex items-center">
                Batal
            </flux:button>
            <flux:button type="submit" icon="check" :loading="false" variant="primary"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow transition-all duration-300 hover:shadow-lg flex items-center">
                Ubah
            </flux:button>
        </div>
    </form>
</div>
