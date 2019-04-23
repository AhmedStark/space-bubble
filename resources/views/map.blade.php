@extends('main-template')
@section('content')
<nav-bar></nav-bar>
<map-{{$id}} id="{{$id}}" :nav="{{json_encode($nav)}}"></map-{{"$id"}}>

@endSection