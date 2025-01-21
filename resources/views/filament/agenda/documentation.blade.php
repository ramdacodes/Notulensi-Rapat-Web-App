<div class="text-center">
    @if($notulensi && !empty($notulensi->attachments))
        <div class="mt-4">
            @foreach($notulensi->attachments as $attachment)
                <div class="mb-4">
                    <!-- Menampilkan gambar dengan ukuran yang lebih kecil dan center -->
                    <img src="{{ Storage::url($attachment['file']) }}"
                         alt="{{ $attachment['title'] }}"
                         class="h-auto max-w-xs mx-auto rounded-lg shadow-md">
                    <p class="mt-2 font-semibold">{{ $attachment['title'] }}</p>
                    <p>{{ $attachment['description'] }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No attachments available.</p>
    @endif
</div>
