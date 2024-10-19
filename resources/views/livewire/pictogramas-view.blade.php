<div class="container mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4 uppercase ">Pictogramas</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($pictogramas as $pictograma)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{ $pictograma->imagen }}" alt="Pictograma">
                <div class="px-6 py-4 ">
                    <div
                        class="border bg-red-300 border-rose-600 font-bold text-xl text-white text-center uppercase mb-2">
                        {{ $pictograma->nombre }}</div>
                </div>
                {{-- <div class="px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#pictograma</span>
                </div> --}}
            </div>
        @endforeach
    </div>

    <div class="my-12">


        <h1 class="text-2xl font-bold mb-4 uppercase ">Categorias</h1>
        <p class="text-center text-gray-600 mb-6">
            Nivel 1: <span class="font-bold text-xl text-green-500">Básico</span>,
            Nivel 2: <span class="font-bold text-xl text-yellow-500">Intermedio</span>,
            Nivel 3: <span class="font-bold text-xl text-red-500">Avanzado</span>
        </p>
        @php
            $colores = [
                'Ácidos' => 'bg-red-500',
                'Bases' => 'bg-blue-500',
                'Sales' => 'bg-green-500',
                'Oxidantes' => 'bg-yellow-500',
                'Reductores' => 'bg-purple-500',
                'Disolventes' => 'bg-teal-500',
                'Reagentes de síntesis' => 'bg-indigo-500',
                'Catalizadores' => 'bg-pink-500',
                'Compuestos orgánicos' => 'bg-orange-500',
                'Compuestos inorgánicos' => 'bg-gray-500',
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4">
            @foreach ($categorias as $categoria)
                <div class="w-full mb-4">
                    <div class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <div class="{{ $colores[$categoria->nombre] }} text-white text-center rounded-t-lg p-6">
                            <h2 class="font-bold text-2xl uppercase">{{ $categoria->nombre }}</h2>
                        </div>
                        <div class="px-6 py-4">
                            <p class="text-center text-gray-700 text-lg font-semibold">
                                Nivel: <span class="font-bold text-red-500">{{ $categoria->nivel }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
