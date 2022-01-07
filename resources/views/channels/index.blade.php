<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Channels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-4 bg-zinc-200 ">
                    <h1>All Channels</h1>
                </div>

                <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-4 pt-6 gap-4">

                    @foreach($channels as $channel)
                        <div class="rounded border-1 shadow p-1px
                                    bg-zinc-50 dark:bg-zinc-800 border-zinc-400 dark:border-zinc-600 ">
                            <div class="p-4 sm:p-5">
                                <p class="text-zinc-300 p-0 m-0">ICON HERE</p>
                                <p tabindex="0"
                                   class="focus:outline-none text-base leading-5 pt-6 text-zinc-700 dark:text-zinc-100">
                                   {{$channel->name}}
                                </p>
                                <div class="flex items-center justify-between pt-4">
                                    <a href="#"
                                       class="rounded p-1 px-4 bg-blue-200 hover:bg-blue-500 hover:text-zinc-50
                                              focus:bg-blue-500 focus:text-zinc-50 animation ease-in-out duration-150
                                              focus:outline-none"
                                       role="button">
                                       Details
                                    </a>
                                    @auth()
                                        <a href="#"
                                           class="rounded p-1 px-4 bg-amber-200 hover:bg-amber-500 hover:text-zinc-50
                                                  focus:bg-amber-500 focus:text-zinc-50 animation ease-in-out duration-150
                                                  focus:outline-none"
                                           role="button">
                                           Edit
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

