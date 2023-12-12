@extends('layouts.app')

@section('content')

<div class="pokedex-page page">
    <div class="pokedex-datas">
        @foreach ($items as $item)
            @php
                $url = $item["url"];

                $path = parse_url($url, PHP_URL_PATH); // Lấy đoạn path từ URL
                $segments = explode('/', rtrim($path, '/')); // Tách path thành mảng các đoạn

                $pokemonId = end($segments);
            @endphp 
            <div class="pokedex-data">
                <p><a class="hover-underline" href="{{route('get-pokemon', $item["name"])}}">{{$pokemonId}}. {{ucfirst($item["name"])}}</a></p>
                @if (file_exists('images/pokemon-dataset/'.$item["name"].'.png'))
                    <img src="{{asset('images/pokemon-dataset/'.$item["name"].'.png')}}" alt="{{$item["name"]}}.png'">
                @elseif(file_exists('images/pokemon-dataset/'.$pokemonId.'.png'))
                    <img src="{{asset('images/pokemon-dataset/'.$pokemonId.'.png')}}" alt="{{$pokemonId}}.png'">
                @else
                    <img src="{{asset('images/pages/noimageavailable.webp')}}" alt="noimageavailable.webp">
                @endif
                
            </div>
        @endforeach
    </div>
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">{{__('community.prev')}}</a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item desktop {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">{{__('community.next')}}</a>
            </li>
        </ul>
    @endif
</div>
@endsection