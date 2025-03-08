@extends('layouts.front')

@section('subtitle', __('Projects'))

@section('content')

    <section class="list-projects">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul id="filter" class="filter-projects none-style">
                        <li><a href="#" class="current" data-filter="*" title="">All Projects</a></li>
                        <li><a href="#" data-filter=".interior" title="">Interior Design </a></li>
                        <li><a href="#" data-filter=".education" title="">Education</a></li>
                        <li><a href="#" data-filter=".office" title="">Office</a></li>
                        <li><a href="#" data-filter=".health" title="">Health</a></li>
                        <li><a href="#" data-filter=".house" title="">House</a></li>
                        <li><a href="#" data-filter=".park" title="">Green Park</a></li>
                    </ul>
                </div>							
            </div>
            <div class="row">
                <div id="gallery" class="all-project">
                    <div class="col-md-4 col-sm-6 item office">									
                        <div class="project-box ">
                            <a href="project-detailsv2.html" class="image-project">
                                <img src="images/project1.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Dimen Center</a></h4>
                            <div class="cat-name"><a href="#">Office</a>, <a href="#">Education</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item interior">
                        <div class="project-box ">
                            <a href="project-detailsv2.html" class="image-project">
                                <img src="images/project2.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Damon Resort</a></h4>
                            <div class="cat-name"><a href="#">Interior Design</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item house">
                        <div class="project-box ">
                            <a href="project-details.html" class="image-project" >
                                <img src="images/project3.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Dream House</a></h4>
                            <div class="cat-name"><a href="#">House</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item health park">
                        <div class="project-box ">
                            <a href="project-detailsv2.html" class="image-project" >
                                <img src="images/project4.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Hospital Center</a></h4>
                            <div class="cat-name"><a href="#">Health</a>, <a href="#">Green Park</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item education park">
                        <div class="project-box ">
                            <a href="project-details.html" class="image-project" >
                                <img src="images/project5.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Dagittis Park</a></h4>
                            <div class="cat-name"><a href="#">Education</a>, <a href="#">Green Park</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item health">
                        <div class="project-box ">
                            <a href="project-detailsv2.html" class="image-project" >
                                <img src="images/project6.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Posuere Hospital</a></h4>
                            <div class="cat-name"><a href="#">Health</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item interior office">
                        <div class="project-box ">
                            <a href="project-details.html" class="image-project" >
                                <img src="images/project7.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Primis office</a></h4>
                            <div class="cat-name"><a href="#">Office</a>, <a href="#">Interior Design</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item park office">
                        <div class="project-box ">
                            <a href="project-detailsv2.html" class="image-project" >
                                <img src="images/project8.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Dagittis City</a></h4>
                            <div class="cat-name"><a href="#">Office</a>, <a href="#">Green Park</a></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 item park">
                        <div class="project-box ">
                            <a href="project-details.html" class="image-project" >
                                <img src="images/project9.jpg" alt="">
                                <span class="overlay"></span>
                            </a>
                            <h4><a href="project-details.html">Faucibus City</a></h4>
                            <div class="cat-name"><a href="#">Green Park</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <ul class="pagination">				                        
                <li><span class="page-numbers current">1</span></li>
                <li><a class="page-numbers" href="#">2</a></li>
                <li><a class="page-numbers" href="#">3</a></li>
                <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>				                    
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.isotope.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projectlist.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog.js') }}"></script> 
@endpush