    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between">
                        <div>Laboratorios</div>
                        <div class="flex items-center">
                            <button wire:click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded-md mr-4">
                                Crear Laboratorio
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
                                        Crear Nuevo Laboratorio
                                    </h3>

                                    <form wire:submit.prevent="guardar" class="space-y-4">
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
                                            <label for="ubicacion"
                                                class="block text-sm font-medium text-gray-700">Ubicación</label>
                                            <input type="text" id="ubicacion" wire:model.defer="ubicacion"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('ubicacion')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="coordinador"
                                                class="block text-sm font-medium text-gray-700">Coordinador</label>
                                            <input type="text" id="coordinador" wire:model.defer="coordinador"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('coordinador')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="telefono_coordinador"
                                                class="block text-sm font-medium text-gray-700">Teléfono
                                                del
                                                Coordinador</label>
                                            <input type="text" id="telefono_coordinador"
                                                wire:model.defer="telefono_coordinador"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('telefono_coordinador')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="correo_coordinador"
                                                class="block text-sm font-medium text-gray-700">Correo del
                                                Coordinador</label>
                                            <input type="email" id="correo_coordinador"
                                                wire:model.defer="correo_coordinador"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('correo_coordinador')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="ciudad"
                                                class="block text-sm font-medium text-gray-700">Ciudad</label>
                                            <input type="text" id="ciudad" wire:model.defer="ciudad"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('ciudad')
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ubicación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Coordinador</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Teléfono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ciudad</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($laboratorios as $laboratorio)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->ubicacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->coordinador }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $laboratorio->telefono_coordinador }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $laboratorio->correo_coordinador }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->ciudad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $laboratorios->links() }}
            </div>
        </div>
    </div>
