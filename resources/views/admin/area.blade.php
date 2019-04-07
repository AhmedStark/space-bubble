@extends('main-template')
@section('content')
<nav-bar></nav-bar>
<admin-area id="{{$area->id}}" area-name ="{{$area->name}}"></admin-area>
@endSection