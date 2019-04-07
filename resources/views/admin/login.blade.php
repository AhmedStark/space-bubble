@extends('main-template')
@section('content')
<head><title>Admin Login</title></head>
<nav-bar></nav-bar>
@if(isset($response))
<admin-login response="{{$response}}"></admin-login>
@else
<admin-login></admin-login>
@endif
@endSection