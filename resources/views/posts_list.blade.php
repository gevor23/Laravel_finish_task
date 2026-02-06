<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="center">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="labels_post">Title</label>
                <input type="text" name="title" class="inputs_post">

                <label class="labels_post">Description</label>
                <input type="text" name="description" class="inputs_post">

                <label class="labels_post">Status</label>
                <select name="status" class="inputs_post">
                    <option value="pending">
                        Pending
                    </option>
                    <option value="completed">
                        Completed
                    </option>
                </select>
                <input type="file" name="image" class="inputs_post" style="margin-top: 20px;display: block">

                <button type="submit" class="btn_post">SUBMIT</button>
            </form>
        </section>
    </div>
</x-app-layout>
