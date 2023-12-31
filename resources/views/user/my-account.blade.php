@extends('layouts.app')
@section('title', 'My Store')

@section('content')
@include('layouts.upload-avatar')
@include('layouts.add-post')
<div class="my-account-page page">
    <div class="card-header">
        <h1>{{ __('messages.header.account') }}</h1>
    </div>
    <div class="card-body">
        <form class="edit-account" action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data" data-aos="fade-up">
            @csrf
            <div class="base-info">
                <div class="avatar-field">
                    <label for="image">{{ __('messages.account.avatar') }}</label>
                    <div class="form-field image-uploader">
                        <input type="file" name="avatar" class="avatar">
                        <input type="hidden" name="image_base64">
                        @if ($avatar)
                            <img class="thumbnail show-image" src="{{$avatar}}" alt="thumbnail">
                        @else
                            <img class="thumbnail show-image" src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                        @endif
                    </div>
                </div>
                <div class="info-fields">
                    <div>
                        <label for="name">{{ __('messages.account.name') }}</label>
                        <input class="input-border" value="{{$user_name}}" type="text" name="name" id="">
                    </div>
                    <div class="form-field">
                        <label for="email">email</label>
                        <input class="input-border" value="{{$user_email}}" type="email" name="email" id="">
                    </div>
                    <div class="form-field">
                        <label for="pro_username">Pro username</label>
                        <input class="input-border" value="{{$pro_username}}" type="text" name="pro_username" id="">
                    </div>
                    <div class="form-field">
                        <label for="pro_server">Pro server</label>
                        <input class="input-border" value="{{$pro_server}}" type="text" name="pro_server" id="">
                    </div>
                </div>
            </div>
            
            <div class="form-field">
                <button class="btn btn-primary" type="submit">{{ __('messages.save_changes') }}</button>
            </div>
        </form>
        <!-- Button trigger modal -->
        <div class="add accordion-box bg-white" data-aos="fade-up" data-toggle="modal" data-target="#addPost">
            <span class="plus-icon">
                @include('svg.plus')
            </span>
            <span>{{ __('messages.post.add') }}</span>
        </div>
        <div class="posts" data-aos="fade-up">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="action">
                        <a href="#" class="edit-post">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="{{route('user.delete-post', $post->id)}}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <div class="post-title">
                        <h4>{{$post->title}}</h4>
                    </div>
                    <div class="post-content">{!! $post->content !!}</div>
                    <form class="edit-post-form" method="post" action="{{route('user.save-post')}}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-field">
                            <label for="title">{{ __('messages.title') }}</label>
                            <input class="input-border" type="text" name="title" value="{{$post->title}}">
                        </div>
                        <div class="form-field">
                            <label for="title">{{__('Category')}}</label>
                            <select class="form-select mb-3" name="post_category_id">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{($post->post_category_id == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="content">{{ __('messages.content') }}</label>
                            <textarea class="tinymce-editor" name="content">{!! $post->content !!}</textarea>
                        </div>
                        <div class="form-field">
                            <button class="btn btn-primary" type="submit">{{ __('messages.save_changes') }}</button>
                            <button class="btn btn-secondary cancel-edit-post">{{ __('community.cancel') }}</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection