<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<h1>{{ $title }}</h1>
<div><a href="post/create">新增</a></div>
@if (isset($posts))
    <ol>
        @foreach ($posts as $post)
            <li>
                <a href="post/<?php echo $post->id?>"><?php echo $post->title?></a>
                <a href="post/<?php echo $post->id?>/edit">編輯</a>

        @endforeach
    </ol>
@endif
</body>
</html>