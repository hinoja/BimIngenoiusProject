@extends('layouts.front')

@section('subtitle', $category->name)

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        .post-thumbail img {
            width: 100%;
            max-width: 350px;
            height: 220px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto 1.5rem auto;
            background: #f6f6f6;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
    </style>
@endpush

@section('content')

@section('previousUrl', route('front.categories.index'))
@section('previousTitle', __('Domains'))

<div class="page-content blog-page">
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="blog-list blog-single">

                    <article class="post">
                        <h1 class="post-title">{{ $category->name }}</h1>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="post-thumbail position-relative">
                                    <a href="{{ $category->image }}" class="glightbox d-block" style="position:relative;">
                                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                                        <button type="button"
                                            class="btn btn-zoom"
                                            style="position:absolute;bottom:5px;right:30px;background:rgba(0, 0, 0, 0.247);color:#fff;border:none;border-radius:50%;padding:10px 12px;cursor:pointer;">
                                            <i class="fas fa-search-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>@lang('Description')</h4>
                                <div class="post-content text-justify">{!! $category->description !!}</div>
                            </div>
                        </div>
                        <div class="post-footer">
                            <div class="tag-post">
                                <span>@lang('Tags:') <i>{{ $category->projects->count() }} @lang('project(s)')</i></span>
                            </div>
                            {{-- <div class="share-post">
                                <span>Share:</span> <a href="#">Facebook</a>, <a href="#">Twitter</a>, <a href="#">Google+</a>
                            </div> --}}
                        </div>
                    </article>

                </div>
            </div>

            <div class="col-md-3">
                <div class="sidebar">
                    <aside class="widget">
                        <h4>@lang('Other categories')</h4>
                        <ul>
                            @foreach ($other_categories as $category)
                                <li><a href="{{ route('front.categories.show', $category) }}">{{ $category->name }}</a></li><br>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.front.action-about')

@endsection

@push('js')
    {{-- <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            GLightbox({ selector: '.glightbox' });
        });
    </script>
@endpush
