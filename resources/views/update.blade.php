<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update</title>
</head>
<body>
    <h3>update data</h3>
    <form action="/update/{{$orderdetail->id}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="number" value="1" min="1" name="qty"> <br>
        <textarea id="note" name="note"></textarea> <br>
        <button id="submit" class="btn btn-primary">update</button>
    </form>
</body>
</html>