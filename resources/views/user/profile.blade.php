@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="my-account-page page">
        <div class="card">
            <div class="card-header">{{ __('Profile') }}</div>

            <div class="card-body">
                
                <div class="base-info">
                    <div class="avatar-field">
                        <div class="form-field image-uploader">
                            <img class="thumbnail show-image" src="{{$user->avatar}}" alt="">
                        </div>
                    </div>
                    <div class="info-fields">
                        <div class="form-field">
                            <p>Name:</p>
                            <p>{{$user->name}}</p>
                        </div>
                        <div class="form-field">
                            <p>PRO username:</p>
                            <p>{{$user->pro_username}}</p>
                        </div>
                        <div class="form-field">
                            <p>PRO server:</p>
                            <p>{{$user->pro_server}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection