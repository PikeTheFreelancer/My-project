@extends('layouts.app')

@section('content')
<div class="move-page page">
    <div class="page-title">
        <h1>{{ ucfirst($move['name']) }}</h1>
    </div>
    <div class="card-body">
        <div class="move-details bg-white section-container">
            <div class="col-left">
                <table>
                    <tr>
                        <th>{{__('Type')}}</th>
                        <td><span class="type glass {{$move['type']['name']}}">{{$move['type']['name']}}</span></td>
                    </tr>
                    <tr>
                        <th>{{__('Dmg.Class')}}</th>
                        <td>{{$move['dmg_class']['name']}}</td>
                    </tr>
                    <tr>
                        <th>{{__('Power')}}</th>
                        <td>{{$move['power']}}</td>
                    </tr>
                    <tr>
                        <th>{{__('Accuracy')}}</th>
                        <td>{{$move['accuracy']}}</td>
                    </tr>
                    <tr>
                        <th>{{__('PP')}}</th>
                        <td>{{$move['pp']}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-right">
                <h3>{{__('Description')}}</h3>
                @php
                    $raw_effect = $move['pokemon_v2_moveeffect']['pokemon_v2_moveeffecteffecttexts'][0]['effect'];
                    $effect = str_contains($raw_effect ,'$effect_chance') ? str_replace('$effect_chance', $move['effect_chance'], $raw_effect) : '';
                @endphp
                <p>{!! $effect !!}</p>
            </div>
        </div>
    </div>
</div>

@endsection
