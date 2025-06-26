@extends('layouts.front')

@section('subtitle', __('Our Domains'))

@push('css')
    <style>
        .category-box .image-category img {
            width: 100%;
            max-width: 220px;
            height: 120px;
            object-fit: cover;
            border-radius: 2px;
            display: block;
            margin: 0 auto;
            background: #f6f6f6;
        }
        @media (max-width: 767px) {
            .category-box .image-category img {
                max-width: 100%;
                height: 120px;
            }
        }
    </style>
@endpush

@section('content')

    @if ($categories->isEmpty())
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-secondary text-center" role="alert">
                        <b class="h5">@lang('No domain uploaded yet.')</b>
                    </div>
                </div>
            </div>
        </div>
    @else
        <section class="list-projects">
            <div class="container">
                <div class="row">
                    {{-- <div id="gallery" class="all-project"> --}}
                        @foreach ($categories as $category)
                            <div class="col-md-3 col-sm-6 item {{ $category->slug }}" style="margin-bottom: 50px;">
                                <div class="category-box">
                                    <a href="{{ route('front.categories.show', $category) }}" class="image-category">
                                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                                        <span class="overlay"></span>
                                    </a>
                                    <h4 class="text-center"><a href="{{ route('front.categories.show', $category->slug) }}">{{ $category->name }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    {{-- </div> --}}
                </div>
            </div>

            <div class="text-center">
                <ul class="pagination">
                    {{ $categories->links('pagination::bootstrap-4') }}
                </ul>
            </div>
        </section>
    @endif

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.isotope.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projectlist.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog.js') }}"></script>
@endpush
