@extends('layouts.front')

@section('subtitle', __('About'))

@section('content')

    <section class="top-about">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <h4>@lang('What We Do')</h4>
                    <p class="text-justify">@lang('We specialize in delivering top-notch construction services, ensuring quality and efficiency in every project. Our team is dedicated to meeting your needs and exceeding your expectations.')</p>

                    <h4 class="values">@lang('Our Values')</h4>
                    <div class="accordion">
        
                        <div class="accordion_in acc_active">
                            <div class="acc_head"><i class="fa fa-crop"></i> @lang('Creative Design')</div>
                            <div class="acc_content">
                                <p class="text-justify">@lang('We pride ourselves on innovative and creative designs that bring your vision to life. Our designs are not only aesthetically pleasing but also functional and sustainable. We work closely with our clients to understand their needs and preferences, ensuring that every design is tailored to meet their specific requirements. Our team of designers is skilled in creating unique and modern designs that stand out and make a lasting impression.')</p>
                            </div>
                        </div>

                        <div class="accordion_in">
                            <div class="acc_head"><i class="fa fa-cogs"></i> @lang('Transparency')</div>
                            <div class="acc_content">
                                <p class="text-justify">@lang("We believe in maintaining complete transparency with our clients. From project inception to completion, we keep you informed every step of the way. Our transparent approach ensures that there are no surprises, and you are always aware of the progress and any potential challenges. We provide regular updates and detailed reports, so you have a clear understanding of the project's status. Our commitment to transparency builds trust and fosters strong relationships with our clients.")</p>
                            </div>
                        </div>
                    
                        <div class="accordion_in">
                            <div class="acc_head"><i class="fa fa-diamond"></i> @lang('Expertise')</div>
                            <div class="acc_content">
                                <p class="text-justify">@lang('Our team consists of highly skilled professionals with extensive experience in the construction industry. We bring expertise and precision to every project. Our team members are experts in their respective fields, including architecture, engineering, project management, and construction. We stay up-to-date with the latest industry trends and best practices to ensure that we deliver the highest quality work. Our expertise allows us to tackle complex projects and deliver exceptional results.')</p>
                            </div>
                        </div>

                        <div class="accordion_in">
                            <div class="acc_head"><i class="fa fa-suitcase"></i> @lang('Reliability')</div>
                            <div class="acc_content">
                                <p class="text-justify">@lang("Reliability is at the core of our business. We ensure that every project is completed on time and within budget, without compromising on quality. Our clients can count on us to deliver what we promise. We have a proven track record of successfully completing projects on schedule and within the agreed budget. Our reliable approach minimizes disruptions and ensures a smooth construction process. We take pride in our ability to consistently meet and exceed our clients' expectations.")</p>
                            </div>
                        </div>

                        <div class="accordion_in">
                            <div class="acc_head"><i class="fa fa-trophy"></i> @lang('High Technologies')</div>
                            <div class="acc_content">
                                <p class="text-justify">@lang('We leverage the latest technologies to enhance our construction processes. Our use of advanced tools and techniques ensures superior results. We invest in cutting-edge technology to improve efficiency, accuracy, and safety on our projects. From Building Information Modeling to drone surveys and 3D printing, we utilize a range of innovative technologies to streamline our operations and deliver high-quality work. Our commitment to technology allows us to stay ahead of the curve and provide our clients with the best possible solutions.')</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <figure class="vimeo"> 
                        <a href="http://player.vimeo.com/video/112734492">
                            <img src="{{ asset('assets/front/images/video-thumb.jpg') }}" alt="" />
                            <img class="btn-play" src="{{ asset('assets/front/images/video-play.png') }}" alt="" />
                        </a>
                    </figure>
                    <div class="image-about">
                        <img src="{{ asset('assets/front/images/about1.png') }}" alt="">
                        <img src="{{ asset('assets/front/images/about2.png') }}" alt="">
                    </div>
                </div>

            </div>
        </div>					
    </section>

    <section class="shadow-section">
        <div class="container">
            <div class="box-shadow"></div>
        </div>
    </section>

    <section class="features-about">
        @include('includes.front.parallax-section')
    </section>

    <section class="team-about">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('assets/front/images/team1.jpg') }}" alt="">
                            <div class="overlay">
                                <div class="social-team">
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <h5>Peter Hart</h5>
                        <p>@lang('Construction Manager')</p>									
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('assets/front/images/team2.jpg') }}" alt="">
                            <div class="overlay">
                                <div class="social-team">
                                    <a href="#"><i class="fa fa-vimeo"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <h5>Betty Lane</h5>
                        <p>@lang('Project Manager')</p>									
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('assets/front/images/team3.jpg') }}" alt="">
                            <div class="overlay">
                                <div class="social-team">
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <h5>Richard Pierce</h5>
                        <p>@lang('Architect Electric')</p>									
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('assets/front/images/team4.jpg') }}" alt="">
                            <div class="overlay">
                                <div class="social-team">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <h5>Janice Rose</h5>
                        <p>@lang('Construction Engineer')</p>									
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-about.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/smk-accordion.js') }}"></script>
@endpush