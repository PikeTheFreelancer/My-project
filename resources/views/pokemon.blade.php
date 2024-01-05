@extends('layouts.app')

@section('content')

<div class="pokemon-page page">
    @if ($data)
        @php
            $sprites = json_decode($data['sprites'][0]['sprites'], true);
        @endphp
        <div class="pokemon-name">
            <h1>
                {{$data['name']}}
            </h1>
        </div>
        <div class="pokemon-details bg-white section-container" data-aos="fade-up">
            <div class="pokemon-shapes">
                <div class="pokemon-avatar">
                    @if (file_exists('images/pokemon-dataset/'.$data['name'].'.png'))
                        <img src="{{asset('images/pokemon-dataset/'.$data['name'].'.png')}}" alt="{{$data['name']}}.png'">
                    @else
                        <img src="{{asset('images/pages/noimageavailable.webp')}}" alt="noimageavailable.webp">
                    @endif
                </div>
                <div class="pokemon-images">
                    <div class="gender-image">
                        @if ($sprites['front_female'])
                            <p>Male:</p>
                        @else
                            <p>Default:</p>
                        @endif
                        <img class="poke-thumb" src="{{$sprites['front_default']}}" alt="poke-thumb">
                    </div>
                    @if ($sprites['front_female'])
                        <div class="gender-image">
                            <p>Female:</p>
                            <img class="poke-thumb" src="{{$sprites['front_female']}}" alt="poke-thumb">
                        </div>
                    @endif
                    <div>
                        <p>Shiny:</p>
                        <img class="poke-thumb" src="{{$sprites['front_shiny']}}" alt="poke-thumb">
                    </div>
                </div>
            </div>
            <div class="detail-col">
                <table>
                    <tbody>
                        <tr>
                            <th>Pokedex No:</th>
                            <td>{{$data['specy']['id']}}</td>
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
                <div class="pokemon-charts" data-aos="fade-up">
                    <table class="pokemon-stats">
                        <h3>Base stats</h3>
                        <tbody>
                            @php
                                $total_bs = 0;
                            @endphp
                            
                            @foreach ($data['base_stats'] as $stat)
                                @php
                                    $base_stat = ($stat['base_stat']*2) + 5;
                                    $total_bs = $total_bs + $stat['base_stat'];
                                @endphp
                                <tr>
                                    @if ($stat['name']['name'] == 'special-attack')
                                        <th>sp.atk:</th>
                                    @elseif($stat['name']['name'] == 'special-defense')
                                        <th>sp.def:</th>
                                    @else
                                        <th>{{$stat['name']['name']}}:</th>
                                    @endif
                                    <td class="stat-index" data-bs="{{$stat['base_stat']}}">{{$stat['base_stat']}}</td>
                                    <td class="stat-chart"><div data-aos="fade-right" data-aos-delay="200" data-aos-once="true"></div></td>

                                    {{-- minimum column --}}
                                    @if ($stat['name']['name'] == 'hp')
                                        <td>{{($stat['base_stat']*2)+110}}</td>
                                    @else
                                        <td>{{(int)($base_stat - $base_stat/10)}}</td>
                                    @endif

                                    {{-- maximum column --}}
                                    @if ($stat['name']['name'] == 'hp')
                                        <td class="p-0">{{($stat['base_stat']*2)+110+31+63}}</td>
                                    @else
                                        <td class="p-0">{{(int)(($base_stat + 31 + 63) + ($base_stat + 31 + 63)/10)}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <th>total:</th>
                                <td>{{$total_bs}}</td>
                                <td class="p-0"></td>
                                <td>min</td>
                                <td class="p-0">max</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="pokemon-moves-container relative">
            <div class="generation-navigator absolute" data-pokemon="{{$data['name']}}">
                @for ($i = 1; $i <= 9; $i++)
                    <span class="nav-gen{{$i}} {{($i == 6) ? 'active' : ''}}" data-gen={{$i}}>Gen {{$i}}</span>
                @endfor
            </div>
            
            <div class="pokemon-moves">
                <div class="moves-col-left move-col">
                    <div class="moves-table" data-aos="fade-right">
                        <table>
                            <h4>Moves learnt by level-up</h4>
                            <tbody class="multiload-right">
                                <tr>
                                    <th>Level</th>
                                    <th>Move</th>
                                    <th>Type</th>
                                    <th>Dmg.Class</th>
                                    <th>Power</th>
                                    <th>Accuracy</th>
                                </tr>
                                @foreach ($data['moves']['gen_6']['lv'] as $index => $move)
                                    <tr>
                                        <td>{{$move['level']}}</td>
                                        <td>{{$move['move']['name']}}</td>
                                        <td><span class="type glass {{$move['move']['type']['name']}}">{{$move['move']['type']['name']}}</span></td>
                                        <td>{{$move['move']['damage_class']['name']}}</td>
                                        <td>{{$move['move']['power']}}</td>
                                        <td>{{$move['move']['accuracy']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="moves-table table-egg" data-aos="fade-right">
                        <h4>Moves learnt by breeding (egg moves)</h4>
                        @if ($data['moves']['gen_6']['egg'])
                            <table>
                                <tbody class="multiload-right">
                                    <tr>
                                        <th>Move</th>
                                        <th>Type</th>
                                        <th>Dmg.Class</th>
                                        <th>Power</th>
                                        <th>Accuracy</th>
                                    </tr>
                                    @foreach ($data['moves']['gen_6']['egg'] as $move)
                                        <tr>
                                            <td>{{$move['move']['name']}}</td>
                                            <td><span class="type glass {{$move['move']['type']['name']}}">{{$move['move']['type']['name']}}</span></td>
                                            <td>{{$move['move']['damage_class']['name']}}</td>
                                            <td>{{$move['move']['power']}}</td>
                                            <td>{{$move['move']['accuracy']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>This pokemon does not learn any moves by breeding</p>
                        @endif
                    </div>
                </div>
                <div class="move-col">
                    <div class="moves-table table-tm" data-aos="fade-left">
                        <h4>Moves learnt by TMs/HMs</h4>
                        @if ($data['moves']['gen_6']['tm'])
                            <table>
                                <tbody class="multiload-left">
                                    <tr class="">
                                        <th>Move</th>
                                        <th>Type</th>
                                        <th>Dmg.Class</th>
                                        <th>Power</th>
                                        <th>Accuracy</th>
                                    </tr>
                                    @foreach ($data['moves']['gen_6']['tm'] as $move)
                                        <tr>
                                            <td>{{$move['move']['name']}}</td>
                                            <td><span class="type glass {{$move['move']['type']['name']}}">{{$move['move']['type']['name']}}</span></td>
                                            <td>{{$move['move']['damage_class']['name']}}</td>
                                            <td>{{$move['move']['power']}}</td>
                                            <td>{{$move['move']['accuracy']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>This pokemon cannot be taught any TM moves</p>                                
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="section-container evolution-chart">
            <h2>Evolution Chain</h2>
            <div class="evolution-chain">
                @foreach ($evolution_chain['species'] as $item)
                    <div>{{$item['name']}}</div>
                @endforeach
            </div>
        </div>
    @else
        <h1>opps!</h1>
        <br>
        <h5>No pokemon found!</h5>
        <br>
        <img src="{{asset('images/pages/404.gif')}}" alt="404.gif">
    @endif
</div>
@endsection