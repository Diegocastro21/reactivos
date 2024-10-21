<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class=" m-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card Reactivos -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-blue-500 bg-blue-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">{{ $totalReactivos }}</h4>
                    <p class="text-gray-600">Reactivos</p>
                </div>
            </div>
        </div>
    
        <!-- Card Estantes -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-green-500 bg-green-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">{{ $totalEstantes }}</h4>
                    <p class="text-gray-600">Estantes</p>
                </div>
            </div>
        </div>
    
        <!-- Card Proveedores -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-red-500 bg-red-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">{{ $totalProveedores }}</h4>
                    <p class="text-gray-600">Proveedores</p>
                </div>
            </div>
        </div>
    
        <!-- Card Inventario Bajo (Ejemplo) -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-yellow-500 bg-yellow-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">15</h4>
                    <p class="text-gray-600">Inventario Bajo</p>
                </div>
            </div>
        </div>
    
        <!-- Card Pedidos Pendientes -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-purple-500 bg-purple-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">7</h4>
                    <p class="text-gray-600">Pedidos Pendientes</p>
                </div>
            </div>
        </div>
    
        <!-- Card Proyectos Activos -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-indigo-500 bg-indigo-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.293 9.707a1 1 0 01-1.414 0L10 9.414l-1.879 1.879a1 1 0 01-1.414-1.414l2.293-2.293a1 1 0 011.414 0l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-semibold">9</h4>
                    <p class="text-gray-600">Reactivos Desactivados</p>
                </div>
            </div>
        </div>


        <div class="col-span-full">

      
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-red-500 to-red-600">
                <h4 class="text-xl font-bold text-white">Historial Global de Movimientos</h4>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reactivo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transacción</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($movimientosGlobales as $movimiento)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $movimiento->created_at->format('g:i a d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $movimiento->reactivo->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movimiento->tipo_transaccion === 'entrada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $movimiento->tipo_transaccion }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $movimiento->cantidad }} {{ $movimiento->reactivo->unidad_medida }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $movimiento->usuario->name ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No hay movimientos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
