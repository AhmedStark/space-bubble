
<!DOCTYPE html>
<html lang="en">
<head>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="public" content="{{ URL::to('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<div id="app">
<main-template admin >
<div slot="content">
@yield('content')

</div>
</main-template>
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
</html>
