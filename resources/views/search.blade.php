<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    @if($searchMenu->isNotEmpty())
  
    @foreach ($searchMenu as $search)
        <div class="post-list">
           <p>{{$search->name}}</p>
           <p>{{$search->description}}</p>
           <p>{{$search->price}}</p>
           <button type="button" class="btn btn-outline-primary"><a href="/menudetail/{{$search->id}}" >add to chart</a></button>
        </div>
    @endforeach
@else 
    <div>
        <p>No posts found</p>
    </div>
@endif
</body>
</html>