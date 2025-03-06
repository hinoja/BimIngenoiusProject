@extends('layouts.front')

@section('subtitle', __('Home'))

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
                            Welcome to <span class="color">Continal</span>
                        </div>

                        <div class="tp-caption sfr stb custom-font-1 tp-resizeme"
                            data-x="right"
                            data-hoffset="-15"
                            data-y="230"
                            data-speed="400"
                            data-start="1400"
                            data-easing="easeInOut">
                            Construction company
                        </div>

                        <div class="tp-caption sfr stl tp-resizeme"
                            data-x="right"
                            data-hoffset="-175"
                            data-y="320"
                            data-speed="400"
                            data-start="1700"
                            data-easing="easeInOut">
                            <a class="ot-btn btn-color tp-resizeme" href="services.html">Our services</a>
                        </div>
                        <div class="tp-caption sfr str tp-resizeme"
                            data-x="right"
                            data-hoffset="-15"
                            data-y="320"
                            data-speed="400"
                            data-start="1800"
                            data-easing="easeInOut">
                            <a class="ot-btn btn-border tp-resizeme" href="contact.html">Get a quote</a>
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
                            Customer Focused
                        </div>

                        <div class="tp-caption sfl stb custom-font-1 tp-resizeme"
                            data-x="right"
                            data-hoffset="-15"
                            data-y="230"
                            data-speed="400"
                            data-start="1400"
                            data-easing="easeInOut">
                            Construction Solutions
                        </div>

                        <div class="tp-caption sfl stl tp-resizeme"
                            data-x="right"
                            data-hoffset="-175"
                            data-y="320"
                            data-speed="400"
                            data-start="1800"
                            data-easing="easeInOut">
                            <a class="ot-btn btn-color tp-resizeme" href="project-list.html">Our Projects</a>
                        </div>
                        <div class="tp-caption sfl str tp-resizeme"
                            data-x="right"
                            data-hoffset="-15"
                            data-y="320"
                            data-speed="400"
                            data-start="1700"
                            data-easing="easeInOut">
                            <a class="ot-btn btn-border tp-resizeme" href="contact.html">Get a quote</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- revolution slider close -->
    </div>
</section>
<section class="features-home">
    <div class="parallax parallax-hourse">
        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <div class="features">
                        <div class="top-img"><img src="{{ asset('assets/front/images/features1.png') }}" alt=""></div>
                        <h4>Modern Design</h4>
                        <p>Quisque pulvinar libero dolor, quis bibendum eros euismod sit amet. Proin dapibus id diam at</p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="features">
                        <div class="top-img"><img src="{{ asset('assets/front/images/features2.png') }}" alt=""></div>
                        <h4>Construction Managment</h4>
                        <p>Pellentesque non diam euismod metus vehicula varius. Donec et velit placerat arcu lobortis.</p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="features">
                        <div class="top-img"><img src="{{ asset('assets/front/images/features3.png') }}" alt=""></div>
                        <h4>General Contractor</h4>
                        <p>Gravida at convallis a, tempor sed magna. Pellentesque non diam euismod metus vehicula</p>
                    </div>
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

<section class="latest-project features-about">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center after">@lang('LATEST PROJECTS')</h2>
            <div class="latest-list">
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project1.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Dimen Center</a></h4>
                                <div class="cat-name"><a href="#">Office</a>, <a href="#">Education</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project2.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Damon Resort</a></h4>
                                <div class="cat-name"><a href="#">Interior Design</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project">
                        <img src="{{ asset('assets/front/images/project3.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Dream House</a></h4>
                                <div class="cat-name"><a href="#">House</a>, <a href="#">Health</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project4.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Hospital Center</a></h4>
                                <div class="cat-name"><a href="#">Health</a>, <a href="#">Green Park</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project5.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Dagittis Park</a></h4>
                                <div class="cat-name"><a href="#">Education</a>, <a href="#">Green Park</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project6.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Posuere Hospital</a></h4>
                                <div class="cat-name"><a href="#">Health</a>, <a href="#">House</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project7.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Primis office</a></h4>
                                <div class="cat-name"><a href="#">Office</a>, <a href="#">Interior Design</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-latest">
                    <div class="image-project" >
                        <img src="{{ asset('assets/front/images/project8.jpg') }}" alt="">
                        <a href="project-details.html" class="overlay"></a>
                        <div class="content-bottom">
                            <div class="inner">
                                <h4><a href="project-details.html">Dagittis City</a></h4>
                                <div class="cat-name"><a href="#">Office</a>, <a href="#">Green Park</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>							
    </div>
</section>

<section class="why-choose">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center after">@lang('WHY CHOOSE BIM')</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <figure class="vimeo"> 
                    <a href="http://player.vimeo.com/video/112734492">
                        <img src="images/video-thumb2.jpg" alt="" />
                        <img class="btn-play" src="images/video-play.png" alt="" />
                    </a>
                </figure>
            </div>
            <div class="col-md-6">
                <div class="features box4">
                    <h4><i class="fa fa-cogs"></i>Transparency</h4>
                    <p>Morbi vehicula a nibh in commodo. Aliquam quis dolor eget lectus pulvinar malesuada. Suspendisse eu rhoncus ligula. </p>
                </div>
                <div class="features box4">
                    <h4><span><i class="fa fa-diamond"></i>Expertise</span></h4>
                    <p>Nam orci metus, varius at nisl at, tempor facilisis magna. Ut maximus felis tincidunt lacinia. Nulla malesuada ipsum at magna condimentum pharetra.</p>
                </div>
                <div class="features box4">
                    <h4><span><i class="fa fa-suitcase"></i>Reliability</span></h4>
                    <p>Fusce viverra risus diam, in luctus nulla porta vel. Etiam nunc lorem, dapibus augue vitae, lacinia pharetra eros. Fusce ac egestas purus, non porta est.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="parallax-action">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="get-action">
                    <h4>WORKING WITH US</h4>
                    <p>WE DESIGN, CONSTRUCT, REFURBISH AND OPERATE<br> OUTSTANDING BUILDINGS.</p>
                    <div><a href="#" class="ot-btn btn-color btn-small">Get a Quote</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testi-partner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="left after">@lang('TESTIMONIALS')</h2>
                <div class="testi-carousel">
        
                    <div id="sync-3" class="owl-carousel text">
                        <div class="item">
                            <p>Morbi auctor vel mauris facilisis lacinia. Aenean suscipit lorem leo, et hendrerit odio fermentum et. Donec ac dolor eros. Mauris arcu nunc, iaculis sit amet lacus iaculis, faucibus faucibus nunc. Vestibulum sit amet lacinia massa</p>
                            <div class="info">
                                <strong>Cheryl Cruz</strong>
                                <span>Senior Engineer, The Building Co</span>
                            </div>
                        </div>
                        <div class="item">
                            <p>Aenean suscipit lorem leo, et hendrerit odio fermentum et. Vestibulum sit amet lacinia massa. Donec ac dolor eros. Mauris arcu nunc, iaculis sit amet lacus iaculis, faucibus faucibus nunc.</p>
                            <div class="info">
                                <strong>John Doe</strong>
                                <span>Construction Engineer, The Building Co</span>
                            </div>
                        </div>
                        <div class="item">
                            <p>Nulla eleifend, sapien eget porttitor maximus, nisl ante convallis dolor, nec consequat felis ex a ex. Etiam vestibulum enim euismod dui vestibulum, vitae fringilla nibh consectetur. Integer at volutpat augue.</p>
                            <div class="info">
                                <strong>RICHARD PIERCE</strong>
                                <span>Construction Manager, The Building Co</span>
                            </div>
                        </div>
                        <div class="item">
                            <p>In hac habitasse platea dictumst. Mauris orci lectus, pretium sed vehicula at, aliquet quis tellus. Quisque justo odio, elementum in lobortis nec, accumsan et nisi. Donec mattis ex aliquam enim congue aliquet. </p>
                            <div class="info">
                                <strong>BETTY LANE</strong>
                                <span>Project Manager, The Building Co</span>
                            </div>
                        </div>
                        <div class="item">
                            <p>Sed nec velit interdum, tempor nunc ac, consequat risus. Nunc massa augue, fermentum in dapibus in, mattis non orci. Donec consequat ac eros non elementum. Mauris condimentum imperdiet blandit. Vestibulum sit amet lacinia massa</p>
                            <div class="info">
                                <strong>PETER HART</strong>
                                <span>Architect Electric, The Building Co</span>
                            </div>
                        </div>
                    </div>

                    <div id="sync-4" class="owl-carousel images">
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi1.jpg') }}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi2.jpg') }}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi3.jpg') }}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi4.jpg') }}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi5.jpg') }}" alt="">
                        </div>
                    </div>
                        
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="left after">@lang('OUR PARTNERS')</h2>
                <div class="list-logo">
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client1.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client2.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client3.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client4.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client5.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client6.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client7.png') }}" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="{{ asset('assets/front/images/client8.png') }}" alt=""></a>
                    </div>
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
                <div class="item-post">
                    <a href="blog-post.html"><img src="{{ asset('assets/front/images/blog-home1.jpg') }}" alt=""></a>
                    <div class="desc">
                        <h4><a href="blog-post.html">U.S construction scheme hits maximum marks for safety</a></h4>
                        <p>Phasellus lorem enim, luctus ut velit eget, convallis egestas eros. Sed ornare ligula eget tortor tempor, quis porta tellus dictum.</p>
                        <p><a href="blog-post.html" class="more-link">Continue Reading</a></p>
                    </div>
                    <p class="date-post">April 15, 2016</p>
                </div>
                <div class="item-post">
                    <a href="blog-post.html"><img src="{{ asset('assets/front/images/blog-home2.jpg') }}" alt=""></a>
                    <div class="desc">
                        <h4><a href="blog-post.html">Successful property development is never just about bricks</a></h4>
                        <p>Nulla cursus augue elit, at ullamcorper urna rhoncus a. Proin ipsum tortor, gravida at convallis a, tempor sed magna</p>
                        <p><a href="blog-post.html" class="more-link">Continue Reading</a></p>
                    </div>
                    <p class="date-post">Marh 25, 2016</p>
                </div>
                <div class="item-post">
                    <a href="blog-post.html"><img src="{{ asset('assets/front/images/blog-home3.jpg') }}" alt=""></a>
                    <div class="desc">
                        <h4><a href="blog-post.html">ARC Design obtains planning permission for your house</a></h4>
                        <p>Morbi iaculis, sem vel luctus pulvinar, tortor dolor pharetra enim, porta gravida nulla turpis sed risus. In turpis ligula</p>
                        <p><a href="blog-post.html" class="more-link">Continue Reading</a></p>
                    </div>
                    <p class="date-post">February 10, 2016</p>
                </div>
                <div class="item-post">
                    <a href="blog-post.html"><img src="{{ asset('assets/front/images/blog-home4.jpg') }}" alt=""></a>
                    <div class="desc">
                        <h4><a href="blog-post.html">Build Amazing Theme For You</a></h4>
                        <p>In hac habitasse platea dictumst. Mauris orci lectus, pretium sed vehicula at, aliquet quis tellus. Elementum in nec, accumsan et nisi. Fusce in odio consequat odio iaculis vulputate.</p>
                        <p><a href="blog-post.html" class="more-link">Continue Reading</a></p>
                    </div>
                    <p class="date-post">February 05, 2016</p>
                </div>
                <div class="item-post">
                    <a href="blog-post.html"><img src="{{ asset('assets/front/images/blog-home5.jpg') }}" alt=""></a>
                    <div class="desc">
                        <h4><a href="blog-post.html">We’re Construction Strong</a></h4>
                        <p>Cras commodo vitae turpis eu cursus. In tristique dolor et gravida commodo. Aliquam non ornare velit. Etiam felis ipsum, hendrerit ut euismod interdum.</p>
                        <p><a href="blog-post.html" class="more-link">Continue Reading</a></p>
                    </div>
                    <p class="date-post">February 05, 2016</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="action-image">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="get-action dark">
                    <h4>WORKING WITH US</h4>
                    <p>WE DESIGN, CONSTRUCT, REFURBISH AND OPERATE OUTSTANDING BUILDINGS.</p>
                    <div><a href="#" class="ot-btn btn-color btn-small">Get a Quote</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="image-right">
                    <img src="{{ asset('assets/front/images/man.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection