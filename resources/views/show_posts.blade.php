<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach($users as $user)
    <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px">
        <h2>{{ $user->name }}</h2>

        @if($user->posts->count())
            <ul>
                @foreach($user->posts as $post)
                    <li style="border-bottom: 1px solid; list-style-type: square; ">
                        <p><strong>Title:</strong> {{ $post->title }}</p>
                        <p><strong>Description:</strong> {{ $post->description }}</p>
                        <p><strong>Status:</strong> {{ $post->status }}</p>
                        <p><strong>created_at:</strong> {{ $post->created_at->diffForHumans() }}</p>
                        <p><strong>updated_at:</strong> {{ $post->updated_at->diffForHumans() }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>This user not post</p>
        @endif
    </div>
@endforeach
<div style="margin-top: 20px">
    {{ $users->links() }}
</div>
</body>
</html>
