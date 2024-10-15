<div class="py-12">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="mt-8 text-2xl flex justify-between">
                    <div class="font-bold uppercase">Proveedores</div>
                    <div class="flex items-center">
                        <button wire:click="openModal" class="px-4 py-2 bg-red-500 text-white rounded-md mr-4">
                            Crear Proveedor
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
                                    Crear Nuevo Proveedor
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
                                        <label for="telefono"
                                            class="block text-sm font-medium text-gray-700">Teléfono
                                            </label>
                                        <input type="text" id="telefono"
                                            wire:model.defer="telefono"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('telefono')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="direccion"
                                            class="block text-sm font-medium text-gray-700">Direccion</label>
                                        <input type="text" id="direccion" wire:model.defer="direccion"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('direccion')
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
                                    
                                    <div>
                                        <label for="pais"
                                            class="block text-sm font-medium text-gray-700">Pais</label>
                                        <input type="email" id="pais"
                                            wire:model.defer="pais"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('pais')
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
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('nombre')">
                            Nombre</th>
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('telefono')">
                            Telefono</th>
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('direccion')">
                            Direccion</th>
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('ciudad')">
                            Ciudad</th>
                        <th class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('pais')">
                            Pais</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->telefono }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->direccion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->ciudad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->pais }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $proveedores->links() }}
        </div>
    </div>
</div>
