@extends('layouts.app')
@section('title', 'My Store')

@include('layouts.upload-avatar')

@section('content')
<div class="section-container">
    <div class="row justify-content-center">
        <div class="my-account-page">
            <div class="card">
                <div class="card-header">{{ __('My Account') }}</div>
                <div class="card-body">
                    <form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="base-info">
                            <div class="avatar-field">
                                <label for="image">Change avatar</label>
                                <div class="form-field image-uploader">
                                    <input type="file" name="avatar" class="avatar">
                                    <input type="hidden" name="image_base64">
                                    <img class="thumbnail show-image" src="{{asset($avatar)}}" alt="">
                                </div>
                            </div>
                            <div class="info-fields">
                                <div>
                                    <label for="name">User name</label>
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
                            <button class="btn btn-primary" type="submit">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection