<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
            {{ __('Lista De Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="px-6 py-4 flex justify-between items-center">
                    <div class="relative max-w-xs flex items-center">
                        <form action="{{ route('posts.index') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search"
                                    class="block w-full px-4 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                    placeholder="Buscar UserId..." value="{{ request('search') }}" />
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
                    <div class="bg-white py-24 sm:py-32">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">
                            @foreach ($data as $post)
                            <div
                                class=" p-6 mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                                <article class="flex max-w-xl flex-col items-start justify-between">
                                    <div class="relative mt-8 flex items-center gap-x-4">
                                        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="posts" class="w-10 bg-gray-50">
                                        <div class="text-sm leading-6">
                                            <p class="font-semibold text-gray-900">
                                                <span class="absolute inset-0"></span>
                                                Autor {{$post['userId']}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="group relative">
                                        <h3
                                            class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                            <span class="absolute inset-0"></span>
                                            {{ $post['title'] }}
                                        </h3>
                                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $post['body'] }}
                                        </p>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>