<div class="bg-gray-50 py-10 px-4 min-h-screen flex justify-center">
    <div class="bg-white max-w-3xl w-full p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 leading-tight">{{ $title }}</h1>

        <div class="text-gray-700 text-lg leading-relaxed space-y-6">
            {!! nl2br(e($content)) !!}
        </div>

        <div class="mt-8 border-t pt-4 text-sm text-gray-500">
            <p>Diposting pada: {{ $post->created_at->format('d M Y, H:i') }}</p>
            <p>Terakhir diperbarui: {{ $post->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>
