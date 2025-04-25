@extends('layouts.front')

@section('subtitle', __('Turnkey Offer'))

{{-- @section('meta-description', __('Discover our turnkey offer, designed to provide you with a complete solution for your construction needs. We handle everything from design to execution, ensuring quality and efficiency throughout the process.'))
@section('meta-keywords', 'turnkey offer, construction, design, execution, quality, efficiency') --}}

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center py-5">
        <div class="container position-relative">
            <h1 class="main-title mb-4">@lang('Our Turnkey Offer')</h1>
            <hr>
        </div>
    </section>
    
    <!-- Key Offering Section -->
    <section id="key-offering" class="key-offering-section py-6">
        <div class="container">
            <div class="row gx-5 gy-4">
                <!-- Card 1 -->
                <div class="col-lg-5">
                    <div class="card shadow-lg h-100 border-0 hover-lift">
                        <div class="card-body p-5">
                            <strong><h3>@lang('Enjoy Peace of Mind')</h3></strong>
                            {{-- <p>@lang('As a general contractor, we manage all technical, logistical, and financial aspects to ensure a hassle-free turnkey project.')</p> --}}
                            <ul>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    @lang('Anticipation of execution and safety constraints')
                                </li>
                                <br>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    @lang('Experience feedback and comparative analysis')
                                </li>
                                <br>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    @lang('PMG offer for more transparency')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-7">
                    <div class="card shadow-lg h-100 border-0 hover-lift">
                        <div class="card-body p-5">
                            <strong><h3>@lang('Our Strengths & Benefits')</h3></strong>
                            <ul class="list-unstyled benefits-grid">
                                <div class="col-md-6"><li><i class="fas fa-gem"></i> @lang('Single team from design to delivery')</li></div>
                                <div class="col-md-6"><li><i class="fas fa-cogs"></i> @lang('Multidisciplinary expertise')</li></div>
                                <div class="col-md-6"><li><i class="fas fa-user-check"></i> @lang('Immersion in the client\'s business')</li></div>
                                <div class="col-md-6"><li><i class="fas fa-chart-line"></i> @lang('Optimized financial performance')</li></div>
                                <div class="col-md-6"><li><i class="fas fa-industry"></i> @lang('Expertise in occupied sites')</li></div>
                                <div class="col-md-6"><li><i class="fas fa-sync"></i> @lang('System & Process Integration')</li></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 50px;">
        </div>
    </section>

    <section class="features-about">
        <div class="parallax parallax-hourse">
            <div class="container">
                <div class="row">
        
                    <div class="col-sm-3">
                        <div class="features">
                            <div class="feature-card text-center">
                                <div class="icon-box mb-3">
                                    <i class="fas fa-thumbs-up fa-2x"></i>
                                </div>
                                <h3>@lang('Quality')</h3>
                                <ul>
                                    <li>@lang('High-quality finish with no major reservations')</li>
                                    <li>@lang('Anticipated and smoothly executed commissioning')</li>
                                    <li>@lang('Personalized customer service with adaptation')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-sm-3">
                        <div class="features">
                            <div class="feature-card text-center">
                                <div class="icon-box mb-3">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <h3>@lang('Cost')</h3>
                                <ul class="feature-list">
                                    <li>@lang('Value engineering throughout the project to optimize costs')</li>
                                    <li>@lang('Transparent pricing')</li>
                                    <li>@lang('Guaranteed Maximum Price (GMP) contract')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-sm-3">
                        <div class="features">
                            <div class="feature-card text-center">
                                <div class="icon-box mb-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <h3>@lang('Time')</h3>
                                <ul class="feature-list">
                                    <li>@lang('Commitment to a global schedule from the design phase')</li>
                                    <li>@lang('Daily project management')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
        
                        <div class="col-sm-3">
                            <div class="features">
                                <div class="feature-card text-center">
                                    <div class="icon-box mb-3">
                                        <i class="fas fa-shield-alt fa-2x"></i>
                                    </div>
                                    <h3>@lang('Insurance')</h3>
                                    <ul class="feature-list">
                                        <li>@lang('Highly effective coverage included as standard in our projects')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

{{-- @push('js')    
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.easing.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.responsiveTabs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/visible.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/pro-bars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/smk-accordion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-elements.js') }}"></script>
@endpush --}}