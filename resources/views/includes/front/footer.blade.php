<footer>
    <div class="widget-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h4><a href="{{ route('front.home') }}"><img src="{{ asset('assets/front/images/logos/main-logo.png')}}" alt="{{ config('app.name') }}"></a></h4>
                        <p class="text-justify">@lang('We specialize in delivering top-notch construction services, ensuring quality and efficiency in every project. Our team is dedicated to meeting your needs and exceeding your expectations.')</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h4>@lang('Quick links')</h4>
                        <div class="row">
                            <div class="col-xs-6 col-lg-5">
                                <ul>
                                    <li><a href="{{ route('front.home') }}">@lang('Home')</a></li>
                                    <li><a href="{{ route('front.about') }}">@lang('About')</a></li>
                                    <li><a href="{{ route('front.projects.index') }}">@lang('Projects')</a></li>
                                    <li><a href="{{ route('front.plans.index') }}">@lang('Plans')</a></li>
                                    <li><a href="{{ route('front.news.index') }}">@lang('News')</a></li>
                                    <li><a href="{{ route('front.contact') }}">@lang('Contact')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>@lang('Contact Us')</h4>
                    <div class="textwidget">
                        <p><i class="fa fa-home"></i> 379 5th Ave  New York, NYC 10018</p>
                        <p><i class="fa fa-phone"></i> (+1) 96 716 6879</p>
                        <p><i class="fa fa-fax"></i> (+1) 96 716 6879</p>
                        <p><i class="fa fa-envelope-o"></i> contact@site.com</p>
                        <p><i class="fa fa-clock-o"></i> Mon-Fri 09:00 - 17:00 Mon-Fri</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>@lang('Gallery')</h4>
                    <div class="gallery-image">
                        <a href="#"><img src="{{ asset('assets/front/images/gallery1.jpg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/front/images/gallery2.jpg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/front/images/gallery3.jpg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/front/images/gallery4.jpg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/front/images/gallery5.jpg') }}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/front/images/gallery6.jpg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <p>Copyright © 2016 Designed by AuThemes. All rights reserved.</p>
        </div>
    </div>
</footer>