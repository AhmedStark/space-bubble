@extends('main-template')
@section('content')
<nav-bar></nav-bar>
<admin-area area-name ="{{$area->name}}"></admin-area>
@endSection