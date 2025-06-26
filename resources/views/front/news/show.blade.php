@extends('layouts.front')

@section('subtitle', $news->title)

@php
    $tags = $news->tags->pluck('name')->implode(', ');
@endphp

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        .post-thumbail img {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 400px;
            display: block;
        }

        /* Resetting styles from WYSIWIG content */
        /* .post-content ul li {
            display: list-item !important;
            list-style-type: disc !important;
            list-style-position: inside !important;
            margin-bottom: -20px !important;
        }
        .post-content ol li {
            display: list-item !important;
            list-style-type: decimal !important;
            list-style-position: inside !important;
            margin-bottom: -20px !important;
        }
        .post-content ul,
        .post-content ol {
            margin-left: 2em;
            padding-left: 1.5em;
        } */
    </style>
@endpush

@section('content')

    @section('previousUrl', route('front.news.index'))
    @section('previousTitle', __('News'))

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="blog-list blog-single">

                    <article class="post">
                        <h1 class="post-title">{{ $news->title }}</h1>
                        <p class="post-meta">
                            <span>
                                <i class="text-muted">@lang('Published at:')</i> {{ $news->published_at }}
                                @if (($news->created_at != $news->updated_at) && ($news->updated_at >= $news->published_at))
                                    <i class="text-muted">
                                        (@lang('Updated at:') {{ $news->updated_at }})
                                    </i>
                                @endif
                            </span>
                            @lang('By:') <i>{{ $news->user->name }}</i>
                        </p>
                        <div class="post-thumbail postion-relative">
                            <a href="{{ $news->image }}" class="glightbox d-block" style="position:relative;">
                                <img src="{{ $news->image }}" alt="{{ $news->title }}">
                                <button type="button"
                                    class="btn btn-zoom"
                                    style="position:absolute;bottom:5px;right:5px;background:rgba(0, 0, 0, 0.247);color:#fff;border:none;border-radius:50%;padding:10px 12px;cursor:pointer;">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </a>
                        </div>
                        <div class="post-content">
                            <h4>@lang('NEWS DETAILS')</h4>
                            {{-- <p class="text-justify" style="line-height: 30px;">{{ $news->content }}</p> --}}
                            {!! $news->content !!}
                        </div>
                        <div class="post-footer">
                            <div class="tag-post">
                                <span>@lang('Tags:')</span> {{ $tags }}
                            </div>
                            
                            <div class="share-post">
                                @include('includes.front.social-media-share', ['data' => $news])
                            </div>

                        </div>
                    </article>

                </div>
            </div>

        </div>
    </div>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog-post.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            GLightbox({ selector: '.glightbox' });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
@endpush