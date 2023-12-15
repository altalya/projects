<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($images as $img)
        <img src="{{asset('storage/'.$img->image)}}" width="300px" height="300px" alt="no image">
        <p>{{$img->title}}</p>
    @endforeach
</body>
</html>