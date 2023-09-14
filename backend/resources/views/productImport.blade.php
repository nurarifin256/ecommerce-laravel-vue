<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('products.import.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <p>CSV File</p><br>
        <input type="file" name="csv"> <br>
        <button type="submit">Import</button>
    </form>
</body>
</html>