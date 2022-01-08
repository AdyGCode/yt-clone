<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-800 leading-tight">
            {{ __('Channels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-4 bg-stone-700">
                    <h3 class="text-2xl text-bold text-stone-200">
                        Edit Channel
                    </h3>
                </div>

                <div class="container mx-auto p-4 pt-6 gap-4">

                    <form action="{{route('channels.update', ['channel'=>$channel])}}"
                          method="post">
                    @method('PATCH')
                    @csrf

                    <!-- Channel Name -->
                        <div class="container mx-auto px-4 py-1 mt-6 flex flex-row">
                            <label for="name" class="flex-none basis-1/4">Name</label>
                            <input type="text" class="flex-1 basis-3/4 @error('name') border-red-500 @enderror"
                                   name="name" id="name"
                                   value="{{ old('name')?? $channel->name }}"/>
                        </div>

                        @error('name')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: {{ $message }}</p>
                        </div>
                        @enderror

                    <!-- Channel Owner -->
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <label for="user_id" class="flex-none basis-1/4">Owner</label>
                            <select name="user_id" id="user_id"
                                    class="flex-1 basis-3/4 @error('user_id') border-red-500 @enderror ">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"
                                            @if($user->id === (old('user_id')?? auth()->user()->id)) selected @endif >
                                        {{$user->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @error('user_id')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: Channel owner must be selected</p>
                        </div>
                        @enderror

                    <!-- Channel Slug -->
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <label for="slug" class="flex-none basis-1/4">Slug</label>
                            <input type="text" class="flex-1 basis-3/4 @error('slug') border-red-500 @enderror"
                                   name="slug" id="slug"
                                   value="{{ old('slug')?? $channel->slug }}"/>
                        </div>

                        @error('slug')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: {{ $message }}</p>
                        </div>
                        @enderror

                    <!-- Channel Public/Private -->
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <label for="public" class="flex-none basis-1/4">Public</label>

                            <div class="flex-0 cursor-pointer relative shadow-sm">
                                <input aria-label="public toggle" type="checkbox" name="public" id="public"
                                       class="focus:outline-none focus:bg-stone-500 focus:ring-2 focus:ring-offset-2
                                       focus:ring-stone-700
                                              checkbox w-6 h-6 rounded bg-white absolute m-1 shadow-sm appearance-none
                                              cursor-pointer"
                                       @if(old('public')?? $channel->public) checked @endif />
                                <label for="public" class="toggle-label block w-16 h-8 overflow-hidden rounded bg-stone-300
                                dark:bg-stone-700 cursor-pointer"></label>
                            </div>
                        </div>

                        @error('public')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: {{ $message }}</p>
                        </div>
                        @enderror

                    <!-- Channel Description -->
                        <div class="container mx-auto my-1 px-4 py-1 flex flex-row border border-0 border-b-1 border-stone-200">
                            <label for="description" class="flex-none basis-1/4">Description</label>
                            <textarea id="description" name="description"
                                      class="flex-1 basis-3/4 @error('description') border-red-500 @enderror"
                            >{{ old('description')?? $channel->description }}</textarea>
                        </div>

                        @error('description')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: {{ $message }}</p>
                        </div>
                        @enderror

                    <!-- Channel Image -->
                        <div class="container mx-auto px-4 py-1 mb-6 flex flex-row">
                            <label for="image" class="flex-none basis-1/4">Channel Image</label>
                            <input type="text" class="flex-1 basis-3/4"
                                   name="image" id="image"
                                   value="{{ old('image')?? $channel->image }}"/>
                        </div>

                        @error('image')
                        <div class="container mx-auto px-4 py-1 flex flex-row">
                            <span class="flex-none basis-1/4"></span>
                            <p class="sm text-red-500 py-1 flex-1 basis-3/4">Error: {{ $message }}</p>
                        </div>
                    @enderror

                    <!-- Submission Buttons -->
                        <div class="container mx-auto px-4 py-1 my-6 mb-4 flex flex-row gap-4">
                            <span class="basis-1/4 flex-none"></span>
                            <button type="submit" name="button"
                                    class="rounded p-1 px-4 border border-1 -ml-4
                                       border-green-700 bg-green-100 text-green-700
                                       hover:border-green-900 hover:bg-green-500 hover:text-green-50
                                       focus:border-green-900 focus:bg-green-500 focus:text-green-50 focus:outline-none
                                       animation ease-in-out duration-300">Save Changes
                            </button>

                            <a href="{{route('channels.index')}}"
                               class="rounded p-1 px-4 border border-1
                                  border-stone-300 bg-stone-50 text-stone-500
                                  hover:border-stone-900 hover:bg-stone-500 hover:text-stone-50
                                  focus:border-stone-900 focus:bg-stone-500 focus:text-stone-50 focus:outline-none
                                  animation ease-in-out duration-300">Cancel</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
