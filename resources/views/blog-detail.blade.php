<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold">{{ $blog->title }}</h3>
                    <p class="{{ $blog->author_id === Auth::id() ? 'text-green-500' : 'text-blue-500' }}">Author: {{ $blog->author_id === Auth::id() ? 'Me' : $blog->author->name }} - {{$blog->author->email}}</p>
                    <p>{!! html_entity_decode($blog->content) !!}</p>
                    @if ($blog->thumbnail)
                        <img src="{{ Storage::url($blog->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 mt-4" style="height: 400px; width: 400px">
                    @endif

                    @if ($blog->audio)
                        <audio controls class="mt-4">
                            <source src="{{ Storage::url($blog->audio) }}" type="audio/mpeg">
                        </audio>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold">Comments</h4>
                @foreach ($blog->comments as $comment)
                    <div class="bg-gray-100 p-4 mt-4" style="background-color: #ccc; border:1px solid; border-radius: 10px">
                        <div class="flex items-center">
                            <img src="{{ Storage::url($comment->user->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2">
                            <p class="font-semibold">{{ $comment->user->name }}</p>
                        </div>
                        <p>{{ $comment->content }}</p>
                        <p class="{{ $comment->user_id === Auth::id() ? 'text-green-500' : 'text-blue-500' }}" style="font-style:italic">Posted by: {{ $comment->user_id === Auth::id() ? 'Me' : $comment->user->name }} - {{$comment->user->email}}</p>
                        @if ($comment->user_id === Auth::id() || $blog->author_id === Auth::id())
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold">Add a Comment</h4>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <textarea name="content" rows="2" class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:border-indigo-500"></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
