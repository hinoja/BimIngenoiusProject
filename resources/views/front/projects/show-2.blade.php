@extends('layouts.front')

@section('subtitle', $project->title)

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/front/customs/css/project-details.css') }}">
@endpush

@section('content')

    @section('previousUrl', route('front.projects.index'))
    @section('previousTitle', __('Projects'))

    <section class="single-project detailsv2">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif					
            <div class="row">

                <div class="col-md-6">
                    <div class="project-info">
                        <h4>@lang('PROJECT INFO')</h4>
                        <p><strong>@lang('Category:')</strong> {{ $project->category?->name }}</p>
                        <p><strong>@lang('Address:')</strong> {{ $project->country }}, {{ $project->city }}</p>
                        <p><strong>@lang('Size:')</strong> {{ $project->size->label() }}</p>
                        <p><strong>@lang('Duration:')</strong> {{ $project->duration }}</p>
                        <p><strong>@lang('Status:')</strong> {{ $project->status->label() }}</p>
                        <p>
                            <strong>@lang('Tags:')</strong> 
                            {{ $project->tags->pluck('name')->implode(', ') }}
                        </p>
                        @if ($project->plan)
                            <p><strong>@lang('View the plan associated with this project:')</strong> 
                                <i>
                                    <a href="{{ route('front.plans.show', $project->plan) }}" style="color: #b3b158; font-weight: bold;">
                                        {{ $project->plan->title }}
                                    </a>
                                </i>
                            </p>
                        @endif
                    </div>

                    <div class="" style="margin-top: 20px;">
                        <p style="color: black; font-weight: bold;">@lang('If you are interested in this project, click on the button below to submit your own.')</p>
                        <div>
                            <button type="button" id="openQuoteModal" class="ot-btn btn-color">
                                @lang('Request a quote')
                            </button>
                        </div>
                    </div>
                
                    <div class="project-des">
                        <h4>@lang('PROJECT DESCRIPTION')</h4>
                        <p class="text-justify">{!! $project->description !!}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="images-right position-relative">
                        <a href="{{ $project->image }}" class="glightbox d-block" style="position:relative;">
                            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="project-main-image">
                            <button type="button"
                                class="btn btn-zoom"
                                style="position:absolute;bottom:-150px;right:10px;background:rgba(0, 0, 0, 0.247);color:#fff;border:none;border-radius:50%;padding:10px 12px;cursor:pointer;">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </a>
                        @if ($project->images->count() > 1)
                            <div class="s-images">
                                @foreach ($project->images->slice(1) as $image)
                                    <a class="item-image glightbox" href="{{ $image->path }}" data-zoomable="true">
                                        <img src="{{ $image->path }}" alt="{{ $project->title . ' ' . $loop->iteration }}">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div id="quoteModal" class="custom-modal">
            <div class="custom-modal-content">
                <span class="custom-modal-close" id="closeQuoteModal">&times;</span>
                <h4>@lang('Request a quote for project:') {{ $project->title }}</h4>
                <hr>
                @livewire('front.store-quote', ['quotable' => $project])
                <div style="margin-bottom: -30px; color: white;">No content</div>
            </div>
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
    {{-- <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/front/customs/js/project-details.js') }}"></script>
@endpush