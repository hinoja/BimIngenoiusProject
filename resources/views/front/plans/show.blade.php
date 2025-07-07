@extends('layouts.front')

@section('subtitle', $plan->title)
@section('description', __('Explore the details and technical insights of this construction plan.'))


@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" /> --}}

    <style>
        .project-slider .owl-item img {
            width: 100%;
            max-width: 400px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 auto;
            display: block;
        }

        .plan-image-small {
            max-width: 400px;
            max-height: 350px;
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto;
        }

        .transparent-bg {
            background: rgb(245 240 240 / 55%);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        }

        @media (max-width: 600px) {
            .project-slider .owl-item img,
            .plan-image-small {
                max-width: 100%;
                height: 180px;
            }
        }
    </style>
@endpush

@section('content')

    @section('previousUrl', route('front.plans.index'))
    @section('previousTitle', __('Plans'))

    <section class="single-project">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <div class="project-slider owl-carousel">
                        @forelse ($plan->images as $index => $image)
                            <a href="{{ asset('storage/' . $image->name) }}" class="glightbox">
                                <div><img src="{{ asset('storage/' . $image->name) }}" alt="{{ $plan->title . ' ' . $loop->iteration }}"></div>
                            </a>
                        @empty
                            <div><img src="{{ $plan->image }}" alt="{{ $plan->title }}"></div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 25px;">
                <div class="col-md-6">
                    <h4 class="intro-text text-center" style="margin-bottom: 25px;">@lang('Plan Image')</h4>
                    <div class="row postion-relative">
                        <a href="{{ asset('storage/' . $plan->image2D) }}" class="glightbox d-block" style="position:relative;">
                            <img src="{{ asset('storage/' . $plan->image2D) }}" alt="{{ $plan->title }}" class="plan-image-small">
                            <button type="button"
                                class="btn btn-zoom"
                                style="position:absolute;bottom:5px;right:100px;background:rgba(0, 0, 0, 0.247);color:#fff;border:none;border-radius:50%;padding:10px 12px;cursor:pointer;">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </a>
                    </div>

                    <div class="row" style="margin-top: 35px;">
                        <div class="project-des">
                            <h4 class="text-center">@lang('Plan Info')</h4>
                            <p class="text-justify">{!! $plan->description !!}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr style="height: 0.5px; background-color: black;">
                        @include('includes.front.social-media-share', ['data' => $plan])
                    </div>
                </div>
                {{-- Quote form --}}
                <div class="col-md-6 transparent-bg">
                    <div class="intro-text text-center">
                        <h4>@lang('Would you like a project based on this plan?')</h4>
                        <p class="text-center h5" style="line-height: 25px;">
                            @lang('Please fill out the form below.')
                            <br>
                            @lang('Our team will review your project and respond according to your needs.')
                        </p>
                    </div>
                    @livewire('front.store-quote', ['quotable' => $plan])
                </div>

            </div>

        </div>
    </section>


    @include('includes.front.action-about')

@endsection

@push('js')
    {{-- <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script> --}}

    <script>
        $(document).ready(function(){
            $('.list3').owlCarousel({
                loop:true,
                margin:20,
                nav:true,
                dots:true,
                responsive:{
                    0:{ items:1 },
                    600:{ items:2 },
                    1000:{ items:3 }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            GLightbox({ selector: '.glightbox' });
        });
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script> --}}
@endpush
