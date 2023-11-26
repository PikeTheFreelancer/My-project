@extends('layouts.app')

@section('content')
<div class="newsfeed-page page">
    <div class="page-title">
        <h1>{{ __('community.newsfeed') }}</h1>
        <div class="newsfeed-actions">
            <div class="search-box">
                <form action="{{route('post.search')}}" method="GET">
                    <input class="input-border" type="text" name="text" placeholder="Search post..." value="{{isset($text) ? $text : ''}}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <button type="submit"></button>
                </form>
            </div>
            <div class="filter-box">
                @if (isset($category_name))
                    <span class="ellipsis d-block">{{$category_name}}</span>            
                @else
                    <span class="ellipsis d-block">All</span>
                @endif
                <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
    
                <div class="filter-options">
                    <a href="{{route('newsfeed')}}">All</a>
                    @foreach ($categories as $category)
                        <a href="{{route('post.filter', $category->name)}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (isset($posts) && count($posts) > 0)
            @foreach ($posts as $item)
                <div class="post section-container bg-white" data-aos="fade-up">
                    <a href="{{route('post', $item->id)}}" class="post-col-left">
                        <h5 class="post-title">{{$item->title}}</h5>
                        <div class="no-media post-content">{!! $item->content !!}</div>
                        <p>
                            <i class="fa-regular fa-comment"></i>
                            <span>{{$item->comments->count()}}</span>
                        </p>
                    </a>
                    <div class="flex">
                        <div class="avatar-field">
                            <div>
                                <p class="author">
                                    <a href="{{route('profile',$item->user_id)}}">
                                        {{__('community.author')}}: {{$item->username}}
                                    </a>
                                </p>
                                <p><small class="sub-text">{{$item->timeAgo}}</small></p>
                            </div>
                            @if ($item->avatar)
                                <img src="{{asset($item->avatar)}}" alt="avatar">
                            @else
                                <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <ul class="pagination">
                <li class="page-item {{ $posts->previousPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $posts->previousPageUrl() }}">{{__('community.prev')}}</a>
                </li>
        
                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                    <li class="page-item {{ $i == $posts->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
        
                <li class="page-item {{ $posts->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $posts->nextPageUrl() }}">{{__('community.next')}}</a>
                </li>
            </ul>
        @endif
    </div>
    
</div>
@endsection
