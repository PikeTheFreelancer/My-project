@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="market-page">
            <div class="card">
                <div class="card-header">{{ __('Market') }}</div>
                <div class="card-body">
                    @if (isset($merchandises) && count($merchandises) > 0)
                        @foreach ($merchandises as $item)
                            <div class="merchandise" data-id="{{ $item->id }}">
                                <div class="avatar-field">
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
                                    
                                    {{-- comment appended here --}}
                                    <div class="comments-list">
                                        @foreach ($item->comments as $comment)
                                            <div id="comment-{{$comment->id}}" class='comment-item'>
                                                <div class='comment-avatar'>
                                                    <img src='{{asset($comment->avatar)}}' alt=''>
                                                </div>
                                                <div class='comment-col-right'>
                                                    <a class='comment-username' href='#'>{{$comment->username}}</a>
                                                    <p class='comment-content'>{{$comment->comment}}</p>
                                                    <p class='commented-at'>{{$comment->updated_at}}</p>
                                                </div>
                                            </div>
                                        @endforeach
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
</div>
@endsection
@push('js')
    <script>
        //event comment
        $(document).on('submit', '.form-comment', function(e) {
            e.preventDefault();

            var merchandise_id = $(this).parents('.merchandise').data('id');
            var comment = $(this).find('.comment').val();

            // for comment method
            var commentsList = $(this).siblings('.comments-list');
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

                    var displayTime = 'just now' ;
                    var commentedAt = commentsList.find('.commented-at');
                    var username = commentsList.find('.comment-username');
                    var avatar = commentsList.find('.comment-avatar');

                    var commentElement = "<div class='comment-item'>"+
                                    "<div class='comment-avatar'>"+
                                        "<img src='"+response.user_avatar+"' alt=''>"+
                                    "</div>"+
                                    "<div class='comment-col-right'>"+
                                        "<a class='comment-username' href='#'>"+response.username+"</a>"+
                                        "<p class='comment-content'>"+response.comment+"</p>"+
                                        "<p class='commented-at'>"+displayTime+"</p>"+
                                    "</div>"+
                                "</div>";
                    commentsList.append(commentElement);
                    sendNotification(merchandise_id, comment, response.id);
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                },
                complete: function() {
                    $(".form-comment")[0].reset();
                    console.log('run here');
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