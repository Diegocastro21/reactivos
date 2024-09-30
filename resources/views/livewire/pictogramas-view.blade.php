<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4"></h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($imagenes as $imagen)
            <div class="p-4 border rounded">
                <img src="{{ $imagen }}" alt="Pictograma" class="w-full h-auto">
            </div>
        @endforeach
    </div>
</div>
