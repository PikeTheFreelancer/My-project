@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="my-account-page page">
        <div class="card">
            <div class="card-header">
                <h1>{{ __('Profile') }}</h1>
            </div>

            <div class="card-body">
                
                <div class="base-info">
                    <div class="avatar-field">
                        <div class="form-field image-uploader">
                            @if ($user->avatar)
                                <img class="thumbnail show-image" src="{{$user->avatar}}" alt="thumbnail">
                            @else
                                <img class="thumbnail show-image" src="{{asset('images/pages/Unknown_person.webp')}}" alt="thumbnail">
                            @endif
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