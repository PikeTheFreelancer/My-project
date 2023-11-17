@extends('layouts.app')

@section('title', '404 - Not found')
@section('content')
<div class="not-found-page page">
    <h1>{{ __($title) }}</h1>
    <br>
    <h5>{{$content}}</h5>
    <br>
    <img src="{{asset('images/pages/404.gif')}}" alt="">
</div>
@endsection