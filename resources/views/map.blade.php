@extends('main-template')
@section('content')
<head>
<title>{{$level_name}}</title>
</head>
<map-{{$id}} id="{{$id}}" name="{{$level_name}}" :nav="{{json_encode($nav)}}"></map-{{"$id"}}>

@endSection