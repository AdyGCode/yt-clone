<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-4 bg-stone-700">
                    <h3 class="text-2xl text-bold text-stone-200">
                        Confirm Delete Video
                    </h3>
                </div>

                <div class="container mx-auto px-4 py-1 mt-6 flex flex-row">
                    <div class="flex-none w-full lg:w-4/5 dark:bg-gray-800 px-4 py-2">
                        <p tabindex="0"
                           class="focus:outline-none text-base text-stone-800 dark:text-stone-50 text-xl">
                            {{ $video->title ?? "ERROR: Missing video title" }}
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
                        <p tabindex="0"
                           class="focus:outline-none text-base leading-5 text-stone-800 dark:text-stone-50 text-xs
                                       xs:text-sm">
                            Available {{ $video->public ? 'Public': "Private" }}ly
                        </p>
                        <p tabindex="0"
                           class="focus:outline-none text-base leading-5 text-stone-800 dark:text-stone-50 text-xs
                                       xs:text-sm">
                            Added by {{ $video->channel->user->name}} on {{ $video->created_at }}
                        </p>
                    </div>

                    <img src="{{ asset('images/'.($video->image ?? "video.png")) }}"
                         class="w-full lg:w-1/5  rounded bg-gray-100 dark:bg-gray-700"
                         alt="cover image for {{$video->name}}"
                    />
                </div>

                <form action="{{ route('videos.destroy', ['video'=>$video]) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="container mx-auto px-4 py-1 my-6 mb-4 flex flex-row">

                        <a href="{{ route('videos.index') }}"
                           class="rounded p-1 px-4 border border-1 mr-4
                          border-stone-500 bg-stone-50 text-stone-900
                          hover:border-stone-900 hover:bg-stone-500 hover:text-stone-50
                          focus:border-stone-900 focus:bg-stone-500 focus:text-stone-50 focus:outline-none
                          animation ease-in-out duration-300"
                           role="button">
                            Back to Videos
                        </a>
                        @auth()
                            <a href="{{ route('videos.show', ['video'=>$video]) }}"
                               class="rounded p-1 px-4 border border-1 mr-4
                              border-blue-700 bg-blue-50 text-blue-700
                              hover:border-blue-900 hover:bg-blue-500 hover:text-blue-50
                              focus:border-blue-900 focus:bg-amber-500 focus:text-blue-50 focus:outline-none
                              animation ease-in-out duration-300"
                               role="button">
                                Cancel Delete
                            </a>

                            <button
                                    class="rounded p-1 px-4 border border-1
                              border-red-300 bg-red-50 text-red-500
                              hover:border-red-900 hover:bg-red-500 hover:text-red-50
                              focus:border-red-900 focus:bg-red-500 focus:text-red-50 focus:outline-none
                              animation ease-in-out duration-300"
                                    role="button">
                                Confirm
                            </button>
                        @endauth
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

