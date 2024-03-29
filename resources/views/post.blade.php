@extends('layouts.app')

@section('content')
<div class="market-page page">
    <div class="page-title">
        <h1>
            {{ __('Post') }}
        </h1>
    </div>
    <div class="section-container">
        <div class="card-body">
            <div class="merchandise" data-post-id="{{ $post->id }}" data-author-id="{{$post->user_id}}">
                <div class="avatar-field desktop">
                    <p>{{ __('community.author') }}:</p>
                    <p><a class="hover-underline" href="{{route('profile', $post->userId)}}">{{$post->username}}</a></p>
                    @if ($post->avatar)
                        <img src="{{asset($post->avatar)}}" alt="avatar">
                    @else
                        <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                    @endif
                </div>
                <div class="merchandise-details">
                    <div class="post-details">
                        <h2>{{ $post->title }}</h2>
                        <div class="post-content limit-content">{!! $post->content !!}</div>
                        <div class="mobile">
                            <p>{{ __('community.author') }}: <a href="{{route('profile', $post->userId)}}">{{$post->username}}</a></p>
                        </div>
                        <span class="see-more-btn" data-more="{{ __('community.see_more') }}" data-less="{{ __('community.see_less') }}">
                            {{ __('community.see_more') }}
                        </span>
                        
                    </div>
                    
                    {{-- comment appended here --}}
                    <div class="comment-place">
                        @if ($post->max_size > 3)
                            <a href="#" class="load-prev-comments">
                                {{__('community.load_comment')}}
                                <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                            </a>
                        @endif
                        <div class="comments-list">
                            @foreach ($post->comments as $comment)
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
                                            @if ($comment->user_id == $post->user_id)
                                                <small class="user-label">{{__('community.author')}}</small>
                                            @endif
                                        </div>
                                        <p class='comment-content'>{{$comment->comment}}</p>
                                        <p class='comment-action'>
                                            @if (Auth::user() && $comment->user_id == Auth::user()->id)
                                                <a href="#" class="edit-comment">{{__('community.edit')}}</a>
                                                <a href="#" class="delete-comment">{{__('community.delete')}}</a>
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
                                                    <a href="#" class="save-comment">{{__('community.save')}}</a>
                                                    <a href="#" class="cancel-edit">{{__('community.cancel')}}</a>
                                                </p>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @guest
                    @else
                        <form id="form-comment" class="form-comment" action="">
                            @csrf
                            <div class="form-field">
                                <textarea class="comment" name="comment" placeholder="{{__('community.comment_text')}}"></textarea>
                                <button class="btn btn-primary btn-comment white-space-nowrap">{{__('community.comment')}}</button>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection