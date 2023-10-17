@extends('layouts.app')
@section('title', 'My Store')

@include('layouts.upload-avatar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="my-account-page">
            <div class="card">
                <div class="card-header">{{ __('My Account') }}</div>
                <div class="card-body">
                    <form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-field avatar-field">
                            <label for="image">Change avatar</label>
                            <div class="image-uploader">
                                <input type="file" name="avatar" class="avatar">
                                <input type="hidden" name="image_base64">
                                <img class="thumbnail show-image" src="{{$avatar}}" alt="">
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