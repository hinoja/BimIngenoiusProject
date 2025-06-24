@extends('layouts.front')

@section('subtitle', $news->title)

@php
    $tags = $news->tags->pluck('name')->implode(', ');
@endphp

@push('css')
    <style>
        .post-thumbail img {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 500px;
            display: block;
        }
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
                            <span>{{ $news->published_at }}</span>
                            @lang('By:') <i>{{ $news->user->name }}</i>
                        </p>
                        <div class="post-thumbail">
                            <img src="{{ $news->image }}" alt="{{ $news->title }}">
                        </div>
                        <div class="post-content">
                            <h4>{{ $news->title }}</h4>
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
@endpush