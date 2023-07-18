<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Blogs
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex items-center justify-center mt-4" style="margin-bottom: 20px">
            <a href="new-blog">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    New Blog
                </button>
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($blogs as $blog)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold">{{ $blog->title }}</h3>
                        <p>{!! html_entity_decode($blog->content) !!}</p>
                        @if ($blog->thumbnail)
                            <img src="{{ Storage::url($blog->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 mt-4">
                        @endif

                        @if ($blog->audio)
                            <audio controls class="mt-4">
                                <source src="{{ Storage::url($blog->audio) }}" type="audio/mpeg">
                            </audio>
                        @endif

                        <div class="flex items-center mt-4">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
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
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
