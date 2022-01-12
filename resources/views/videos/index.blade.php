<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-stone-200">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-stone-800 overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-4 bg-stone-700">
                    <h3 class="text-2xl text-bold text-stone-200">
                        All Videos
                    </h3>
                </div>

                <div class="container mx-auto grid grid-cols-1 p-4 pt-6 gap-4">
                    @foreach($videos as $video)

                        <div class="flex items-start justify-between w-full mb-4
                                         text-stone-800 dark:text-stone-50
">
                            <div class="flex flex-col lg:flex-row w-full lg:items-start gap-2">
                                <div class="w-full lg:w-1/5 my-0 border border-stone-50 dark:border-stone-600 border-2 rounded
                                shadow shadow-md">
                                    <img src="{{ asset('images/'.($video->image ?? "video.png")) }}"
                                         class="bg-cover rounded-sm"
                                         alt="cover image for {{$video->title}}"
                                    />
                                </div>
                                <div class=" w-full px-4 border border-stone-100 dark:border-stone-600 rounded shadow shadow-md">
                                    <div class="w-full py-4 text-2xl">
                                        <p tabindex="0">
                                            {{$video->title}}
                                        </p>
                                    </div>

                                    <div class="flex flex-wrap flex-col sm:flex-row w-full dark:bg-stone-800 py-2
                                                text-base leading-5 text-stone-800 dark:text-stone-50 text-sm">
                                        <div class="w-1/6">Channel:</div>
                                        <p tabindex="0"
                                           class="w-5/6">
                                            {{$video->channel->name}}
                                        </p>
                                        @if($video->series)
                                            <div class="w-1/6">Series:</div>
                                            <p tabindex="0"
                                               class="w-5/6">
                                                {{$video->series}}
                                            </p>
                                        @endif
                                        @if($video->episode)
                                            <div class="w-1/6">Episode:</div>
                                            <p tabindex="0"
                                               class="w-5/6">
                                                {{$video->episode}}
                                            </p>
                                        @endif
                                        <div class="w-1/6">Length:</div>
                                        <p tabindex="0"
                                           class="w-5/6">
                                            {{$video->duration}}
                                        </p>
                                        @if($video->status)
                                            <div class="w-1/6">Status:</div>
                                            <p tabindex="0"
                                               class="w-5/6">
                                                {{$video->status}}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap flex-col sm:flex-row w-full dark:bg-stone-800 py-2
                                                text-base leading-5 text-stone-800 dark:text-stone-50 text-sm">
                                        <a href="{{route('videos.show', ['video'=>$video])}}"
                                           class="rounded p-1 px-4 mr-4 border border-1
                                          border-blue-500 bg-blue-500 text-blue-50
                                          hover:border-blue-200 hover:bg-blue-900 hover:text-blue-50
                                          animation ease-in-out duration-300"
                                           role="button">
                                            Details
                                        </a>
                                        @auth()
                                            <a href="{{route('videos.edit', ['video'=>$video])}}"
                                               class="rounded p-1 px-4 border border-1
                                          border-purple-500 bg-purple-500 text-purple-50
                                          hover:border-purple-200 hover:bg-purple-900 hover:text-purple-50
                                              animation ease-in-out duration-300"
                                               role="button">
                                                Edit
                                            </a>
                                        @endauth
                                    </div>

                                    <div class="w-full dark:bg-stone-800 py-4 my-4 border border-dotted border-stone-200
                                    dark:border-stone-600 border-top-1 border-l-0 border-r-0 border-b-0">
                                        <p tabindex="0"
                                           class="text-base text-stone-800 dark:text-stone-200">
                                            <em>Description:</em>
                                        </p>
                                        <p tabindex="0"
                                           class="prose leading-5 text-stone-800 dark:text-stone-50
                                       line-clamp-3 xs:line-clamp-2">
                                            {{$video->description}}
                                        </p>
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

