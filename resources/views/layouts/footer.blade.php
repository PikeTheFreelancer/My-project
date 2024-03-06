<footer>
    <div class="footer-container space-between">
        <div class="footer-col" data-aos="fade-right" data-aos-delay="100">
            <a class="home-link" href="{{ url('/') }}">
                <img src="{{asset('images/favicon.png')}}" alt="">
                <h5>Vermilion Center</h5>
            </a>
            <p>{!!__('messages.footer.desc')!!}</p>
        </div>
        <div class="footer-col-2" data-aos="fade-left" data-aos-delay="100">
            <div class="other-links">
                <h5>{{__('messages.footer.about')}}</h5>
                <a href="{{ route('home','#welcome') }}">{{__('messages.footer.about_page')}}</a>
                <a href="{{route('about-us')}}">{{__('messages.footer.about_us')}}</a>
            </div>
            <div class="other-links">
                <h5>{{__('messages.footer.contact')}}</h5>
                <a href="mailto:pikefreeman1997@gmail.com">Email</a>
                <a href="https://www.facebook.com/nghia.vutrong.71/">Facbook</a>
                <a href="tel:0356414477">{{__('messages.footer.phone')}}</a>
            </div>
        </div>
    </div>
</footer>