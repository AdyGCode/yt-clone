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
                        Channel Details
                    </h3>
                </div>

                <div class="container mx-auto px-4 py-1 mt-6 flex flex-row">
                    <p class="flex-none basis-1/4">Name</p>
                    <p class="flex-1 basis-3/4">{{ $channel->name ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Owner</p>
                    <p class="flex-1 basis-3/4">{{ $channel->user->name ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Slug</p>
                    <p class="flex-1 basis-3/4">{{ $channel->slug ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 flex flex-row">
                    <p class="flex-none basis-1/4">Public</p>
                    <p class="flex-1 basis-3/4">{{ $channel->public ? 'Yes': "No" }}</p>
                </div>
                <div class="container mx-auto my-1 px-4 py-1 flex flex-row border border-0 border-b-1 border-stone-200">
                    <p class="flex-none basis-1/4">Description</p>
                    <p class="flex-1 basis-3/4">{{ $channel->description ?? "-" }}</p>
                </div>
                <div class="container mx-auto px-4 py-1 mb-6 flex flex-row">
                    <p class="flex-none basis-1/4">Channel Image</p>
                    <p class="flex-1 basis-3/4">{{ $channel->image ?? "-" }}</p>
                </div>

                <div class="container mx-auto px-4 py-1 my-6 mb-4 flex flex-row">

                    <a href="{{ route('channels.index') }}"
                       class="rounded p-1 px-4 border border-1 mr-4
                          border-stone-500 bg-stone-50 text-stone-900
                          hover:border-stone-900 hover:bg-stone-500 hover:text-stone-50
                          focus:border-stone-900 focus:bg-stone-500 focus:text-stone-50 focus:outline-none
                          animation ease-in-out duration-300"
                       role="button">
                        Back to Channels
                    </a>
                    @auth()
                        <a href="{{ route('channels.edit', ['channel'=>$channel]) }}"
                           class="rounded p-1 px-4 border border-1 mr-4
                              border-blue-700 bg-blue-50 text-blue-700
                              hover:border-blue-900 hover:bg-blue-500 hover:text-blue-50
                              focus:border-blue-900 focus:bg-amber-500 focus:text-blue-50 focus:outline-none
                              animation ease-in-out duration-300"
                           role="button">
                            Edit Channel
                        </a>

                        <a href="{{ route('channels.delete', ['channel'=>$channel]) }}"
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

