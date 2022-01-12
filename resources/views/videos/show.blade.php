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
                        Confirm Delete Video
                    </h3>
                </div>

                <div class="container mx-auto px-4 py-1 mt-6 flex flex-row">
                    <p class="flex-none basis-1/4">Title</p>
                    <p class="flex-1 basis-3/4">{{ $video->title ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Owner</p>
                    <p class="flex-1 basis-3/4">{{ $video->user->name ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Duration</p>
                    <p class="flex-1 basis-3/4">{{ $video->duration  }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Series/Episode</p>
                    <p class="flex-1 basis-3/4">S{{ $video->series?? "--" }}/E{{$video->episode??"--"}}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Public</p>
                    <p class="flex-1 basis-3/4">{{ $video->public ? 'Yes': "No" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 mb-6 flex flex-row">
                    <p class="flex-none basis-1/4">Thumbnail</p>
                    <p class="flex-1 basis-3/4">{{ $video->thumbnail ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 mb-6 flex flex-row">
                    <p class="flex-none basis-1/4">Description</p>
                    <p class="flex-1 basis-3/4">{{ $video->description ?? "-" }}</p>
                </div>

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
                        <a href="{{ route('videos.delete', ['video'=>$video]) }}"
                           class="rounded p-1 px-4 border border-1
                              border-red-300 bg-red-50 text-red-500
                              hover:border-red-900 hover:bg-red-500 hover:text-red-50
                              focus:border-red-900 focus:bg-red-500 focus:text-red-50 focus:outline-none
                              animation ease-in-out duration-300"
                           role="button">
                            Delete
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

