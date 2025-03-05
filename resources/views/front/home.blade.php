@extends('layouts.front')

@section('subtitle', __('Home'))

@section('content')

<section class="home-banner">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="get-action big-text">
                    <h2>CONSTRUCTION INDUSTRY</h2>
                    <p>EVERY PROJECT. EVERY DAY.</p>
                    <a href="#" class="ot-btn btn-border btn-small">Get a quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-about our-services">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="service-box">
                    <a href="service-details.html"><img src="{{ asset('assets/front/images/service-home1.jpg')}}" alt=""></a>
                    <h4><a href="service-details.html">Client Centric Design</a></h4>
                    <p>Phasellus lorem enim, luctus ut velit eget, convallis egestas eros. Sed ornare ligula eget tortor tempor, quis porta tellus dictum.</p>
                    <a href="service-details.html" class="more-link">Read More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <a href="service-details.html"><img src="{{ asset('assets/front/images/service5.jpg')}}" alt=""></a>
                    <h4><a href="service-details.html">Successful Construction Project</a></h4>
                    <p>Nulla cursus augue elit, at ullamcorper urna rhoncus a. Proin ipsum tortor, gravida at convallis a, tempor sed magna</p>
                    <a href="service-details.html" class="more-link">Read More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <a href="service-details.html"><img src="{{ asset('assets/front/images/service-home3.jpg')}}" alt=""></a>
                    <h4><a href="service-details.html">Services Engineering</a></h4>
                    <p>Morbi iaculis, sem vel luctus pulvinar, tortor dolor pharetra enim, porta gravida nulla turpis sed risus. In turpis ligula</p>
                    <a href="service-details.html" class="more-link">Read More</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="features-home home3">
    <div class="parallax parallax-hourse">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center after">FEATURED SERVICES</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="features box2">
                        <img src="images/features4.png">
                        <h4>Modern Design</h4>
                        <p>Quisque pulvinar libero dolor, quis bibendum eros euismod sit amet. Proin dapibus id diam at</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="features box2">
                        <img src="images/features5.png">
                        <h4>House Renovation</h4>
                        <p>Pellentesque non diam euismod metus vehicula varius. Donec et velit placerat arcu lobortis.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="features box2">
                        <img src="images/features6.png">
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

<section class="action-image features-about">
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
                    <img src="{{ asset('assets/front/images/man.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-choose">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center after">WHY CHOOSE CONTINAL</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <figure class="vimeo"> 
                    <a href="http://player.vimeo.com/video/112734492">
                        <img src="images/video-thumb2.jpg" alt="" />
                        <img class="btn-play" src="{{ asset('assets/front/images/video-play.png')}}" alt="" />
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

<section class="latest-project2">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center after">LATEST PROJECTS</h2>
        </div>
    </div>	
    <div class="latest-list list3">

        <div class="item-latest">
            <div class="image-project" >
                <img src="{{ asset('assets/front/images/project-home1.jpg')}}" alt="">
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
            <div class="image-project" >
                <img src="images/project-home2.jpg" alt="">
                <a href="project-details.html" class="overlay"></a>
                <div class="content-bottom">
                    <div class="inner">
                        <h4><a href="project-details.html">Dream House</a></h4>
                        <div class="cat-name"><a href="#">House</a>, <a href="#">Education</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item-latest">
            <div class="image-project" >
                <img src="{{ asset('assets/front/images/project-home3.jpg')}}" alt="">
                <a href="project-details.html" class="overlay"></a>
                <div class="content-bottom">
                    <div class="inner">
                        <h4><a href="project-details.html">Hospital Center</a></h4>
                        <div class="cat-name"><a href="#">Health</a>, <a href="#">Green Park</a></div>
                    </div>
                </div>
            </div>
        </div>						
        
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="text-center after">TESTIMONIALS</h2>
                <div class="testi-carousel text-center">
        
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
                            <img src="{{ asset('assets/front/images/testi1.jpg')}}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi2.jpg')}}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi3.jpg')}}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi4.jpg')}}" alt="">
                        </div>
                        <div class="testi-img">
                            <img src="{{ asset('assets/front/images/testi5.jpg')}}" alt="">
                        </div>
                    </div>
                        
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="partners">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div id="client-logo" class="logos2">
                    <div class="item-logo">
                        <a href="#"><img src="images/client1.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client2.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client3.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client4.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client5.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client6.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client7.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client8.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client1.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client2.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client3.png" alt=""></a>
                    </div>
                    <div class="item-logo">
                        <a href="#"><img src="images/client4.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection