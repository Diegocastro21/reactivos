<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between">
                        <div class="uppercase font-bold">Reactivos</div>
                        <div class="flex items-center">
                            <button wire:click="openModal" class="px-4 py-2 bg-red-500 text-white rounded-md mr-4">
                                Crear Reactivo
                            </button>

                            <input wire:model.live="search" type="text" placeholder="Buscar..."
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <select wire:model.live="perPage"
                                class="ml-4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ([10, 25, 50, 100] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            {{-- <button type="submit"
                                    class="ml-4 px-4 py-2 bg-red-500 text-white rounded-md">Buscar</button> --}}

                        </div>
                    </div>

                    @if (session()->has('message'))
                        <div class="mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('codigo')">
                                        Código</th>
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('nombre')">
                                        Nombre</th>
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('disponibilidad')">
                                        Disponibilidad</th>
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('cantidad_disponible')">
                                        Cantidad</th>
                                    {{-- <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('marca')">
                                        Marca</th> --}}
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('fecha_vencimiento')">
                                        Fecha Vencimiento</th>
                                    <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="">
                                        Funciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($reactivos as $reactivo)
                                    <tr>
                                        <td class="px-6 py-4 break-words">{{ $reactivo->codigo }}</td>
                                        <td class="px-6 py-4 break-words">{{ $reactivo->nombre }}</td>
                                        <td class="px-6 py-4 break-words">{{ $reactivo->disponibilidad }}</td>
                                        <td class="px-6 py-4 break-words">{{ $reactivo->cantidad_disponible }}
                                            {{ $reactivo->unidad_medida }}</td>
                                        {{-- <td class="px-6 py-4 break-words">{{ $reactivo->marca }}</td> --}}
                                        <td class="px-6 py-4 break-words">
                                            {{ $reactivo->fecha_vencimiento->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button wire:click="openVerModal({{ $reactivo }})"
                                                class=" p-2 bg-red-500 text-white rounded-md ">
                                                Ver
                                            </button> | <button wire:click="openModal({{ $reactivo }})"
                                                class=" p-2 bg-red-500 text-white rounded-md ">
                                                Editar
                                            </button> | <button
                                                wire:click="openRegistroModal({{ $reactivo }}, 'salida')"
                                                class=" p-2 bg-red-500 text-white rounded-md ">
                                                Consumir
                                            </button>
                                            | <button wire:click="openRegistroModal({{ $reactivo }}, 'entrada')"
                                                class=" p-2 bg-red-500 text-white rounded-md ">
                                                Ingresar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $reactivos->links() }}
                    </div>
                </div>

                @if ($modal)
                    <div
                        class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                        <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                            <div class="w-full">
                                <div class="m-8 my-20 max-w-[400px] mx-auto">
                                    <div class="mb-8">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            {{ isset($miReactivo->id) ? 'Actualizar' : 'Crear' }} Reactivo
                                        </h3>

                                        <form wire:submit="guardarOActualizar" class="space-y-4">
                                            <div>
                                                <label for="codigo"
                                                    class="block text-sm font-medium text-gray-700">Código</label>
                                                <input type="text" id="codigo" wire:model.defer="codigo"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('codigo')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="nombre"
                                                    class="block text-sm font-medium text-gray-700">Nombre</label>
                                                <input type="text" id="nombre" wire:model.defer="nombre"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('nombre')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="disponibilidad"
                                                    class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                                                <select id="disponibilidad" wire:model.defer="disponibilidad"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione una Disponibilidad</option>
                                                    <option value="total">Total</option>
                                                    <option value="media">Media</option>
                                                    <option value="poca">Poca</option>
                                                    <option value="no hay">No hay</option>
                                                </select>
                                                @error('disponibilidad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="unidad_medida"
                                                    class="block text-sm font-medium text-gray-700">Unidad de
                                                    Medida</label>
                                                <select id="unidad_medida" wire:model.defer="unidad_medida"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione una Unidad de Medida</option>
                                                    <option value="g">Gramos (g)</option>
                                                    <option value="mg">Miligramos (mg)</option>
                                                    <option value="ml">Mililitros (ml)</option>
                                                    <option value="l">Litros (l)</option>
                                                </select>

                                                @error('unidad_medida')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- (['g', 'mg', 'ml', 'l']), --}}
                                            <div>
                                                <label for="cantidad_disponible"
                                                    class="block text-sm font-medium text-gray-700">Cantidad
                                                    Disponible</label>
                                                <input type="number" step="0.01" id="cantidad_disponible"
                                                    wire:model.defer="cantidad_disponible"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('cantidad_disponible')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="codigo_indicacion_peligro"
                                                    class="block text-sm font-medium text-gray-700">Código de
                                                    Indicación
                                                    de Peligro</label>
                                                <input type="text" id="codigo_indicacion_peligro"
                                                    wire:model.defer="codigo_indicacion_peligro"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('codigo_indicacion_peligro')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="lote"
                                                    class="block text-sm font-medium text-gray-700">Lote</label>
                                                <input type="text" id="lote" wire:model.defer="lote"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('lote')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="marca"
                                                    class="block text-sm font-medium text-gray-700">Marca</label>
                                                <input type="text" id="marca" wire:model.defer="marca"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('marca')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="fabricante"
                                                    class="block text-sm font-medium text-gray-700">Fabricante</label>
                                                <input type="text" id="fabricante" wire:model.defer="fabricante"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('fabricante')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="proveedores"
                                                    class="block text-sm font-medium text-gray-700">Proveedores</label>
                                                <input type="text" id="buscar_proveedor"
                                                    wire:model.live="buscarProveedor"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    placeholder="Buscar proveedor...">
                                                <div class="mt-2 grid grid-cols-3 gap-4">
                                                    @foreach ($proveedores as $proveedor)
                                                        <div class="relative">
                                                            <button type="button"
                                                                wire:click="toggleProveedor({{ $proveedor->id }})"
                                                                class="w-full h-12 flex items-center justify-center rounded-md border {{ in_array($proveedor->id, $proveedoresSeleccionados) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                {{ $proveedor->nombre }}
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('proveedoresSeleccionados')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="categorias"
                                                    class="block text-sm font-medium text-gray-700">Categorías</label>
                                                <input type="text" id="buscar_categoria"
                                                    wire:model.live="buscarCategoria"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    placeholder="Buscar categoría...">
                                                <div class="mt-2 grid grid-cols-3 gap-4">
                                                    @if ($buscarCategoria)
                                                        @foreach ($categorias as $categoria)
                                                            <div class="relative">
                                                                <button type="button"
                                                                    wire:click="toggleCategoria({{ $categoria->id }})"
                                                                    class="w-full h-12 flex items-center justify-center rounded-md border {{ in_array($categoria->id, $categoriasSeleccionadas) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                    <span class="font-bold">{{ $categoria->nombre }} |
                                                                        {{ $categoria->nivel }} |</span>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @foreach ($categoriasSeleccionadas as $categoriaId)
                                                            @php
                                                                $categoria = $categorias->firstWhere(
                                                                    'id',
                                                                    $categoriaId,
                                                                );
                                                            @endphp
                                                            <div class="relative">
                                                                <button type="button"
                                                                    wire:click="toggleCategoria({{ $categoria->id }})"
                                                                    class="w-full h-12 flex items-center justify-center rounded-md border border-blue-500">
                                                                    <span class="font-bold">{{ $categoria->nombre }} |
                                                                        {{ $categoria->nivel }} |</span>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                @error('categoriasSeleccionadas')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="url_ficha_seguridad"
                                                    class="block text-sm font-medium text-gray-700">URL Ficha de
                                                    Seguridad</label>
                                                <input type="url" id="url_ficha_seguridad"
                                                    wire:model.defer="url_ficha_seguridad"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('url_ficha_seguridad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="fecha_vencimiento"
                                                    class="block text-sm font-medium text-gray-700">Fecha de
                                                    Vencimiento</label>
                                                <input type="date" id="fecha_vencimiento"
                                                    wire:model.lazy="fecha_vencimiento"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('fecha_vencimiento')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="pictogramas"
                                                    class="block text-sm font-medium text-gray-700">Pictogramas</label>
                                                <div class="grid grid-cols-3 gap-4">
                                                    @foreach ($pictogramas as $pictograma)
                                                        <div class="relative">
                                                            <button type="button"
                                                                wire:click="togglePictograma({{ $pictograma->id }})"
                                                                class="w-full h-24 flex items-center justify-center rounded-md border {{ in_array($pictograma->id, $pictogramasSeleccionados) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                <img src="{{ asset('' . $pictograma->imagen) }}"
                                                                    alt="{{ $pictograma->nombre }}" class="h-full">
                                                            </button>
                                                            <span
                                                                class="absolute bottom-0 left-0 bg-gray-700 text-white text-xs px-2 py-1">{{ $pictograma->nombre }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('pictogramasSeleccionados')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="estante_id"
                                                    class="block text-sm font-medium text-gray-700">ID del
                                                    Estante</label>


                                                <select id="estante_id" wire:model.live="estante_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione un Estante</option>
                                                    @foreach ($estantes as $estante)
                                                        <option value="{{ $estante->id }}">
                                                            {{ $estante->no_estante }} || {{ $estante->descripcion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('estante_id')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            @if ($estante_id && $posiciones)
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">Seleccione
                                                        una posición:</label>
                                                    <div class="grid gap-2"
                                                        style="grid-template-columns: repeat({{ $estanteSeleccionado->columnas }}, minmax(0, 1fr));">
                                                        @foreach ($posiciones as $fila => $columnas)
                                                            @foreach ($columnas as $columna => $posicion)
                                                                <div>
                                                                    <button type="button"
                                                                        wire:click="seleccionarPosicion({{ $posicion['id'] }})"
                                                                        class="w-full h-12 flex items-center justify-center rounded-md {{ $posicion['ocupada']
                                                                            ? 'bg-red-500 cursor-not-allowed'
                                                                            : ($posicionSeleccionada == $posicion['id']
                                                                                ? 'bg-green-500'
                                                                                : 'bg-blue-500 hover:bg-blue-600') }} text-white font-medium">
                                                                        {{ $fila + 1 }},{{ $columna + 1 }}
                                                                    </button>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                        </form>
                                    </div>

                                    <div class="flex flex-row space-x-4">
                                        <button wire:click="guardarOActualizar"
                                            class="p-3 bg-black rounded-full text-white w-full font-semibold">
                                            {{ isset($miReactivo->id) ? 'Actualizar' : 'Crear' }} Reactivo
                                        </button>
                                        <button wire:click="closeModal"
                                            class="p-3 bg-white border rounded-full w-full font-semibold">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if ($verModal)
                    <div
                        class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                        <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                            <div class="w-full">
                                <div class="m-8 my-20 max-w-[400px] mx-auto">
                                    <div class="mb-8">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Informacion Reactivo
                                        </h3>

                                        <form wire:submit="" class="space-y-4">
                                            <div>
                                                <label for="codigo"
                                                    class="block text-sm font-medium text-gray-700">Código</label>
                                                <input disabled type="text" id="codigo"
                                                    wire:model.defer="codigo"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('codigo')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="nombre"
                                                    class="block text-sm font-medium text-gray-700">Nombre</label>
                                                <input disabled type="text" id="nombre"
                                                    wire:model.defer="nombre"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('nombre')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="disponibilidad"
                                                    class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                                                <select disabled id="disponibilidad" wire:model.defer="disponibilidad"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione una Disponibilidad</option>
                                                    <option value="total">Total</option>
                                                    <option value="media">Media</option>
                                                    <option value="poca">Poca</option>
                                                    <option value="no hay">No hay</option>
                                                </select>
                                                @error('disponibilidad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="unidad_medida"
                                                    class="block text-sm font-medium text-gray-700">Unidad de
                                                    Medida</label>
                                                <select disabled id="unidad_medida" wire:model.defer="unidad_medida"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione una Unidad de Medida</option>
                                                    <option value="g">Gramos (g)</option>
                                                    <option value="mg">Miligramos (mg)</option>
                                                    <option value="ml">Mililitros (ml)</option>
                                                    <option value="l">Litros (l)</option>
                                                </select>

                                                @error('unidad_medida')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- (['g', 'mg', 'ml', 'l']), --}}
                                            <div>
                                                <label for="cantidad_disponible"
                                                    class="block text-sm font-medium text-gray-700">Cantidad
                                                    Disponible</label>
                                                <input disabled type="number" step="0.01"
                                                    id="cantidad_disponible" wire:model.defer="cantidad_disponible"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('cantidad_disponible')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="codigo_indicacion_peligro"
                                                    class="block text-sm font-medium text-gray-700">Código de
                                                    Indicación
                                                    de Peligro</label>
                                                <input disabled type="text" id="codigo_indicacion_peligro"
                                                    wire:model.defer="codigo_indicacion_peligro"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('codigo_indicacion_peligro')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="lote"
                                                    class="block text-sm font-medium text-gray-700">Lote</label>
                                                <input disabled type="text" id="lote" wire:model.defer="lote"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('lote')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="marca"
                                                    class="block text-sm font-medium text-gray-700">Marca</label>
                                                <input disabled type="text" id="marca"
                                                    wire:model.defer="marca"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('marca')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="fabricante"
                                                    class="block text-sm font-medium text-gray-700">Fabricante</label>
                                                <input disabled type="text" id="fabricante"
                                                    wire:model.defer="fabricante"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('fabricante')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="proveedores"
                                                    class="block text-sm font-medium text-gray-700">Proveedores</label>

                                                <div class="mt-2 grid grid-cols-3 gap-4">
                                                    @foreach ($proveedores as $proveedor)
                                                        <div class="relative">
                                                            <button disabled type="button"
                                                                wire:click="toggleProveedor({{ $proveedor->id }})"
                                                                class="w-full h-12 flex items-center justify-center rounded-md border {{ in_array($proveedor->id, $proveedoresSeleccionados) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                {{ $proveedor->nombre }}
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('proveedoresSeleccionados')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="categorias"
                                                    class="block text-sm font-medium text-gray-700">Categorías</label>
                                                {{-- <input disabled type="text" id="buscar_categoria"
                                                    wire:model.live="buscarCategoria"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    placeholder="Buscar categoría..."> --}}
                                                <div class="mt-2 grid grid-cols-3 gap-4">
                                                    @if ($buscarCategoria)
                                                        @foreach ($categorias as $categoria)
                                                            <div class="relative">
                                                                <button disabled type="button"
                                                                    wire:click="toggleCategoria({{ $categoria->id }})"
                                                                    class="w-full h-12 flex items-center justify-center rounded-md border {{ in_array($categoria->id, $categoriasSeleccionadas) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                    <span class="font-bold">{{ $categoria->nombre }}
                                                                        {{ $categoria->nivel }} |</span>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @foreach ($categoriasSeleccionadas as $categoriaId)
                                                            @php
                                                                $categoria = $categorias->firstWhere(
                                                                    'id',
                                                                    $categoriaId,
                                                                );
                                                            @endphp
                                                            <div class="relative">
                                                                <button disabled type="button"
                                                                    wire:click="toggleCategoria({{ $categoria->id }})"
                                                                    class="w-full h-12 flex items-center justify-center rounded-md border border-blue-500">
                                                                    <span class="font-bold">{{ $categoria->nombre }} |
                                                                        {{ $categoria->nivel }} |</span>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                @error('categoriasSeleccionadas')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="url_ficha_seguridad"
                                                    class="block text-sm font-medium text-gray-700">URL Ficha de
                                                    Seguridad</label>
                                                <input disabled type="url" id="url_ficha_seguridad"
                                                    wire:model.defer="url_ficha_seguridad"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('url_ficha_seguridad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="fecha_vencimiento"
                                                    class="block text-sm font-medium text-gray-700">Fecha de
                                                    Vencimiento</label>
                                                <input disabled type="text" id="fecha_vencimiento"
                                                    wire:model="fecha_vencimiento"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('fecha_vencimiento')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="pictogramas"
                                                    class="block text-sm font-medium text-gray-700">Pictogramas</label>
                                                <div class="grid grid-cols-3 gap-4">
                                                    @foreach ($pictogramas as $pictograma)
                                                        <div class="relative">

                                                            @if (in_array($pictograma->id, $pictogramasSeleccionados))
                                                                <button disabled type="button"
                                                                    wire:click="togglePictograma({{ $pictograma->id }})"
                                                                    class="w-full h-24 flex items-center justify-center rounded-md border {{ in_array($pictograma->id, $pictogramasSeleccionados) ? 'border-blue-500' : 'border-gray-300' }}">
                                                                    <img src="{{ asset('' . $pictograma->imagen) }}"
                                                                        alt="{{ $pictograma->nombre }}"
                                                                        class="h-full">
                                                                </button>
                                                                <span
                                                                    class="absolute bottom-0 left-0 bg-gray-700 text-white text-xs px-2 py-1">{{ $pictograma->nombre }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('pictogramasSeleccionados')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="estante_id"
                                                    class="block text-sm font-medium text-gray-700">ID del
                                                    Estante</label>


                                                <select disabled id="estante_id" wire:model.live="estante_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione un Estante</option>
                                                    @foreach ($estantes as $estante)
                                                        <option value="{{ $estante->id }}">
                                                            {{ $estante->no_estante }} || {{ $estante->descripcion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('estante_id')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>





                                            @if ($estante_id && $posiciones)
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">Posición
                                                        del Reactivo:</label>
                                                    <div class="grid gap-2"
                                                        style="grid-template-columns: repeat({{ $estanteSeleccionado->columnas }}, minmax(0, 1fr));">
                                                        @foreach ($posiciones as $fila => $columnas)
                                                            @foreach ($columnas as $columna => $posicion)
                                                                <div>
                                                                    <div
                                                                        class="w-full h-12 flex items-center justify-center rounded-md {{ $posicion['ocupada']
                                                                            ? ($posicionSeleccionada == $posicion['id']
                                                                                ? 'bg-green-500'
                                                                                : 'bg-red-500')
                                                                            : 'bg-gray-300' }} text-white font-medium">
                                                                        {{ $fila + 1 }},{{ $columna + 1 }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                        </form>


                                        <!-- Mostrar el historial en una tabla -->
                                        <div class="my-12 bg-white shadow-lg rounded-lg overflow-hidden">
                                            <div class="px-6 py-4">
                                                <h4 class="text-xl font-semibold text-gray-800">Historial de Movimientos</h4>
                                            </div>
                                            <div class="overflow-x-auto">
                                                <table class="w-full">
                                                    <thead>
                                                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transacción</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @forelse ($historial as $registro)
                                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $registro->created_at->format('g:i a d-m-Y') }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $registro->tipo_transaccion === 'entrada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                                        {{ $registro->tipo_transaccion }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $registro->cantidad }}</td>
                                                                <td class="px-6 py-4 text-sm text-gray-900">{{ $registro->descripcion }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $registro->usuario->name ?? 'N/A' }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No hay registros.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="flex flex-row space-x-4">
                                        {{-- <button wire:click=""
                                            class="p-3 bg-black rounded-full text-white w-full font-semibold">
                                            Guardar
                                        </button> --}}
                                        <button wire:click="closeVerModal"
                                            class="p-3 bg-white border rounded-full w-full font-semibold">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if ($registroModal)
                    <div
                        class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                        <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                            <div class="w-full">
                                <div class="m-8 my-20 max-w-[400px] mx-auto">
                                    <div class="mb-8">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            {{ $tipo_transaccion === 'salida' ? 'Usar Reactivo' : 'Ingresar Reactivo' }}
                                        </h3>

                                        <form wire:submit="usarOIngresar" class="space-y-4">


                                            <div>
                                                <label for="nombre"
                                                    class="block text-sm font-medium text-gray-700">Nombre</label>
                                                <input disabled type="text" id="nombre"
                                                    wire:model.defer="nombre"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('nombre')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="flex">
                                                <div>
                                                    <label for="cantidad_disponible"
                                                        class="block text-sm font-medium text-gray-700">Cantidad
                                                        Actual</label>
                                                    <input disabled type="number" step="0.01"
                                                        id="cantidad_disponible"
                                                        wire:model.defer="cantidad_disponible"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    @error('cantidad_disponible')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="ml-2">
                                                    <label for="unidad_medida"
                                                        class="block text-sm font-medium text-gray-700">U/M</label>
                                                    <select disabled id="unidad_medida"
                                                        wire:model.defer="unidad_medida"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        <option value="">Seleccione una Unidad de Medida</option>
                                                        <option value="g">Gramos (g)</option>
                                                        <option value="mg">Miligramos (mg)</option>
                                                        <option value="ml">Mililitros (ml)</option>
                                                        <option value="l">Litros (l)</option>
                                                    </select>

                                                    @error('unidad_medida')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div>
                                                <label for="disponibilidad"
                                                    class="block text-sm font-medium text-gray-700">Disponibilidad</label>
                                                <select disabled id="disponibilidad" wire:model.defer="disponibilidad"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione una Disponibilidad</option>
                                                    <option value="total">Total</option>
                                                    <option value="media">Media</option>
                                                    <option value="poca">Poca</option>
                                                    <option value="no hay">No hay</option>
                                                </select>
                                                @error('disponibilidad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Cantidad a Modificar -->
                                            <div class="mb-4">
                                                <label for="cantidad"
                                                    class="block text-sm font-medium text-gray-700">Cantidad a
                                                    {{ $tipo_transaccion === 'salida' ? 'usar' : 'ingresar' }}</label>
                                                <input type="number" step="0.01" wire:model.defer="cantidad"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                @error('cantidad')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Tipo de Transacción -->
                                            <div class="mb-4">
                                                <label for="tipo_transaccion"
                                                    class="block text-sm font-medium text-gray-700">Tipo de
                                                    Transacción</label>
                                                <select id="tipo_transaccion" wire:model.defer="tipo_transaccion"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Seleccione un tipo de transacción</option>

                                                    @if ($tipo_transaccion === 'salida')
                                                        <option value="salida">Salida</option>
                                                        <option value="de baja">De Baja</option>
                                                        <option value="donacion">Donación</option>
                                                        <option value="prestamo">Préstamo</option>
                                                    @endif

                                                    @if ($tipo_transaccion === 'entrada')
                                                        <option value="entrada">Entrada</option>
                                                    @endif


                                                </select>
                                                @error('tipo_transaccion')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Descripción -->
                                            <div class="mb-4">
                                                <label for="descripcion"
                                                    class="block text-sm font-medium text-gray-700">Descripción</label>
                                                <textarea id="descripcion" wire:model.defer="descripcion"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                                @error('descripcion')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>

                                    <div class="flex flex-row space-x-4">
                                        <button wire:click="usarOIngresar"
                                            class="p-3 bg-black rounded-full text-white w-full font-semibold">
                                            {{ $tipo_transaccion === 'salida' ? 'Usar Reactivo' : 'Ingresar Reactivo' }}
                                        </button>
                                        <button wire:click="closeRegistroModal"
                                            class="p-3 bg-white border rounded-full w-full font-semibold">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
