@extends('layouts.app')

@section('content')
    <div class="page about-me">
        <div class="page-title">
            <h1>
                {{__('messages.footer.about_us')}}
            </h1>
        </div>
        <div class="section-container first-section bg-white" data-aos="fade-up">
            <div class="my-avatar">
                <img src="{{$admin->avatar}}" alt="admin">
            </div>
            <div class="basic-info">
                <h2>Pike Freeman</h2>
                <h5>{{__('Founder, Project developer, Administrator')}}</h5>
                <table>
                    <tr>
                        <td class="text-end white-space-nowrap"><i class="fa-solid fa-phone"></i> :</td>
                        <td>
                            <a href="tel:+84356414477">0356414477</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end white-space-nowrap"><i class="fa-solid fa-envelope"></i> :</td>
                        <td>
                            <a href="mailto:piketheadmin@vermilioncenter.com">piketheadmin@vermilioncenter.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end white-space-nowrap"><i class="fa-brands fa-facebook"></i> :</td>
                        <td>
                            <a href="https://www.facebook.com/nghia.vutrong.71/">https://www.facebook.com/nghia.vutrong.71/</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end white-space-nowrap"><i class="fa-solid fa-location-dot"></i> :</td>
                        <td>
                            {{ __('about.address') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{-- <div class="section-container second-section text-image-block bg-white" data-aos="fade-up">
            <div class="text">
                <h2>{{ __('about.career_goals') }}</h2>
                <ul>
                    <li>{{ __('about.career_goals.1') }}</li>
                    <li>{{ __('about.career_goals.2') }}</li>
                    <li>{{ __('about.career_goals.3') }}</li>
                    <li>{{ __('about.career_goals.4') }}</li>
                    <li>{{ __('about.career_goals.5') }}</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/career-goals.webp')}}" alt="career-goals.webp">
            </div>
        </div>
        <div class="section-container text-image-block reverse bg-white" data-aos="fade-up">
            <div class="text">
                <h2>{{ __('about.career') }}</h2>
                <table>
                    <tr>
                        <th>{{ __('about.career.edu') }}</th>
                        <td>10/2016 - 05/2021</td>
                    </tr>
                    <tr>
                        <th>AHT Tech JSC </th>
                        <td>12/2020 - {{ __('about.career.present') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('about.career.pos') }}:</th>
                        <td>ITO dev.</td>
                    </tr>
                    <tr>
                        <th>Framework:</th>
                        <td>Laravel, Reactjs.</td>
                    </tr>
                    <tr>
                        <th>CMS:</th>
                        <td>Shopify, Wordpress.</td>
                    </tr>
                    <tr>
                        <th>{{ __('about.career.knowledge') }}:</th>
                        <td>HTML, CSS, JS, Bootstrap, Tailwind, Jquery, PHP.</td>
                    </tr>
                </table>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/careers.webp')}}" alt="careers.webp">
            </div>
        </div>
        <div class="section-container bg-white" data-aos="fade-up">
            <h2 class="underline">{{ __('about.skills') }}</h2>
            <h5 class="sub-title">{{ __('about.skills.english') }}</h5>
            <ul style="list-style: circle">
                <li>
                    {{ __('about.skills.english1') }}
                </li>
                <li>{{ __('about.skills.english2') }}</li>
                <li>{{ __('about.skills.english3') }}</li>
                <li>{{ __('about.skills.english4') }}</li>
                <i>{{ __('about.skills.english5') }}</i>
            </ul>
            <h5 class="sub-title">{{ __('about.skills.laravel') }}</h5>
            <p>{{ __('about.knowledge') }}:</p>
            <ul style="list-style: circle">
                <li>{{ __('about.knowledge1') }}</li>
                <li>{{ __('about.knowledge2') }}</li>
                <li>{{ __('about.knowledge3') }}</li>
                <li>{{ __('about.knowledge4') }}</li>
                <li>{{ __('about.knowledge5') }}</li>
                <li>{{ __('about.knowledge6') }}</li>
            </ul>
            <p>{{ __('about.myProj') }}:</p>
            <ul style="list-style: circle">
                <li><a class="underline" href="https://github.com/PikeTheFreelancer/My-project">{{ __('about.myProj.git') }}</a></li>
                <li><a class="underline" href="{{route('home')}}">{{ __('about.myProj.about') }}</a></li>
                <li>{{ __('about.myProj.duration') }}</li>
                <li>{{ __('about.myProj.works') }}:
                    <ol>
                        <li>{{ __('about.myProj.works1') }}</li>
                        <li>{{ __('about.myProj.works2') }}</li>
                        <li>{{ __('about.myProj.works3') }}</li>
                        <li>{!! __('about.myProj.works4') !!}</li>
                        <li>{{ __('about.myProj.works5') }}</li>
                        <li>{{ __('about.myProj.works6') }}</li>
                        <li>{{ __('about.myProj.works7') }}</li>
                        <li>{{ __('about.myProj.works8') }}</li>
                        <li>{{ __('about.myProj.works9') }}</li>
                        <li>{{ __('about.myProj.works10') }}</li>
                        <li>{{ __('about.myProj.works11') }}</li>
                        <li>{{ __('about.myProj.works12') }}</li>
                    </ol>
                </li>
            </ul>
            <h5 class="sub-title">{{ __('about.frontend') }}</h5>
            <ul style="list-style: circle">
                <li>{{ __('about.frontend1') }}</li>
                <li>{{ __('about.frontend2') }}</li>
                <li>{{ __('about.frontend3') }}</li>
            </ul>
            <h5 class="sub-title">Git</h5>
            <p>{{ __('about.git') }}</p>
            <h5>Linux & CLI</h5>
            <ul style="list-style: circle">
                <li>{{ __('about.linux1') }}</li>
                <li>{{ __('about.linux2') }}</li>
            </ul>
            <h5>{{ __('about.database') }}</h5>
            <ul style="list-style: circle">
                <li>MySQL.</li>
                <li>RESTfulAPI, GraphQL.</li>
            </ul>
            <h5>{{ __('about.others') }}</h5>
            <ul style="list-style: circle">
                <li>{{ __('about.others1') }}</li>
                <li>{{ __('about.others2') }}</li>
                <li>{{ __('about.others3') }}</li>
            </ul>
        </div>
        <div class="page-title">
            <h2>
                {{ __('about.project') }}
            </h2>
        </div>
        <div class="section-container text-image-block bg-white" data-aos="fade-up">
            <div class="text">
                <h2 class="underline">Indigenous art code</h2>
                <p><a class="underline" href="https://indigenousartcode.org/">{{ __('about.iac.link') }}</a></p>
                <h5 class="sub-title">{{ __('about.iac.tech') }}:</h5>
                <p>{{ __('about.iac.tech1') }}</p>
                <p>{{ __('about.iac.tech2') }}</p>
                <p>{{ __('about.iac.tech3') }}</p>
                <p>{{ __('about.iac.tech4') }}</p>
                <p>{{ __('about.iac.tech5') }}</p>
                <h5 class="sub-title">{{ __('about.iac.works') }}:</h5>
                <ul>
                    <li>{!! __('about.iac.works1') !!}</li>
                    <li>{{ __('about.iac.works2') }}</li>
                    <li>{{ __('about.iac.works3') }}</li>
                    <li>{{ __('about.iac.works4') }}</li>
                    <li>{{ __('about.iac.works5') }}</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/iac_alter.webp')}}" alt="iac_alter.webp">
            </div>
        </div>
        <div class="section-container text-image-block reverse bg-white" data-aos="fade-up">
            <div class="text">
                <h2 class="underline">Keksia</h2>
                <p><a class="underline" href="https://keksia.com.au/">{{ __('about.iac.link') }}</a></p>
                <h5 class="sub-title">{{ __('about.iac.tech') }}:</h5>
                <p>{{ __('about.keksia.tech1') }}</p>
                <p>{{ __('about.keksia.tech2') }}</p>
                <p>{{ __('about.keksia.tech3') }}</p>
                <p>{{ __('about.keksia.tech4') }}</p>
                <p>{{ __('about.keksia.tech5') }}</p>
                <h5 class="sub-title">{{ __('about.iac.works') }}:</h5>
                <ul>
                    <li>{!! __('about.keksia.works1') !!}</li>
                    <li>{{ __('about.keksia.works2') }}</li>
                    <li>{{ __('about.keksia.works3') }}</li>
                    <li>{{ __('about.keksia.works4') }}</li>
                    <li>{{ __('about.keksia.works5') }}</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/keksia_alter.webp')}}" alt="keksia_alter.webp">
            </div>
        </div> --}}
    </div>
@endsection