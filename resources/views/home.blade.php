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
    <div class="section-container section-community bg-white" data-aos="fade-up">
        <h2>{{__('messages.welcome')}}</h2>
        <div class="card-body">
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
    <div class="section-container bg-white" data-aos="fade-up">
        <div class="text-image-block">
            <div class="text">
                <h2>Recommended game</h2>
                <div class="ti-content">
                    <p>
                        "Pokemon revolution online - PRO" is an online game for original Pokemon fans all around the world. This website was made for supporting the game's players. Where you are able to post your topics, trade game items and communicate with other players.
                    </p>
                </div>
                <div class="cta-links">
                    <a class="btn btn-primary" href="https://pokemonrevolution.net/">Visit PRO</a>
                    <a class="btn btn-secondary" href="{{route('newsfeed')}}">See posts</a>
                </div>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/pro_image.png')}}" alt="">
            </div>
        </div>
    </div>

    <div class="section-container bg-white" data-aos="fade-up">
        <div class="text-image-block reverse">
            <div class="text">
                <h2>Became one of us!</h2>
                <div class="ti-content">
                    <p>
                        By register to our website, you are free to make a post in <i>My account</i> > <i>Add new post</i>. You are also able to upload your merchandise for selling on our website in <i>My store</i> > <i>Add new merchandise</i>.
                    </p>
                </div>
                <div class="cta-links">
                    <a class="btn btn-primary" href="/register">Join us</a>
                </div>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/squirtle-squad.jpg')}}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
