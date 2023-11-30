@extends('layouts.app')

@section('content')
<div class="page authentication">
    <div class="section-container bg-white">
        
        <div class="card-body">
            <h1>{{ __('Verify Your Email Address') }}</h1>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <p>
                {{ __('A fresh verification link has been sent to your email address. Please check your email for a verification link.') }}
                {{ __('If you did not receive the email, click the following button to resend verification link') }}:
            </p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-secondary m-0 align-baseline">{{ __('click here to request another') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
