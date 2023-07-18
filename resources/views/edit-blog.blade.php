<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="title" value="{{ __('Title') }}" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $blog->title)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="content" value="{{ __('Content') }}" />
                            <textarea id="content" class="block mt-1 w-full ckeditor" name="content" rows="6" required>{!! html_entity_decode(old('content', $blog->content)) !!}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="thumbnail" value="{{ __('Thumbnail') }}" />
                            <x-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        </div>

                        @if ($blog->thumbnail)
                            <div class="mt-4">
                                <span>Current Thumbnail:</span>
                                <img src="{{ Storage::url($blog->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 mt-2">
                            </div>
                        @endif

                        <div class="mt-4">
                            <x-label for="audio" value="{{ __('Audio') }}" />
                            <x-input id="audio" class="block mt-1 w-full" type="file" name="audio" />
                        </div>

                        @if ($blog->audio)
                            <div class="mt-4">
                                <span>Current Audio:</span>
                                <audio controls class="mt-4">
                                    <source src="{{ Storage::url($blog->audio) }}" type="audio/mpeg">
                                </audio>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
