@extends('layouts.app')

@section('content')

<div class="boss-page page">
    <div class="page-title">
        <h1>
            Boss
        </h1>
    </div>
    <div class="section-container first-section bg-white" data-aos="fade-up">
        <div class="my-avatar">
            <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="unknown">
        </div>
        <div class="basic-info">
            <h2>{{ $boss->name }}</h2>
            <table>
                <tr>
                    <th>Region</th>
                    <td>{{$boss->region}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{$boss->location}}</td>
                </tr>
                <tr>
                    <th>Cooldown</th>
                    <td>{{$boss->cooldown}}</td>
                </tr>
            </table>
        </div>
    </div>
    @foreach ($boss->line_ups as $line_up)
        <div class="section-container">
            <h2 class="line-up-level">Level: {{$line_up->level}}</h2>
            <div class="line-up">
                @foreach ($line_up->line_up as $pokemon)
                <div class="line-up-pokemon">
                    <h5 class="pokemon-name">
                        @include('svg.pokeball')
                        <a class="hover-underline" target="_blank" href="{{route('get-pokemon',$pokemon['pokemon'])}}">{{$pokemon['pokemon']}}</a>
                    </h5>
                    <div class="line-up-pokemon-info">
                        <div class="col-left">
                            <img src="{{asset('images/pokemon-dataset/'.$pokemon['pokemon'].'.png')}}" alt="{{$pokemon['pokemon']}}.png'">
                        </div>
                        <div class="col-right">
                            <p>Nature: {{isset($pokemon['nature']) ? $pokemon['nature'] : ''}}</p>
                            <p>Ability: {{isset($pokemon['ability']) ? $pokemon['ability'] : ''}}</p>
                            <p>Item: {{$pokemon['item']}}</p>
                            <p>Moves:</p>
                            <ul>
                                @foreach ($pokemon['moves'] as $move)
                                    <li class="white-space-nowrap">
                                        {{$move}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection