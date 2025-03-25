@extends('layouts.front')

@section('subtitle', __('News'))

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
                                    <b class="h5">@lang('No news uploaded yet.')</b>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($news as $news_item)
                            <div class="item-post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="{{ $news_item->image }}" alt="">
                                    </div>
                                    <div class="col-md-7">
                                        <h4><a href="{{ route('front.news.show', $news_item) }}">{{ $news_item->title }}</a></h4>
                                        <p class="date-post">{{ $news_item->published_at }}</p>
                                        <p class="text-justify">{{ $news_item->medium_content }}</p>
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