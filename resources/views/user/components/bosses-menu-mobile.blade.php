<ul class="sub-links">
    <li class="dropdown-item mobile-nav-link">
        Kanto
        <ul class="sub-links">
            @foreach ($kanto_bosses as $boss)
                <li class="dropdown-item">
                    <a class="hover-underline" href="">{{$boss->name}}</a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="dropdown-item">Johto</li>
    <li class="dropdown-item">Hoenn</li>
    <li class="dropdown-item">Sinnoh</li>
</ul>