@php
    $comments = $comments->reverse();
@endphp
<div id="max-amount" style="display: none;" data-max-amount="{{$max_amount}}"></div>
@foreach ($comments as $comment)
    <div id="comment-{{$comment->id}}" class='comment-item opacity0'>
        <div class='comment-avatar'>
            @if ($comment->avatar)
                <img src='{{asset($comment->avatar)}}' alt=''>
            @else
                <img src="{{asset('images/pages/Unknown_person.jpg')}}" alt="">
            @endif
        </div>
        <div class='comment-col-right'>
            <div class="comment-username-container">
                <a class='comment-username' href="{{route('profile', $comment->user_id)}}">{{$comment->username}}</a>
                @if (isset($seller_id) && $comment->user_id == $seller_id)
                    <small class="user-label">{{__('community.seller')}}</small>
                @elseif(isset($author_id) && $comment->user_id == $author_id)
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
