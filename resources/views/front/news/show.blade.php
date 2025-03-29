@extends('layouts.front')

@section('subtitle', $news->title)

@php
    $url = urlencode(request()->fullUrl());
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
                            <p class="text-justify" style="line-height: 30px;">{{ $news->content }}</p>
                        </div>
                        <div class="post-footer">
                            <div class="tag-post">
                                <span>@lang('Tags:')</span> {{ $tags }}
                            </div>
                            <div class="share-post">
                                <span>@lang('Share:')</span> 
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" rel="noopener noreferrer">Facebook</a>,
                                <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ urlencode($news->title) }}" target="_blank" rel="noopener noreferrer">Twitter</a>,
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&title={{ urlencode($news->title) }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>,
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' ' . request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                            </div>
                        </div>
                    </article>

                    {{-- <div class="comments-area">

                        <div class="comment-respond">
                            <h4 class="comment-reply-title">Leave a reply</h4>				
                            <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                                <p class="comment-notes">You must be logged in to post a comment.</p>
                                <div class="row-comment">										
                                    <p class="col-6 comment-form-author"><input id="author" name="author" type="text" value="" placeholder="Your Name"></p>
                                    <p class="col-6 comment-form-email"><input id="email" name="email" type="email" value="" placeholder="Your Email"></p>
                                </div>
                                <p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Your Comment"></textarea></p>
                                <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit ot-btn btn-color" value="Comment"></p>				
                            </form>
                        </div>

                    </div>

                    <div class="list-comments">
                        <h4>3 comments</h4>
                        <ul class="commentlist">
                            <li>
                                <div class="user-image"><img src="images/avatar.png" alt=""></div>
                                <div class="comment-right">
                                    <p>Nunc risus ex, tempus quis purus ac, tempor consequat ex. Vivamus sem magna, maximus at est id, maximus aliquet nunc. Suspendisse lacinia velit a eros porttitor, in interdum ante faucibus.</p>
                                    <div class="comment-info">
                                        Angela Allen - Feb 25, 2016 <a class="c-reply" href="#"><i class="fa fa-share"></i> reply</a>
                                    </div>
                                </div>
                            </li>
                            <ul class="children">
                                <li>
                                    <div class="user-image"><img src="images/avatar2.png" alt=""></div>
                                    <div class="comment-right">
                                        <p>Nullam ipsum urna, dapibus sed justo sed, imperdiet malesuada commodo, eros eleifend laoreet fringilla.</p>
                                        <div class="comment-info">
                                            Timothy Guzman - Feb 25, 2016 <a class="c-reply" href="#"><i class="fa fa-share"></i> reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <li>
                                <div class="user-image"><img src="images/avatar3.png" alt=""></div>
                                <div class="comment-right">
                                    <p>Donec sollicitudin nisi sed eros elementum, non vestibulum quam convallis. Curabitur bibendum magna at nisl hendrerit, et tempus metus facilisis. Praesent augue tellus, euismod id posuere eget, gravida id dolor.</p>
                                    <div class="comment-info">
                                        Julia Garza - Feb 25, 2016 <a class="c-reply" href="#"><i class="fa fa-share"></i> reply</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}

                </div>
            </div>

            {{-- <div class="col-md-3">
                <div class="sidebar">
                    <aside class="widget">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">Business Market</a></li>
                            <li><a href="#">Socials Network</a></li>
                            <li><a href="#">Team Work</a></li>
                            <li><a href="#">Rebuild Services</a></li>
                            <li><a href="#">Electrical System</a></li>
                        </ul>
                    </aside>
                    <aside class="widget widget-image">
                        <a href="#"><img width="280px" src="images/banner.jpg" alt=""></a>
                    </aside>
                    <aside class="widget widget_archive">
                        <h4>Archive</h4>
                        <ul>
                            <li><a href="#">Febuary 2016</a> <span>(9)</span></li>
                            <li><a href="#">January 2016</a> <span>(29)</span></li>
                            <li><a href="#">December 2015</a> <span>(35)</span></li>
                            <li><a href="#">November 2015</a> <span>(22)</span></li>
                            <li><a href="#">Octorber 2015</a> <span>(16)</span></li>
                            <li><a href="#">September 2015</a> <span>(19)</span></li>
                            <li><a href="#">August 2015</a> <span>(25)</span></li>
                        </ul>
                    </aside>
                </div>
            </div> --}}

        </div>
    </div>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog-post.js') }}"></script>
@endpush