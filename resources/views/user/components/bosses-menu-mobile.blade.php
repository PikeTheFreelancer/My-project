<ul class="sub-links">
    <li class="dropdown-item">
        <div class="mobile-nav-link">
            Kanto
            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
        </div>
        <ul class="sub-links">
            @foreach ($kanto_bosses as $boss)
                <li class="dropdown-item">
                    <a class="hover-underline" href="{{route('getBoss', $boss->id)}}">{{$boss->name}}</a>
                </li>
            @endforeach
        </ul>
    </li>

    <li class="dropdown-item">
        <div class="mobile-nav-link">
            Johto
            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
        </div>
        <ul class="sub-links">
            @foreach ($johto_bosses as $boss)
                <li class="dropdown-item">
                    <a class="hover-underline" href="{{route('getBoss', $boss->id)}}">{{$boss->name}}</a>
                </li>
            @endforeach
        </ul>
    </li>

    <li class="dropdown-item">
        <div class="mobile-nav-link">
            Hoenn
            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
        </div>
        <ul class="sub-links">
            @foreach ($hoenn_bosses as $boss)
                <li class="dropdown-item">
                    <a class="hover-underline" href="{{route('getBoss', $boss->id)}}">{{$boss->name}}</a>
                </li>
            @endforeach
        </ul>
    </li>

    <li class="dropdown-item">
        <div class="mobile-nav-link">
            Sinnoh
            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
        </div>
        <ul class="sub-links">
            @foreach ($sinnoh_bosses as $boss)
                <li class="dropdown-item">
                    <a class="hover-underline" href="{{route('getBoss', $boss->id)}}">{{$boss->name}}</a>
                </li>
            @endforeach
        </ul>
    </li>
</ul>