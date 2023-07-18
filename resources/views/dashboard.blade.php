<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($blogs as $blog)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-4">
                            <a href="{{ route('blogs.show', $blog) }}"><h3 class="text-xl font-semibold">{{ $blog->title }}</h3></a>
                            <p class="{{ $blog->author_id === Auth::id() ? 'text-green-500' : 'text-blue-500' }}">Author: {{ $blog->author_id === Auth::id() ? 'Me' : $blog->author->name }}</p>
                            @if ($blog->thumbnail)
                                <img src="{{ Storage::url($blog->thumbnail) }}" alt="Thumbnail" class="w-full h-auto mt-4">
                            @endif
                        </div>
                    </div>
                @endforeach

                @if ($blogs->isEmpty())
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <p>No blogs found.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
