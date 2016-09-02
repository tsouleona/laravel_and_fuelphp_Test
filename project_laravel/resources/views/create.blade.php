<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

</head>
<body>
    {{--<h1>{{ $title }}</h1>--}}
    {{--<form method="post" action="post">--}}
        {{--<div class="form-group">--}}
            {{--<label>標題</label>--}}
            {{--<br>--}}
            {{--<input class="form-control" type="text" id="title"/>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label>內容</label>--}}
            {{--<br>--}}
            {{--<textarea class="form-control" cols="50" rows="15" id="content"></textarea>--}}
        {{--</div>--}}
        {{--<input type="submit" id="ok" value="發表文章"/>--}}
    {{--</form>--}}

    <h1>{{ $title }}</h1>
    {{Form::open(['url'=>'post', 'method'=>'post'])}}
    {{Form::label('title', '標題')}}<br>
    {{Form::text('title')}}<br>
    {{Form::label('content', '內容')}}<br>
    {{Form::textarea('content')}}<br>
    {{Form::submit('發表文章')}}
    {{Form::close()}}
</body>
</html>