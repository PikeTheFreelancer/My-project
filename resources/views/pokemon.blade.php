@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="pokemon-page page">
        <div class="card">
            @if ($data)
                <div class="card-header">
                    <h3>
                        {{$data['name']}}
                    </h3>
                </div>
                <div class="card-body pokemon-details">
                    <div class="pokemon-shapes">
                        <div class="pokemon-avatar">
                            <img src="{{asset('images/pokemon/'.$data['id'].'.png')}}" alt="">
                        </div>
                        <div class="pokemon-images">
                            <div class="gender-image">
                                @if ($data['sprites']['front_female'])
                                    <p>Male:</p>
                                @else
                                    <p>Default:</p>
                                @endif
                                <img src="{{$data['sprites']['front_default']}}" alt="">
                            </div>
                            @if ($data['sprites']['front_female'])
                                <div class="gender-image">
                                    <p>Female:</p>
                                    <img src="{{$data['sprites']['front_female']}}" alt="">
                                </div>
                            @endif
                            <div>
                                <p>Shiny:</p>
                                <img src="{{$data['sprites']['front_shiny']}}" alt="">
                            </div>
                        </div>
                    </div>
                    <table class="detail-col">
                        <tbody>
                            <tr>
                                <th>Pokedex No:</th>
                                <td>{{$data['id']}}</td>
                            </tr>
                            <tr>
                                <th>Types:</th>
                                <td>
                                    @foreach ($data['types'] as $type)
                                        <span class="type glass {{$type['type']['name']}}">{{$type['type']['name']}}</span>
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
                                    @foreach ($data['abilities'] as $index => $ability)
                                        <p>{{$index+1}}. {{$ability['ability']['name']}} {{$ability['is_hidden'] ? '(hidden ability)' : ''}}</li>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body pokemon-charts">
                    <table class="pokemon-stats">
                        <h3>base stats</h3>
                        <tbody>
                            @php
                                $total_bs = 0;
                            @endphp
                            @foreach ($data['stats'] as $stat)
                                @php
                                    $base_stat = ($stat['base_stat']*2) + 5;
                                    $total_bs = $total_bs + $stat['base_stat'];
                                @endphp
                                <tr>
                                    @if ($stat['stat']['name'] == 'special-attack')
                                        <th>sp.atk:</th>
                                    @elseif($stat['stat']['name'] == 'special-defense')
                                        <th>sp.def:</th>
                                    @else
                                        <th>{{$stat['stat']['name']}}:</th>
                                    @endif
                                    <td class="stat-index" data-bs="{{$stat['base_stat']}}">{{$stat['base_stat']}}</td>
                                    <td class="stat-chart"><div></div></td>

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
                            <tr>
                                <th>total:</th>
                                <th>{{$total_bs}}</th>
                                <td></td>
                                <td>min</td>
                                <td>max</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-header">
                    <h3>
                        opps!
                    </h3>
                </div>
                <div class="card-body">
                    <h3>No pokemon found!</h3>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection