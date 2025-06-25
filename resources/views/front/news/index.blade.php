@extends('layouts.front')

@section('subtitle', __('News'))

@push('css')
    <style>
        .item-post img {
            width: 100%;
            max-width: 320px;
            max-height: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }
        @media (max-width: 767px) {
            .item-post img {
                max-width: 100%;
                height: 140px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="blog-list">

                    @if ($news->isEmpty())
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-secondary text-center" role="alert">
                                    <b class="h5">@lang('No news published yet.')</b>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($news as $news_item)
                            <div class="item-post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="{{ $news_item->image }}" alt="{{ $news_item->title }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-7">
                                        <h4><a href="{{ route('front.news.show', $news_item) }}">{{ $news_item->title }}</a></h4>
                                        <p class="date-post">{{ $news_item->published_at }}</p>
                                        <p class="text-justify">{{ str_replace('&nbsp;', ' ', strip_tags($news_item->medium_content)) }}</p>
                                        <p><a href="{{ route('front.news.show', $news_item) }}" class="more-link">@lang('Continue Reading')</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="text-center">
                        <ul class="pagination">				                        
                            {{ $news->links('pagination::bootstrap-4') }}
                        </ul>				                    
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog.js') }}"></script> 
@endpush