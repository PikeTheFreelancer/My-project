@extends('layouts.app')

@section('banner')
    <div class="banner">
        <div class="text-container">
            <div class="text-animate">
                <h1>Vermilion Center</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="home-page page">
    <div class="section-container">
        <h2>Visit our community</h2>
        <div class="card-body" data-aos="fade-up">
            <a class="shiny home-item water glass" href="{{ route('newsfeed') }}">
                <div class="image-container">
                    <img src="{{ asset('images/news.png') }}" alt="">
                </div>
            </a>

            <a class="shiny home-item grass glass" href="{{ route('market') }}">
                <div class="image-container">
                    <img src="{{ asset('images/pokemart.png') }}" alt="">
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
