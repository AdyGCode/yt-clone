<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-4 bg-stone-700">
                    <h3 class="text-2xl text-bold text-stone-200">
                        All Videos
                    </h3>
                </div>

                <div class="container mx-auto grid grid-cols-1 p-4 pt-6 gap-4">
                    @foreach($videos as $video)

                        <div class="flex items-center justify-between w-full border border-stone-400 rounded">
                            <div class="flex flex-col lg:flex-row w-full items-start lg:items-center rounded bg-white shadow">
                                <img src="{{ asset('images/'.($video->image ?? "video.png")) }}"
                                     class="w-full lg:w-1/5  rounded-l bg-gray-100 dark:bg-gray-700"
                                     alt="cover image for {{$video->name}}"
                                />

                                <div class="w-full lg:w-3/5 dark:bg-gray-800 px-4 py-2">
                                    <p tabindex="0"
                                       class="focus:outline-none text-base text-stone-800 dark:text-stone-50 text-xl">
                                        {{$video->title}}
                                    </p>
                                    <p tabindex="0"
                                       class="focus:outline-none text-base leading-5 text-stone-800 dark:text-stone-50
                                       line-clamp-3 xs:line-clamp-2">
                                        {{$video->description}}
                                    </p>
                                    <p tabindex="0"
                                       class="focus:outline-none text-base leading-5 text-stone-800 dark:text-stone-50 text-xs
                                       xs:text-sm">
                                        Length: {{$video->duration}}
                                    </p>
                                </div>

                                <div class="w-full lg:w-1/5 dark:bg-gray-800 px-4 py-2">
                                    <div class="flex items-center pt-4">
                                        <a href="{{route('videos.show', ['video'=>$video])}}"
                                           class="rounded p-1 px-4 mr-4 border border-1
                                          border-blue-500 bg-blue-50 text-blue-900
                                          hover:border-blue-900 hover:bg-blue-500 hover:text-blue-50
                                          animation ease-in-out duration-300"
                                           role="button">
                                            Details
                                        </a>
                                        @auth()
                                            <a href="{{route('videos.edit', ['video'=>$video])}}"
                                               class="rounded p-1 px-4 border border-1
                                              border-stone-300 bg-stone-50 text-stone-500
                                              hover:border-stone-900 hover:bg-stone-500 hover:text-stone-50
                                              animation ease-in-out duration-300"
                                               role="button">
                                                Edit
                                            </a>
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>

            </div>
        </div>

    </div>
</x-app-layout>

