@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="row justify-content-center">
        <div class="home-page">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a class="shiny home-item glass" href="{{ route('market') }}">
                        <div class="image-container">
                            <img src="{{ asset('images/pokemart.png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
