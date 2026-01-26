<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="px-40 py-12">
        <div class="post-card p-6 bg-white rounded shadow">
            <p><strong>Title:</strong> {{ $post->title }}</p>
            <p><strong>Description:</strong> {{ $post->description }}</p>
            <p><strong>Status:</strong> {{ $post->status }}</p>
            <p><strong>Created at:</strong> {{ $post->created_at->format('Y-m-d H:i') }}</p>

            <div class="post-actions mt-4">
                <a href="{{ route('posts.edit', $post) }}" class="btn edit">Edit</a>
                <a href="{{ route('posts.index') }}" class="btn view">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>

