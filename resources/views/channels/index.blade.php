<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Channels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-4 bg-stone-700">
                    <h3 class="text-2xl text-bold text-stone-200">
                        All Channels
                    </h3>
                </div>

                <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-4 pt-6 gap-4">

                    @foreach($channels as $channel)
                        <div class="rounded border border-stone-400 border-1 rounded shadow
                                    bg-stone-50 dark:bg-stone-800 ">
                            <div class="p-4 rounded">
                                <p tabindex="0"
                                   class="focus:outline-none text-base leading-5 -m-4 mb-2 rounded-t p-4
                                            text-stone-50 bg-stone-500 border-1 border-stone-400">
                                    {{$channel->name}}
                                </p>

                                <p class="text-stone-600 p-0 m-0 h-32">
                                    <img src="{{ asset('images/'.($channel->image ?? "video.png")) }}"
                                         class="mx-auto max-h-32 rounded-lg" alt="cover image for {{$channel->name}}">
                                </p>

                                <div class="flex items-center pt-4">
                                    <a href="{{route('channels.show', ['channel'=>$channel])}}"
                                       class="rounded p-1 px-4 mr-4 border border-1
                                          border-blue-500 bg-blue-50 text-blue-900
                                          hover:border-blue-900 hover:bg-blue-500 hover:text-blue-50
                                          focus:border-blue-900 focus:bg-blue-500 focus:text-blue-50 focus:outline-none
                                          animation ease-in-out duration-300"
                                       role="button">
                                        Details
                                    </a>
                                    @auth()
                                        <a href="{{route('channels.edit', ['channel'=>$channel])}}"
                                           class="rounded p-1 px-4 border border-1
                                              border-stone-300 bg-stone-50 text-stone-500
                                              hover:border-stone-900 hover:bg-stone-500 hover:text-stone-50
                                              focus:border-stone-900 focus:bg-stone-500 focus:text-stone-50 focus:outline-none
                                              animation ease-in-out duration-300"
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

