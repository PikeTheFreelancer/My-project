@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="market-page page">
        <div class="card">
            <div class="card-header">{{ __('Market') }}</div>
            <div class="card-body">
                @if (isset($merchandises) && count($merchandises) > 0)
                    @foreach ($merchandises as $item)
                        <div class="merchandise" data-id="{{ $item->id }}" data-seller-id="{{$item->user_id}}">
                            <div class="avatar-field desktop">
                                <img src="{{asset($item->avatar)}}" alt="">
                                <p>seller: {{$item->username}}</p>
                                <div class="price-box">
                                    <span>@include('svg.pokedollars')</span>
                                    <span class="price">{{ number_format($item->price, 0, ",", ".") }}</span>
                                </div>
                            </div>
                            <div class="merchandise-details">
                                <h2>{{ $item->name }}</h2>
                                <img src="{{$item->image}}" alt="">
                                <p class="merchandise-description">{{$item->description}}</p>
                                <div class="price-box mobile">
                                    <span>
                                        <img src="{{asset('images/svg/pokedollars.svg')}}" alt="">
                                    </span>
                                    <span class="price">{{ number_format($item->price, 0, ",", ".") }}</span>
                                </div>
                                
                                {{-- comment appended here --}}
                                <div class="comment-place">
                                    @if ($item->max_size > 3)
                                        <a href="#" class="load-prev-comments">
                                            load previous comments
                                            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                                        </a>
                                    @endif
                                    <div class="comments-list">
                                        @foreach ($item->comments as $comment)
                                            <div id="comment-{{$comment->id}}" class='comment-item'>
                                                <div class='comment-avatar'>
                                                    <img src='{{asset($comment->avatar)}}' alt=''>
                                                </div>
                                                <div class='comment-col-right'>
                                                    <div class="comment-username-container">
                                                        <a class='comment-username' href='#'>{{$comment->username}}</a>
                                                        @if ($comment->user_id == $item->user_id)
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
                                        <textarea class="comment" name="comment" placeholder="leave your comment"></textarea>
                                        <button class="btn btn-primary btn-comment">comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        //event comment
        $(document).on('submit', '.form-comment', function(e) {
            e.preventDefault();
            var seller_id = $(this).parents('.merchandise').data('seller-id');
            var merchandise_id = $(this).parents('.merchandise').data('id');
            var comment = $(this).find('.comment').val();
            var thisForm = $(this);
            // for comment method
            var commentsList = $(this).siblings('.comment-place').children('.comments-list');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/market/comment',
                method: 'POST',
                data: { 
                    comment: comment,
                    merchandise_id: merchandise_id
                },
                success: function(response) {
                    let isSeller = (seller_id == response.user_id) ? true : false;
                    var displayTime = 'just now' ;
                    var commentElement = "<div class='comment-item'>" +
                                        "<div class='comment-avatar'>" +
                                        "<img src='" + response.user_avatar + "' alt=''>" +
                                        "</div>" +
                                        "<div class='comment-col-right'>" +
                                        "<div class='comment-username-container'>"+
                                        "<a class='comment-username' href='#'>" + response.username + "</a>";

                                        if (isSeller) {
                                            commentElement += "<small class='user-label'>seller</small>";
                                        }

                                        commentElement += "</div>" +
                                            "<p class='comment-content'>" + response.comment + "</p>" +
                                            "<p class='commented-at'>" + displayTime + "</p>" +
                                            "</div>" +
                                            "</div>";
                    commentsList.append(commentElement);
                    sendNotification(merchandise_id, comment, response.id);
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                },
                complete: function() {
                    thisForm[0].reset();
                }
            });
            //end comment method

        })

        function sendNotification(merchandise_id, comment, comment_id) {
            //for send comment notification method
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/notification/send',
                method: 'POST',
                data: { 
                    merchandise_id: merchandise_id,
                    comment: comment,
                    comment_id: comment_id
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endpush