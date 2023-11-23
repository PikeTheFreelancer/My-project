@extends('layouts.app')

@section('content')
<div class="market-page page">
    <div class="page-title">
        <h1>{{ __('community.market') }}</h1>
    </div>
    <div class="card-body">
        @if (isset($merchandises) && count($merchandises) > 0)
            @foreach ($merchandises as $item)
                <div class="merchandise section-container bg-white" data-id="{{ $item->id }}" data-seller-id="{{$item->user_id}}" data-aos="fade-up">
                    <div class="avatar-field desktop">
                        <p>{{ __('community.seller') }}:</p>
                        <p>{{$item->username}}</p>
                        @if ($item->avatar)
                            <img src="{{asset($item->avatar)}}" alt="avatar">
                        @else
                            <img src="{{asset('images/pages/Unknown_person.jpg')}}" alt="Unknown_person.jpg">
                        @endif
                        <div class="price-box">
                            <span>@include('svg.pokedollars')</span>
                            <span class="price">{{ number_format($item->price, 0, ",", ".") }}</span>
                        </div>
                    </div>
                    <div class="merchandise-details">
                        <div class="post-details">
                            <a href="/merchandise/{{$item->id}}">
                                <h2>{{ $item->name }}</h2>
                            </a>
                            <img src="{{$item->image}}" alt="avatar">
                            <p class="merchandise-description limit-content">{!! $item->description !!}</p>
                            <span class="see-more-btn" data-more="{{ __('community.see_more') }}" data-less="{{ __('community.see_less') }}">{{ __('community.see_more') }}</span>
                        </div>
                        
                        <div class="price-box mobile">
                            <span>
                                <img src="{{asset('images/svg/pokedollars.svg')}}" alt="pokedollars.svg">
                            </span>
                            <span class="price">{{ number_format($item->price, 0, ",", ".") }}</span>
                        </div>
                        
                        {{-- comment appended here --}}
                        <div class="comment-place">
                            @if ($item->max_size > 3)
                                <a href="#" class="load-prev-comments">
                                    {{ __('community.load_comment') }}
                                    <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                                </a>
                            @endif
                            <div class="comments-list">
                                @foreach ($item->comments as $comment)
                                    <div id="comment-{{$comment->id}}" class='comment-item'>
                                        <div class='comment-avatar'>
                                            @if ($comment->avatar)
                                                <img src='{{asset($comment->avatar)}}' alt='avatar'>
                                            @else
                                                <img src="{{asset('images/pages/Unknown_person.jpg')}}" alt="Unknown_person.jpg">
                                            @endif
                                        </div>
                                        <div class='comment-col-right'>
                                            <div class="comment-username-container">
                                                <a class='comment-username' href="{{route('profile', $comment->user_id)}}">{{$comment->username}}</a>
                                                @if ($comment->user_id == $item->user_id)
                                                    <small class="user-label">{{ __('community.seller') }}</small>
                                                @endif
                                            </div>
                                            <p class='comment-content'>{{$comment->comment}}</p>
                                            <p class='comment-action'>
                                                @if (Auth::user() && $comment->user_id == Auth::user()->id)
                                                    <a href="#" class="edit-comment">{{ __('community.edit') }}</a>
                                                    <a href="#" class="delete-comment">{{ __('community.delete') }}</a>
                                                @endif
                                                <span class="commented-at">
                                                    {{$comment->timeAgo}}
                                                </span>
                                            </p>

                                            @if (Auth::user() && $comment->user_id == Auth::user()->id)
                                                <form class="edit-comment-form" action="" method="POST">
                                                    @csrf
                                                    <input class="input-border edit-comment-field" type="text" name="comment" value="{{$comment->comment}}">
                                                    <p class='edit-action'>
                                                        <a href="#" class="save-comment">{{ __('community.save') }}</a>
                                                        <a href="#" class="cancel-edit">{{ __('community.cancel') }}</a>
                                                    </p>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <form class="form-comment" action="">
                            @csrf
                            <div class="form-field">
                                <textarea class="comment" name="comment" placeholder="{{ __('community.comment_text') }}"></textarea>
                                <button class="btn btn-primary btn-comment white-space-nowrap">{{ __('community.comment') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection