@extends('layouts.app')

@section('content')
    <div class="boss-page page">
        <div class="page-title">
            <h1>
                {{ucFirst($region)}} Pokemon Revolution Bosses
            </h1>
        </div>
        <div class="section-container bg-white" data-aos="fade-up">
            <h5>{{__('Requirements')}}</h5>
            <ul>
                <li>
                    {{__("You must be a champion of the bosses' region")}}.
                </li>
                <li>
                    {{__("You can not use any item except in-battle-held items on your Pokemon.")}}
                </li>
                <li>
                    {!! __("messages.bosses.text1") !!}
                </li>
            </ul>
        </div>
        <div class="section-container bg-white" data-aos="fade-up">
            <h5>{{__('Rewards')}}</h5>
            <p>
                {{__("messages.bosses.text2")}}
            </p>
            <div class="overflow-auto">
                <table>
                    <tr>
                        <th rowspan="2">{{__('Difficulty')}}</th>
                        <th colspan="3">{{__('Tier chances')}}</th>
                        <th rowspan="2">Pokedollars</th>
                        <th rowspan="2">PVE coins</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>{{__('Easy')}}</td>
                        <td>85%</td>
                        <td>10%</td>
                        <td>5%</td>
                        <td>5,000 - 10,000</td>
                        <td>None</td>
                    </tr>
                    <tr>
                        <td>{{__('Medium')}}</td>
                        <td>80%</td>
                        <td>10%</td>
                        <td>10%</td>
                        <td>12,000 - 30,000</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>{{__('Hard')}}</td>
                        <td>60%</td>
                        <td>25%</td>
                        <td>15%</td>
                        <td>20,000 - 40,000</td>
                        <td>5</td>
                    </tr>
                </table>
            </div>
            <p>
                <i>{{__('What is tier chances?')}}</i> {{__('Each boss have a different reward list. Each time you win the boss, he/she will give you one of the list randomly. Tier 1 rewards are common items and upper tier give more rare items or rare pokemon. Your will see the list in each boss detail page.')}}
            </p>
        </div>
        <div class="section-container bg-white" data-aos="fade-up">
            <h5>{{ucFirst($region)}} {{__('Repeatable bosses')}}</h5>
            <div class="overflow-auto">
                <table>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Location')}}</th>
                        <th>{{__('Cooldown')}}</th>
                    </tr>
                    @foreach ($bosses as $boss)
                        <tr>
                            <td>
                                <a class="hover-underline" href="{{route('getBoss', $boss->id)}}">{{$boss->name}}</a>
                            </td>
                            <td>{{$boss->location}}</td>
                            <td>{{$boss->cooldown}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection