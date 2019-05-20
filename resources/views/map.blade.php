@extends('main-template')
@section('content')
<map-{{$id}} id="{{$id}}" :nav="{{json_encode($nav)}}"></map-{{"$id"}}>

@endSection