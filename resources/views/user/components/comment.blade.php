<div id="comment-{{$comment->id}}" class='comment-item'>
    <div class='comment-avatar'>
        @if ($comment->user_avatar)
            <img src='{{asset($comment->user_avatar)}}' alt=''>
        @else
            <img src="{{asset('images/pages/Unknown_person.jpg')}}" alt="">
        @endif
    </div>
    <div class='comment-col-right'>
        <div class="comment-username-container">
            <a class='comment-username' href="{{route('profile', $comment->user_id)}}">{{$comment->username}}</a>
            @if (isset($seller_id) && $comment->user_id == $seller_id)
                <small class="user-label">seller</small>
            @else
                <small class="user-label">author</small>
            @endif
        </div>
        <p class='comment-content'>{{$comment->comment}}</p>

        <p class='comment-action'>
            @if (Auth::user() && $comment->user_id == Auth::user()->id)
                <a href="#" class="edit-comment">Edit</a>
                <a href="#" class="delete-comment">Delete</a>
            @endif
            <span class="commented-at">
                Just now
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
