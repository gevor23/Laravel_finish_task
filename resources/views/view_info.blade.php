<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Info') }}
        </h2>
    </x-slot>

    <div class="px-40 py-12">
        <div>
            <div>
            <h1 style="font-size: 30px">My Posts</h1>
            </div>
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="post-card py-4 border-b-2">
                        <p><strong>Title:</strong> {{ $post->title }}</p>
                        <p><strong>Description:</strong> {{ $post->description }}</p>
                        <p><strong>Status:</strong> {{ $post->status }}</p>
                        <p><strong>created_at:</strong> {{ $post->created_at }}</p>
                        <p><strong>updated_at:</strong> {{ $post->updated_at }}</p>
                    </div>
                @endforeach
            @else
                <p>No posts yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>

