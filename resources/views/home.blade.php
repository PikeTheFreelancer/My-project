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
    <div class="section-container bg-white" data-aos="fade-up">
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
        <h2>{{__('messages.latests')}}</h2>
        
        <div class="owl-carousel owl-theme">
            @foreach ($posts as $post)
                <div class="post-item">
                    <div class="author">
                        <div class="avartar-frame">
                            @if ($post->avatar)
                                <img src="{{asset($post->avatar)}}" alt="avatar">
                            @else
                                <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                            @endif
                        </div>
                        <div class="author-right">
                            <h4 class="post-title hover-underline ellipsis"><a href="{{route('post', $post->id)}}">{{ $post->title }}</a></h4>
                            <a class="hover-underline ellipsis block" href="{{route('profile', $post->user_id)}}">{{ $post->username }}</a>
                        </div>
                    </div>
                    <div class="post-content">{!! $post->content !!}</div>
                    <div class="view-more">
                        <a class="fw-500 hover-underline" href="{{route('post', $post->id)}}">View more</a>
                    </div>
                    <div class="post-comment">
                        <a class="hover-underline" href="{{route('post', $post->id)}}">
                            <i class="fa-regular fa-comment"></i>
                            <span>{{$post->comments ? $post->comments->count() : 0}}</span>
                        </a>
                        <p><small class="sub-text">{{$post->timeAgo}}</small></p>
                    </div>
                </div>
            @endforeach
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
                <img src="{{asset('images/pages/pro_image.webp')}}" alt="pro_image.webp">
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
                <img src="{{asset('images/pages/squirtle-squad.webp')}}" alt="squirtle-squad.webp">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/text-banner.js') }}" defer></script>
@endpush
