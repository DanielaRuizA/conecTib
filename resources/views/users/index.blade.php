<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
            {{ __('Lista De Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="px-6 py-4 flex justify-between items-center">
                    <div class="relative max-w-xs flex items-center">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="s"
                                    class="block w-full px-4 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                    placeholder="Buscar..." value="{{ request('s') }}" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <button type="submit"
                                    class="px-2 bg-gray-800 text-white rounded px-4 py-2">Buscar</button>
                            </div>
                        </form>
                    </div>
                </header>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="mt-4 min-w-full divide-y divide-gray-200 border">
                        <thead
                            class="text-m text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200">
                            <tr>
                                <th class="px-4  bg-gray-50">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'id')</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'name', 'Nombre') </span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'email','Email')</span>
                                </th>
                                <th class="py-3 bg-gray-50 text-left">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'phone','Celular')</span>
                                </th>
                                <th class="px-3 py-3 bg-gray-50 text-left">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'identification_number','Cédula')</span>
                                </th>
                                <th class="px-5 py-3 bg-gray-50">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'date_of_birth','Edad')</span>
                                </th>
                                <th class="px-4 py-3 bg-gray-50 text-left">
                                    <span
                                        class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">@sortablelink(
                                        'city_code','Código Ciudad')</span>
                                </th>
                                <th class="px-3 bg-gray-50 text-left">
                                    <span class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Editar</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-m leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Eliminar</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($users as $user)
                            <tr class="border-b border-gray-200 text-sm">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->id}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->name}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->email}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->phone}}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->identification_number}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                    @php
                                    $dob = new DateTime($user->date_of_birth);
                                    $now = new DateTime();
                                    $age = $now->diff($dob)->y;
                                    echo $age;
                                    @endphp
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{
                                    $user->city_code}}</td>
                                <td class="px-3">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class=" bg-gray-800 text-white rounded px-4 py-2">Editar</a>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <input type="submit" value="Eliminar"
                                            class=" bg-gray-800 text-white rounded px-4 py-2"
                                            onclick="return confirm('¿Desea Eliminar?')">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-4">{{ $users->appends(['s' => request('s')])->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>