
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="app_name" content="restaurant">
        <meta name="public" content="{{ URL::to('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div id="app">
<example-component></example-component>
</div>

</body>

<script src="{{ asset('js/app.js') }}"></script>
</html>
