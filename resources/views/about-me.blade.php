@extends('layouts.app')

@section('content')
    <div class="page about-me">
        <div class="page-title">
            <h1>
                {{ __('About me') }}
            </h1>
        </div>
        <div class="section-container first-section" data-aos="fade-up">
            <div class="my-avatar">
                <img src="{{asset('images/pages/pike.jpg')}}" alt="">
            </div>
            <div class="basic-info">
                <h2>Vu Trong Nghia</h2>
                <h5>Full stack developer</h5>
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
                            <a href="mailto:pikefreeman1997@gmail.com">pikefreeman1997@gmail.com</a>
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
                            Dong Trach - Ngu Hiep - Thanh Tri - Hanoi
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section-container second-section text-image-block" data-aos="fade-up">
            <div class="text">
                <h2>CAREER GOALS</h2>
                <ul>
                    <li>Looking for a chance to become a Fullstack developer.</li>
                    <li>Want to study new technical skills for improve my career.</li>
                    <li>Happy to work in a positive and professional workplace.</li>
                    <li>Looking for a workplace where I am able to work with foreigners and improve my English skills.</li>
                    <li>Long term partnership desire.</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/career-goals.jpg')}}" alt="">
            </div>
        </div>
        <div class="section-container text-image-block reverse" data-aos="fade-up">
            <div class="text">
                <h2>CAREER</h2>
                <table>
                    <tr>
                        <th>Thuy Loi University</th>
                        <td>10/2016 - 05/2021</td>
                    </tr>
                    <tr>
                        <th>AHT Tech JSC </th>
                        <td>12/2020 - Present</td>
                    </tr>
                    <tr>
                        <th>Position:</th>
                        <td>ITO dev.</td>
                    </tr>
                    <tr>
                        <th>Framework:</th>
                        <td>Laravel, Reacjs.</td>
                    </tr>
                    <tr>
                        <th>CMS:</th>
                        <td>Shopify, Wordpress.</td>
                    </tr>
                    <tr>
                        <th>Knowledge:</th>
                        <td>HTML, CSS, Boostrap, Tailwind, Jquery.</td>
                    </tr>
                </table>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/careers.jpg')}}" alt="">
            </div>
        </div>
        <div class="section-container" data-aos="fade-up">
            <h2 class="underline">SKILLS</h2>
            <h5 class="sub-title">English</h5>
            <ul style="list-style: circle">
                <li>
                    English skills equivalent to TOEIC 700.
                </li>
                <li>Reading: 8/10.</li>
                <li>writing: 7.5/10.</li>
                <li>speaking: 6.5/10.</li>
                <i>All of the above data is purely self-assessment.</i>
            </ul>
            <h5 class="sub-title">Laravel</h5>
            <p>Knowledge:</p>
            <ul style="list-style: circle">
                <li>Buiding database, model, view, controller</li>
                <li>Well handle CRUD</li>
                <li>Understand Laravel design pattern, request life cycle</li>
                <li>Having experience in data tracing with laravel eloquent</li>
                <li>Experience in template blade in use</li>
                <li>Able to customizing complex modules</li>
            </ul>
            <p>Individual self-improving project:</p>
            <ul style="list-style: circle">
                <li><a class="underline" href="https://github.com/PikeTheFreelancer/My-project">Github link here</a></li>
                <li><a class="underline" href="{{route('home')}}">About this project here</a></li>
                <li>Development duration: 1 month.</li>
                <li>Work done on project:
                    <ol>
                        <li>Multi-authentication: Admin role/ User role.</li>
                        <li>Users are able to upload, edit and delete merchandises.</li>
                        <li>Users are able to edit their profile: avatar, name and other details (user table).</li>
                        <li>Users are able to comment on merchandies in market. After that, a notification will be sent(realtime) to other users that commented on the same merchandise(same to facebook comment feature).</li>
                        <li>User can lookup Pokemon info with quick search-bar.</li>
                        <li>Making design, icon, css animation.</li>
                        <li>Using ajax jquery to get/post data with out reload page.</li>
                        <li>Using scss to making style and use npm cli for compiling to css.</li>
                        <li>Using API to retrieve data (RESTfulAPI, GraphQL).</li>
                        <li>Integrate tinyMCE as an text-editor for making content and upload images.</li>
                    </ol>
                </li>
            </ul>
            <h5 class="sub-title">Frontend</h5>
            <ul style="list-style: circle">
                <li>Having experience in Reacjs, basic Vuejs.</li>
                <li>HTML, CSS, SCSS, JS, Jquery, Ajax.</li>
                <li>Having experience in working with figma, making UI/UX perfect pixel, well handle mobile responsive.</li>
            </ul>
            <h5 class="sub-title">Git</h5>
            <p>Using github, gitlab for management and storing source code.</p>
            <h5>Linux & CLI</h5>
            <ul style="list-style: circle">
                <li>Having knowledge in installing and deploying development environment in Linux OS.</li>
                <li>Work with package managers like npm, yarn.</li>
            </ul>
            <h5>Database/API</h5>
            <ul style="list-style: circle">
                <li>MySQL.</li>
                <li>RESTfulAPI, GraphQL.</li>
            </ul>
            <h5>Others</h5>
            <ul style="list-style: circle">
                <li>Team work skills.</li>
                <li>Using Jira in tasks management.</li>
                <li>Presentation skills.</li>
            </ul>
        </div>
        <div class="page-title">
            <h2>
                {{ __('Project worked in') }}
            </h2>
        </div>
        <div class="section-container text-image-block" data-aos="fade-up">
            <div class="text">
                <h2 class="underline">Indigenous art code</h2>
                <p><a class="underline" href="https://indigenousartcode.org/">Link here</a></p>
                <h5 class="sub-title">Technique:</h5>
                <p>Laravel, scss, jquery, mysql, Laravel twill, docker.</p>
                <p>Development duration: 9 months.</p>
                <p>Team size: 10.</p>
                <p>Role: Developer.</p>
                <p>Description: A website for artists communication.</p>
                <h5 class="sub-title">Works:</h5>
                <ul>
                    <li>Using CMS toolkit Twill to build admin sites.</li>
                    <li>Making BE functions and get data to FE.</li>
                    <li>Making style follow design perfect pixel.</li>
                    <li>Maintain after go live.</li>
                    <li>Review & optimize code performance.</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/iac_alter.png')}}" alt="">
            </div>
        </div>
        <div class="section-container text-image-block reverse" data-aos="fade-up">
            <div class="text">
                <h2 class="underline">Keksia</h2>
                <p><a class="underline" href="https://keksia.com.au/">Link here</a></p>
                <h5 class="sub-title">Technique:</h5>
                <p>Laravel, scss, jquery, mysql, Laravel twill.</p>
                <p>Development duration: 1 year.</p>
                <p>Team size: 4.</p>
                <p>Role: Developer.</p>
                <p>Description: A website introducing mechanic products, building materials and interiors.</p>
                <h5 class="sub-title">Works:</h5>
                <ul>
                    <li>Using CMS toolkit Twill to build admin sites.</li>
                    <li>Making BE functions and get data to FE.</li>
                    <li>Making style follow design perfect pixel.</li>
                    <li>Maintain after go live.</li>
                    <li>Review & optimize code performance.</li>
                </ul>
            </div>
            <div class="image">
                <img src="{{asset('images/pages/keksia_alter.png')}}" alt="">
            </div>
        </div>
    </div>
@endsection