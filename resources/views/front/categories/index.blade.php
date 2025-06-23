@extends('layouts.front')

@section('subtitle', __('Domains'))

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
                    <div id="gallery" class="all-project">
                        @foreach ($categories as $category)
                            <div class="col-md-4 col-sm-6 item {{ $category->slug }}">
                                <div class="category-box ">
                                    <a href="{{ route('front.categories.show', $category) }}" class="image-category">
                                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                                        <span class="overlay"></span>
                                    </a>
                                    <h4><a href="{{ route('front.categories.show', $category->slug) }}">{{ $category->name }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
