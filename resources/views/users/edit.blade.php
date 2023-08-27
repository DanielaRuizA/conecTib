<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edición De Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <span class="text-base font-semibold leading-7 text-gray-900 uppercase">ID</span>
                            <span class="px-6 py-6 mt-1 max-w-2xl leading-6 text-sm text-gray-700">{{$user->id}}</span>
                        </div>
                        <div>
                            <span class="text-base font-semibold leading-7 text-gray-900 uppercase">Email</span>
                            <span
                                class="px-6 py-6 mt-1 max-w-2xl leading-6 text-sm text-gray-700">{{$user->email}}</span>
                        </div>
                        <div>
                            <span class="text-base font-semibold leading-7 text-gray-900 uppercase">Cédula</span>
                            <span
                                class="px-6 py-6 mt-1 max-w-2xl leading-6 text-sm text-gray-700">{{$user->identification_number}}
                            </span>
                        </div>
                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Nombre</label>
                        <span class="text-xs text-red-600">@error('name') {{ $message }} @enderror</span>

                        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700"
                            value="{{ old('name', $user->name) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Celular</label>
                        <span class="text-xs text-red-600">@error('phone') {{ $message }} @enderror</span>

                        <input type="text" name="phone"
                            class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700"
                            value="{{ old('phone', $user->phone) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Fecha De
                            Nacimiento</label>
                        <span class="text-xs text-red-600">@error('date_of_birth') {{ $message }} @enderror</span>

                        <input type="date" name="date_of_birth"
                            class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700" rows="5"
                            value="{{old('date_of_birth',$user->date_of_birth) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Código De
                            Ciudad</label>
                        <span class="text-xs text-red-600">@error('city_code') {{ $message }} @enderror</span>

                        <input type="text" name="city_code"
                            class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700" rows="5"
                            value="{{old('city_code',$user->city_code) }}">

                        <div class="flex justify-between items-center">
                            <a href="{{ route('users.index') }}"
                                class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700">Volver</a>

                            <input type="submit" value="Enviar"
                                class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700"
                                onclick="return confirm('¿Desea Editar El Usuario?')">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>