@extends('layouts.app')

@section('banner')
    <div class="banner">
        <div class="text-container">
            <div class="text-animate" data-text-arr='["Vermilion Center", "{{__('messages.banner.text2')}}", "{{__('messages.banner.text3')}}"]'>
                <h1>Vermilion Center</h1>
            </div>
            <div id="welcome">anchor</div>
        </div>
    </div>
@endsection
@section('content')
<div class="home-page page">
    <div class="section-container section-community bg-white" data-aos="fade-up">
        <div class="text-image-block">
            <div class="text">
                <h2>{{__('messages.welcome')}}</h2>
                <div class="ti-content">
                    <p>
                        {!!__('messages.welcome.desc1')!!}
                    </p>
                </div>
                <div class="ti-content">
                    <p>
                        {!!__('messages.welcome.desc2')!!}
                    </p>
                </div>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/kanto.gif')}}" alt="kanto.gif">
            </div>
        </div>
    </div>
    <div class="section-container section-community bg-white" data-aos="fade-up">
        <h2>{{__('messages.community')}}</h2>
        <div class="card-body">
            <a class="shiny home-item water glass" href="{{ route('newsfeed') }}">
                <div class="image-container">
                    <img src="{{ asset('images/news.png') }}" alt="news.png">
                </div>
            </a>

            <a class="shiny home-item grass glass" href="{{ route('market') }}">
                <div class="image-container">
                    <img src="{{ asset('images/pokemart.png') }}" alt="pokemart.png">
                </div>
            </a>
        </div>
    </div>
    <div class="section-container bg-white" data-aos="fade-up">
        <div class="text-image-block reverse">
            <div class="text">
                <h2>{{__('messages.recommended_game')}}</h2>
                <div class="ti-content">
                    <p>
                        {{__('messages.rg_desc')}}
                    </p>
                </div>
                <div class="cta-links">
                    <a class="btn btn-primary" href="https://pokemonrevolution.net/">{{__('messages.visit_pro')}}</a>
                    <a class="btn btn-secondary" href="{{route('newsfeed')}}">{{__('messages.see_posts')}}</a>
                </div>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/pro_image.png')}}" alt="pro_image.png">
            </div>
        </div>
    </div>

    <div class="section-container bg-white" data-aos="fade-up">
        <div class="text-image-block">
            <div class="text">
                <h2>{{__('messages.become_us')}}</h2>
                <div class="ti-content">
                    <p>
                        {!! __('messages.become_us_desc') !!}
                    </p>
                </div>
                <div class="cta-links">
                    <a class="btn btn-primary" href="/register">{{__('messages.join_us')}}</a>
                </div>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/squirtle-squad.jpg')}}" alt="squirtle-squad.jpg">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/text-banner.js') }}"></script>
@endpush
