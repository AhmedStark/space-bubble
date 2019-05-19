@extends('main-template')
@section('content')
<head><title>Admin Login</title></head>
<nav-bar ></nav-bar>
@if(session('response')!==null)
<admin-login response="{{session('response')}}"></admin-login>
@else
<admin-login></admin-login>
@endif
@endSection
