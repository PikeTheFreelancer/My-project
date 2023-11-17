@extends('layouts.app')

@section('title', '404 - Not found')
@section('content')
<div class="not-found-page page">
    <h1>{{ __('404 - Not found') }}</h1>
    <br>
    <h5>Page not found.</h5>
    <br>
    <img src="{{asset('images/pages/404.gif')}}" alt="">
</div>
@endsection