<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between">
                        <div class="uppercase font-bold">Estantes</div>
                        <div class="flex items-center">
                            <button wire:click="openModal" class="px-4 py-2 bg-red-500 text-white rounded-md mr-4">
                                Crear Estante
                            </button>

                            <input wire:model.live="search" type="text" placeholder="Buscar..."
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <select wire:model.live="perPage"
                                class="ml-4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ([10, 25, 50, 100] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            @if ($showModal)
                <div
                    class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                    <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                        <div class="w-full">
                            <div class="m-8 my-20 max-w-[400px] mx-auto">
                                <div class="mb-8">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Crear Nuevo Estante
                                    </h3>
                                    <form wire:submit.prevent="guardar" class="space-y-4">
                                        <div>
                                            <label for="no_estante"
                                                class="block text-sm font-medium text-gray-700">Número de
                                                Estante</label>
                                            <input type="text" id="no_estante" wire:model.defer="no_estante"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('no_estante')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="descripcion"
                                                class="block text-sm font-medium text-gray-700">Descripción</label>
                                            <input type="text" id="descripcion" wire:model.defer="descripcion"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('descripcion')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div>
                                            <label for="filas"
                                                class="block text-sm font-medium text-gray-700">Filas</label>
                                            <input type="number" id="filas" wire:model.defer="filas"
                                                min="1" max="7"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('filas')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div>
                                            <label for="columnas"
                                                class="block text-sm font-medium text-gray-700">Columnas</label>
                                            <input type="number" id="columnas" wire:model.defer="columnas"
                                                min="1" max="5"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('columnas')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="laboratorio_id"
                                                class="block text-sm font-medium text-gray-700">Laboratorio</label>
                                            <select id="laboratorio_id" wire:model.defer="laboratorio_id"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <option value="">Seleccione un laboratorio</option>
                                                @foreach ($laboratorios as $laboratorio)
                                                    <option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('laboratorio_id')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>

                                <div class="flex flex-row">
                                    <button wire:click="guardar"
                                        class="p-3 bg-black rounded-full text-white w-full font-semibold">
                                        Guardar
                                    </button>
                                    <button wire:click.prevent="closeModal"
                                        class="p-3 bg-white border rounded-full w-full font-semibold">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
                                wire:click="order('no_estante')">
                                Número de Estante</th>
                            <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('descripcion')">
                                Descripción</th>
                            <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('laboratorio_id')">
                                Laboratorio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($estantes as $estante)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estante->no_estante }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estante->descripcion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $estante->laboratorio->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $estantes->links() }}
            </div>
        </div>
    </div>
</div>
