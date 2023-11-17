<footer>
    <div class="footer-container">
        <div class="footer-col" data-aos="fade-right" data-aos-delay="100">
            <a class="home-link" href="{{ url('/') }}">
                {{-- <img src="{{asset('images/svg/pokeball.svg')}}" alt=""> --}}
                <h5>Vermilion Center</h5>
            </a>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed ea placeat iure molestiae eius, accusantium obcaecati quos earum provident asperiores quasi alias ullam tempora officia animi dolorum hic repellat nam.</p>
        </div>
        <div class="footer-col-2" data-aos="fade-left" data-aos-delay="100">
            <div class="other-links">
                <h5>About</h5>
                <a href="#">About Vermilion Center</a>
                <a href="{{route('about-me')}}">About me</a>
            </div>
            <div class="other-links">
                <h5>Contact</h5>
                <a href="#">Email</a>
                <a href="#">Facbook</a>
                <a href="#">Phone</a>
            </div>
        </div>
    </div>
</footer>