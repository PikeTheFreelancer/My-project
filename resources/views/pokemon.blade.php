@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="pokemon-page page">
        <div class="card">
            <div class="card-header">{{$data['name']}}</div>
            <div class="card-body">
                <div class="pokemon-images">
                    <img src="{{asset('images/'.$data['id'].'.png')}}" alt="">
                    <div class="gender-image">
                        <p>Male:</p>
                        <img src="{{$data['sprites']['front_default']}}" alt="">
                    </div>
                    <div class="gender-image">
                        <p>Female:</p>
                        <img src="{{$data['sprites']['front_female']}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection