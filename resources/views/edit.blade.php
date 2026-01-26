<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="center">

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <label class="labels_post">Title</label>
                <input type="text" name="title"
                       class="inputs_post"
                       value="{{ $post->title }}">

                <label class="labels_post">Description</label>
                <input type="text" name="description"
                       class="inputs_post"
                       value="{{ $post->description }}">

                <label class="labels_post">Status</label>
                <select name="status" class="inputs_post">
                    <option value="pending" @selected($post->status === 'pending')>
                        Pending
                    </option>
                    <option value="completed" @selected($post->status === 'completed')>
                        Completed
                    </option>
                </select>

                <button type="submit" class="btn_post">
                    UPDATE
                </button>
            </form>

        </section>
    </div>
</x-app-layout>
