<div class="moves-col-left move-col">
    <div class="moves-table">
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
                @foreach ($move_pool['lv'] as $index => $move)
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

    <div class="moves-table table-egg">
        <h4>Moves learnt by breeding (egg moves)</h4>
        @if ($move_pool['egg'])
            <table>
                <tbody class="multiload-right">
                    <tr>
                        <th>Move</th>
                        <th>Type</th>
                        <th>Dmg.Class</th>
                        <th>Power</th>
                        <th>Accuracy</th>
                    </tr>
                    
                    @foreach ($move_pool['egg'] as $move)
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
    <div class="moves-table table-tm">
        <h4>Moves learnt by TMs/HMs</h4>
        @if ($move_pool['tm'])
            <table>
                <tbody class="multiload-left">
                    <tr>
                        <th>Move</th>
                        <th>Type</th>
                        <th>Dmg.Class</th>
                        <th>Power</th>
                        <th>Accuracy</th>
                    </tr>
                    @foreach ($move_pool['tm'] as $move)
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
