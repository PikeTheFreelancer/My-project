<div class="bosses-menu shadow-sm">
    <div class="header-container justify-center">
        <ul>
            <li class="region-boss-list">
                <a class="nav-link-text" href="#">Kanto</a>
                <div class="boss-list-container shadow-sm">
                    <div class="boss-list header-container">
                        @foreach ($kanto_bosses as $boss)
                            <a class="hover-underline" href="">{{$boss->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            <li class="region-boss-list">
                <a class="nav-link-text" href="#">Johto</a>
                <div class="boss-list-container shadow-sm">
                    <div class="boss-list header-container">
                        @foreach ($johto_bosses as $boss)
                            <a class="hover-underline" href="">{{$boss->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            
            <li class="region-boss-list">
                <a class="nav-link-text" href="#">Hoenn</a>
                <div class="boss-list-container shadow-sm">
                    <div class="boss-list header-container">
                        @foreach ($hoenn_bosses as $boss)
                            <a class="hover-underline" href="">{{$boss->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
            
            <li class="region-boss-list">
                <a class="nav-link-text" href="#">Sinnoh</a>
                <div class="boss-list-container shadow-sm">
                    <div class="boss-list header-container">
                        @foreach ($sinnoh_bosses as $boss)
                            <a class="hover-underline" href="">{{$boss->name}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
