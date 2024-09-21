<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between">
                        <div>Laboratorios</div>
                        <div class="flex items-center">
                            <form action="{{ route('livewire.laboratorio-view') }}" method="GET" class="flex">
                                <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <select name="perPage" onchange="this.form.submit()" class="ml-4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ([10, 25, 50, 100] as $value)
                                        <option value="{{ $value }}" {{ request('perPage') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-4 px-4 py-2 bg-red-500 text-white rounded-md">Buscar</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coordinador</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ciudad</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($laboratorios as $laboratorio)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->ubicacion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->coordinador }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->telefono_coordinador }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laboratorio->correo_coordinador }}</td>
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
        </div>
    </div>
</x-app-layout>