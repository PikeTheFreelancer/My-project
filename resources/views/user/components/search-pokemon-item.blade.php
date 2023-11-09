@foreach ($pokemons as $pokemon)
    <a class="search-result" href="{{route('get-pokemon', $pokemon['name'])}}">{{$pokemon['name']}}</a>
@endforeach