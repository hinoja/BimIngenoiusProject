@extends('layouts.front')

@section('subtitle', $project->title)

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        .project-main-image {
            /* max-width: 400px;
            max-height: 300px; */
            /* width: 100%; */
            object-fit: cover; 
        }
        .s-images img {
            height: 100px;
            width: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')

    @section('previousUrl', route('front.projects.index'))
    @section('previousTitle', __('Projects'))

    <section class="single-project detailsv2">
        <div class="container">						
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
                    </div>
                
                    <div class="project-des">
                        <h4>{{ $project->title }}</h4>
                        <p class="text-justify">{!! $project->description !!}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="images-right position-relative">
                        <a href="{{ $project->image }}" class="glightbox d-block" style="position:relative;">
                            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="project-main-image">
                            <button type="button"
                                class="btn btn-zoom"
                                style="position:absolute;bottom:-18px;right:15px;background:rgba(0, 0, 0, 0.247);color:#fff;border:none;border-radius:50%;padding:10px 12px;cursor:pointer;">
                                <i class="fas fa-search-plus"></i> {{-- Nécessite FontAwesome --}}
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
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            GLightbox({ selector: '.glightbox' });
        });
    </script>
@endpush