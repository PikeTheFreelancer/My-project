@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="market-page">
            <div class="card">
                <div class="card-header">{{ __('Market') }}</div>
                <div class="card-body">
                    @if (isset($merchandises) && count($merchandises) > 0)
                        @foreach ($merchandises as $item)
                            <div class="merchandise">
                                <div class="avatar-field">
                                    <img src="{{asset($item->avatar)}}" alt="">
                                    <p>seller: {{$item->username}}</p>
                                    <div class="price-box">
                                        <span>@include('svg.pokedollars')</span>
                                        <span class="price">{{ number_format($item->price, 0, ",", ".") }}</span>
                                    </div>
                                </div>
                                <div class="merchandise-details">
                                    <h2>{{ $item->name }}</h2>
                                    <img src="{{$item->image}}" alt="">
                                    <p>{{$item->description}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection