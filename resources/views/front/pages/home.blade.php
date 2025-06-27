@extends('layouts.front')

@section('subtitle', __('Home'))

@push('css')
    <style>
        /* Latest Projects */
        .latest-list .image-project img {
            width: 100%;
            max-width: 340px;
            height: 210px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto;
            background: #f6f6f6;
        }

        /* Latest Blog/News */
        .latest-post .item-post img {
            width: 100%;
            max-width: 358px;
            height: 180px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto;
            background: #f6f6f6;
        }

        .latest-post .item-post {
            height: 440px;
            display: flex;
            flex-direction: column;
        }
        .latest-post .item-post img {
            width: 100%;
            max-width: 358px;
            height: 180px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto;
            background: #f6f6f6;
        }
        .latest-post .item-post .desc {
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .latest-post .item-post .desc h4 {
            font-size: 1.1em;
            min-height: 3em;
            max-height: 3em;
            line-height: 1.5em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
            white-space: normal;
            margin-bottom: 10px;
        }

        @media (max-width: 767px) {
            .latest-list .image-project img,
            .latest-post .item-post img {
                max-width: 100%;
                height: 320px;
            }
            .latest-post .item-post {
                height: auto;
                min-height: 320px;
            }
        }
    </style>
@endpush

@section('content')

    <section class="home-slider">
        <div id="slider">
            <!-- revolution slider begin -->
            <div class="fullwidthbanner-container">
                <div id="revolution-slider">

                    <ul>
                        <li data-transition="slidedown" data-slotamount="7" data-masterspeed="800">
                            <!--  BACKGROUND IMAGE -->
                            <img src="{{ asset('assets/front/images/home-slider1/slide1.jpg') }}" alt="">

                            <div class="tp-caption sfr stt custom-font-2 tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="188"
                                data-speed="400"
                                data-start="1000"
                                data-easing="easeInOut">
                                @lang('Welcome to') <span class="color">{{ config('app.name') }}</span>
                            </div>

                            <div class="tp-caption sfr stb custom-font-1 tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="230"
                                data-speed="400"
                                data-start="1400"
                                data-easing="easeInOut">
                                @lang('Leading Construction Firm')
                            </div>

                            <div class="tp-caption sfr stl tp-resizeme"
                                @style(['margin-right: 5px' => true])
                                data-x="right"
                                data-hoffset="-175"
                                data-y="320"
                                data-speed="400"
                                data-start="1700"
                                data-easing="easeInOut">
                                <a class="ot-btn btn-border tp-resizeme" href="{{ route('front.categories.index') }}">@lang('Our Domains')</a>
                            </div>
                            <div class="tp-caption sfr str tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="320"
                                data-speed="400"
                                data-start="1800"
                                data-easing="easeInOut">
                                <a class="ot-btn btn-color tp-resizeme" href="{{ route('front.projects.index') }}">@lang('Our Projects')</a>
                            </div>
                        </li>

                        <li data-transition="slidedown" data-slotamount="7" data-masterspeed="800" data-delay="6000">
                            <!--  BACKGROUND IMAGE -->
                            <img src="{{ asset('assets/front/images/home-slider1/slide2.jpg') }}" alt="">

                            <div class="tp-caption sfl stt custom-font-2 tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="188"
                                data-speed="400"
                                data-start="1000"
                                data-easing="easeInOut">
                                @lang('Client-Centric Approach')
                            </div>

                            <div class="tp-caption sfl stb custom-font-1 tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="230"
                                data-speed="400"
                                data-start="1400"
                                data-easing="easeInOut">
                                @lang('Innovative Construction Solutions')
                            </div>

                            <div class="tp-caption sfl stl tp-resizeme"
                                @style(['margin-right: 5px' => true])
                                data-x="right"
                                data-hoffset="-175"
                                data-y="320"
                                data-speed="400"
                                data-start="1800"
                                data-easing="easeInOut">
                                <a class="ot-btn btn-border tp-resizeme" href="{{ route('front.about') }}">@lang('About Us')</a>
                            </div>
                            <div class="tp-caption sfl str tp-resizeme"
                                data-x="right"
                                data-hoffset="-15"
                                data-y="320"
                                data-speed="400"
                                data-start="1700"
                                data-easing="easeInOut">
                                <a class="ot-btn btn-color tp-resizeme" href="{{ route('front.plans.index') }}">@lang('Our Plans')</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- revolution slider close -->
        </div>
    </section>
    <section class="features-home">
        @include('includes.front.parallax-section')
    </section>

    <section class="shadow-section">
        <div class="container">
            <div class="box-shadow"></div>
        </div>
    </section>

    <section class="latest-project features-about">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center after">@lang('RECENT PROJECTS')</h2>
                <div class="latest-list">
                    @forelse ($projects as $project)
                        <div class="item-latest">
                            <div class="image-project" >
                                <img src="{{ $project->image }}" alt="{{ $project->title }}">
                                <a href="{{ route('front.projects.show', $project) }}" class="overlay"></a>
                                <div class="content-bottom">
                                    <div class="inner">
                                        <h4><a href="{{ route('front.projects.show', $project) }}">{{ $project->title }}</a></h4>
                                        <div class="cat-name"><a href="#">{{ $project->category->name }}</a>, <i>{{ $project->tags?->first()->name }}</i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">@lang('No project published yet.')</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- <br>

    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="features box4 right">
                    <h4><i class="fa fa-cogs"></i>@lang('Transparency')</h4>
                    <p>Morbi vehicula a nibh in commodo. Aliquam quis dolor eget lectus pulvinar malesuada. Suspendisse eu rhoncus ligula. </p>
                </div>
                <div class="features box4 right">
                    <h4><span><i class="fa fa-diamond"></i>@lang('Expertise')</span></h4>
                    <p>Nam orci metus, varius at nisl at, tempor facilisis magna. Ut maximus felis tincidunt lacinia. Nulla malesuada ipsum at magna condimentum pharetra.</p>
                </div>
                <div class="features box4 right">
                    <h4><span><i class="fa fa-suitcase"></i>@lang('Reliability')</span></h4>
                    <p>Fusce viverra risus diam, in luctus nulla porta vel. Etiam nunc lorem, dapibus augue vitae, lacinia pharetra eros. Fusce ac egestas purus, non porta est.</p>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="features box4">
                    <h4><i class="fa fa-crop"></i>@lang('Creative')</h4>
                    <p>Morbi vehicula a nibh in commodo. Aliquam quis dolor eget lectus pulvinar malesuada. Suspendisse eu rhoncus ligula. </p>
                </div>
                <div class="features box4">
                    <h4><span><i class="fa fa-bank"></i>@lang('Customer')</span></h4>
                    <p>Nam orci metus, varius at nisl at, tempor facilisis magna. Ut maximus felis tincidunt lacinia. Nulla malesuada ipsum at magna condimentum pharetra.</p>
                </div>
                <div class="features box4">
                    <h4><span><i class="fa fa-users"></i>@lang('People')</span></h4>
                    <p>Fusce viverra risus diam, in luctus nulla porta vel. Etiam nunc lorem, dapibus augue vitae, lacinia pharetra eros. Fusce ac egestas purus, non porta est.</p>
                </div>
            </div>

        </div>
    </div>

    <br> --}}

    <section class="parallax-action">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="get-action">
                        <h4>@lang('WORKING WITH US')</h4>
                        <p>@lang('WE DESIGN, CONSTRUCT, REFURBISH AND OPERATE')<br> @lang('OUTSTANDING BUILDINGS').</p>
                        <div><a href="" class="ot-btn btn-color">@lang('Request a Quote')</a></div>
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

    <section class="latest-blog features-about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center after">@lang('LATEST NEWS')</h2>
                </div>
            </div>
            <div class="row">
                <div id="latest-post" class="owl-carousel latest-post">
                    @forelse ($news as $news_item)
                        <div class="item-post">
                            <a href="{{ route('front.news.show', $news_item) }}"><img src="{{ $news_item->image }}" alt="{{ $news_item->title }}"></a>
                            <div class="desc">
                                <h4><a href="{{ route('front.news.show', $news_item) }}">{{ $news_item->title }}</a></h4>
                                <p class="text-justify">{{ str_replace('&nbsp;', ' ', strip_tags(Str::limit($news_item->content, 120))) }}</p>
                                <p><a href="{{ route('front.news.show', $news_item) }}" class="more-link">@lang('Continue Reading')</a></p>
                            </div>
                            <p class="date-post">{{ $news_item->published_at }}</p>
                        </div>
                    @empty
                        <div class="text-center">@lang('No news published yet.')</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="action-image">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="get-action dark">
                        <h4>@lang('WORKING WITH US')</h4>
                        <p>@lang('WE DESIGN, CONSTRUCT, REFURBISH AND OPERATE OUTSTANDING BUILDINGS').</p>
                        <div><a href="#" class="ot-btn btn-color btn-small">@lang('Request a Quote')</a></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="image-right">
                        <img src="{{ asset('assets/front/images/man.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection

@push('js')
    <!-- SLIDER REVOLUTION SCRIPTS  -->
    <script type="text/javascript" src="{{ asset('assets/front/rs-plugin/js/jquery.themepunch.plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/revslider-custom.js') }}"></script>
@endpush
