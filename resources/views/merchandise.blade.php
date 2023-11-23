@extends('layouts.app')

@section('content')
<div class="market-page page">
    <div class="page-title">
        <h1>{{ __('Merchandise') }}</h1>
    </div>
    <div class="section-container">
        <div class="card-body">
            <div class="merchandise" data-id="{{ $merchandise->id }}" data-seller-id="{{$merchandise->user_id}}">
                <div class="avatar-field desktop">
                    <p>Seller:</p>
                    <p>{{$merchandise->username}}</p>
                    @if ($merchandise->avatar)
                        <img src="{{asset($merchandise->avatar)}}" alt="avatar">
                    @else
                        <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                    @endif
                    <div class="price-box">
                        <span>@include('svg.pokedollars')</span>
                        <span class="price">{{ number_format($merchandise->price, 0, ",", ".") }}</span>
                    </div>
                </div>
                <div class="merchandise-details">
                    <div class="post-details">
                        <a href="/merchandise/{{$merchandise->id}}">
                            <h2>{{ $merchandise->name }}</h2>
                        </a>
                        <img src="{{$merchandise->image}}" alt="merchandise">
                        <p class="merchandise-description limit-content">{!! $merchandise->description !!}</p>
                        <span class="see-more-btn">See more</span>
                    </div>
                    <div class="price-box mobile">
                        <span>
                            <img src="{{asset('images/svg/pokedollars.svg')}}" alt="pokedollars.svg">
                        </span>
                        <span class="price">{{ number_format($merchandise->price, 0, ",", ".") }}</span>
                    </div>
                    
                    {{-- comment appended here --}}
                    <div class="comment-place">
                        @if ($merchandise->max_size > 3)
                            <a href="#" class="load-prev-comments">
                                Load previous comments
                                <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                            </a>
                        @endif
                        <div class="comments-list">
                            @foreach ($merchandise->comments as $comment)
                                <div id="comment-{{$comment->id}}" class='comment-item'>
                                    <div class='comment-avatar'>
                                        @if ($comment->avatar)
                                            <img src='{{asset($comment->avatar)}}' alt='avatar'>
                                        @else
                                            <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                                        @endif
                                    </div>
                                    <div class='comment-col-right'>
                                        <div class="comment-username-container">
                                            <a class='comment-username' href="{{route('profile', $comment->user_id)}}">{{$comment->username}}</a>
                                            @if ($comment->user_id == $merchandise->user_id)
                                                <small class="user-label">seller</small>
                                            @endif
                                        </div>
                                        <p class='comment-content'>{{$comment->comment}}</p>
                                            
                                        <p class='comment-action'>
                                            @if (Auth::user() && $comment->user_id == Auth::user()->id)
                                                <a href="#" class="edit-comment">Edit</a>
                                                <a href="#" class="delete-comment">Delete</a>
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
                                                    <a href="#" class="save-comment">Save</a>
                                                    <a href="#" class="cancel-edit">Cancel</a>
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
                            <textarea id="comment" class="comment" name="comment" placeholder="Leave your comment"></textarea>
                            <button class="btn btn-primary btn-comment">comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection