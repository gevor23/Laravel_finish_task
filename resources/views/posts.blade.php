<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="px-40 py-12">
        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:10px; margin-bottom:20px; border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="posts-header">
            <h1 style="font-size: 30px">My Posts</h1>

            <div class="actions">
                <a href="{{route('posts.info')}}" class="btn view">View All Posts</a>
                <form action="{{ route('posts.destroyAll') }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete ALL posts?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn delete">Delete All</button>
                </form>
            </div>
        </div>

        @if($posts->count())
            @foreach($posts as $post)
                <div class="post-card py-4 border-b-2">
                    <p><strong>Title:</strong> {{ $post->title }}</p>
                    <p style="margin-bottom: 10px"><strong>Description:</strong> {{ $post->description }}</p>
                    <div class="post-actions">
                        <a href="{{ route('posts.edit', $post) }}" class="btn edit">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete it?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>

                        <a href="{{ route('posts.show', $post) }}" class="btn view">
                            View
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts yet.</p>
        @endif

    </div>

</x-app-layout>
