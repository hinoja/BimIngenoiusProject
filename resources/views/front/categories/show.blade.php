@extends('layouts.front')

@section('subtitle', $category->name)

@push('css')
    <style>
        .project-slider {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .project-slider img {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 500px;
        }

        .project-slider .owl-carousel {
            height: 500px;
            overflow: hidden;
        }

        .project-info p {
            margin-bottom: 0.75rem;
        }

        .project-info .plan-link {
            color: #007bff;
            font-weight: 500;
            transition: color 0.2s;
        }

        .project-info .plan-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .project-info .no-plan {
            color: #6c757d;
            font-style: italic;
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
                        {{-- <p class="post-meta">
                            <span>February 15, 2016</span>
                            <a href="#">Authemes</a>
                            <a href="#">UI/UX Design</a>
                            <span>3 comments</span>
                        </p> --}}
                        <div class="post-thumbail">
                            <img src="{{ $category->image }}" alt="{{ $category->name }}">
                        </div>
                        <div class="post-content">{{ $category->description }}</div>
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
                                <li><a href="{{ route('front.categories.show', $category) }}">{{ $category->name }}</a></li>
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
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script>
@endpush
