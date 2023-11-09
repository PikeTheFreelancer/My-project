@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="pokemon-page page">
        <div class="card">
            <div class="card-header">{{$data['name']}}</div>
            <div class="card-body pokemon-details">
                <div class="pokemon-shapes">
                    <div class="pokemon-avatar">
                        <img src="{{asset('images/pokemon/'.$data['id'].'.png')}}" alt="">
                    </div>
                    <div class="pokemon-images">
                        <div class="gender-image">
                            <p>Male:</p>
                            <img src="{{$data['sprites']['front_default']}}" alt="">
                        </div>
                        <div class="gender-image">
                            <p>Female:</p>
                            @if ($data['sprites']['front_female'])
                                <img src="{{$data['sprites']['front_female']}}" alt="">
                            @else
                                <img src="{{$data['sprites']['front_default']}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <table class="detail-col">
                    <tbody>
                        <tr>
                            <th>pokedex No:</th>
                            <td>{{$data['id']}}</td>
                        </tr>
                        <tr>
                            <th>Types:</th>
                            <td>
                                @foreach ($data['types'] as $type)
                                    <span>{{$type['type']['name']}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Height:</th>
                            <td>{{$data['height']/10}}m</td>
                        </tr>
                        <tr>
                            <th>Weight:</th>
                            <td>{{$data['weight']/10}}kg</td>
                        </tr>
                        <tr>
                            <th>Abilities:</th>
                            <td>
                                <ol>
                                    @foreach ($data['abilities'] as $ability)
                                        <li>{{$ability['ability']['name']}} {{$ability['is_hidden'] ? '(hidden ability)' : ''}}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body pokemon-charts">
                <table class="pokemon-stats">
                    <h3>base stats</h3>
                    <tbody>
                        @foreach ($data['stats'] as $stat)
                            @php
                                $base_stat = ($stat['base_stat']*2) + 5;
                            @endphp
                            <tr>
                                <th>{{$stat['stat']['name']}}:</th>
                                <td>{{$stat['base_stat']}}</td>

                                {{-- minimum column --}}
                                @if ($stat['stat']['name'] == 'hp')
                                    <td>{{($stat['base_stat']*2)+110}}</td>
                                @else
                                    <td>{{(int)($base_stat - $base_stat/10)}}</td>
                                @endif

                                {{-- maximum column --}}
                                @if ($stat['stat']['name'] == 'hp')
                                    <td>{{($stat['base_stat']*2)+110+31+63}}</td>
                                @else
                                    <td>{{(int)(($base_stat + 31 + 63) + ($base_stat + 31 + 63)/10)}}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection