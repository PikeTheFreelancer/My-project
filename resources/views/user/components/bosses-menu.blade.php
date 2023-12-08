<div class="bosses-menu">
    <div class="header-container justify-center">
        <ul>
            <li class="kanto-boss-list">
                <a class="nav-link-text" href="#">Kanto</a>
                <div class="boss-list-container">
                    <div class="boss-list header-container">
                        @foreach ($kanto_bosses as $boss)
                            <a class="hover-underline" href="">{{$boss->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            <li>
                <a class="nav-link-text" href="#">Johto</a>
            </li>
            <li>
                <a class="nav-link-text" href="#">Hoenn</a>
            </li>
            <li>
                <a class="nav-link-text" href="#">Sinnoh</a>
            </li>
        </ul>
    </div>
</div>
