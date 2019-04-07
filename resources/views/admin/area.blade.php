@extends('main-template')
@section('content')
<head><title>Area {{$area->name}}</title></head>
<nav-bar></nav-bar>
<admin-area id="{{$area->id}}" area-name ="{{$area->name}}"></admin-area>
@endSection