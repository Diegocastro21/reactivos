<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between">
                        <div>Reactivos</div>
                        <div class="flex items-center">
                            <button wire:click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded-md mr-4">
                                Crear Reactivo
                            </button>
                            <form wire:submit.prevent="render" class="flex">
                                <input wire:model.debounce.300ms="search" type="text" placeholder="Buscar..."
                                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <select wire:model="perPage"
                                    class="ml-4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ([10, 25, 50, 100] as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                {{-- <button type="submit"
                                    class="ml-4 px-4 py-2 bg-red-500 text-white rounded-md">Buscar</button> --}}
                            </form>
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
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Código</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Disponibilidad</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Marca</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha Vencimiento</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($reactivos as $reactivo)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reactivo->codigo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reactivo->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reactivo->disponibilidad }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reactivo->cantidad_disponible }}
                                            {{ $reactivo->unidad_medida }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reactivo->marca }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $reactivo->fecha_vencimiento->format('d/m/Y') }}</td>
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
                                            Crear Nuevo Reactivo
                                        </h3>

                                        <form wire:submit="guardar" class="space-y-4">
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
                                                {{-- <input type="text" id="unidad_medida"
                                                    wire:model.defer="unidad_medida"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"> --}}
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
                                                    class="block text-sm font-medium text-gray-700">Código de Indicación
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
                                                <label for="nivel_reactivo"
                                                    class="block text-sm font-medium text-gray-700">Nivel de
                                                    Reactivo</label>
                                                <input type="text" id="nivel_reactivo"
                                                    wire:model.defer="nivel_reactivo"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('nivel_reactivo')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="columna_estante"
                                                    class="block text-sm font-medium text-gray-700">Columna del
                                                    Estante</label>
                                                <input type="text" id="columna_estante"
                                                    wire:model.defer="columna_estante"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                @error('columna_estante')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="estante_id"
                                                    class="block text-sm font-medium text-gray-700">ID del
                                                    Estante</label>
                                                {{-- <input type="number" id="estante_id" wire:model.defer="estante_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"> --}}

                                                <select id="estante_id" wire:model.defer="estante_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="">Seleccione un Estante</option>
                                                    @foreach ($estantes as $estante)
                                                        <option value="{{ $estante->id }}">
                                                            {{ $estante->no_estante }} || {{$estante->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('estante_id')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>

                                    <div class="flex flex-row space-x-4">
                                        <button wire:click="guardar"
                                            class="p-3 bg-black rounded-full text-white w-full font-semibold">
                                            Guardar
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
            </div>
        </div>
    </div>
</div>
