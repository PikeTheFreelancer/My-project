@php
    $comments = $comments->reverse();
@endphp
<div id="max-amount" style="display: none;" data-max-amount="{{$max_amount}}"></div>
@foreach ($comments as $comment)
    <div id="comment-{{$comment->id}}" class='comment-item opacity0'>
        <div class='comment-avatar'>
            <img src='{{asset($comment->avatar)}}' alt=''>
        </div>
        <div class='comment-col-right'>
            <div class="comment-username-container">
                <a class='comment-username' href="{{route('profile', $comment->user_id)}}">{{$comment->username}}</a>
                @if ($comment->user_id == $user_id)
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
