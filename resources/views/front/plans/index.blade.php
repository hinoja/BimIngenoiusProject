@extends('layouts.front')

@section('subtitle', __('Plans'))

@section('content')

    @if ($plans->isEmpty())
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-secondary text-center" role="alert">
                        <b class="h5">@lang('No plan uploaded yet.')</b>
                    </div>
                </div>
            </div>
        </div>
    @else
        <section class="list-projects">
            <div class="container">
                {{-- <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <ul id="filter" class="filter-projects none-style">
                            <li><a href="#" class="current" data-filter="*" title="">@lang('All Projects')</a></li>
                            @foreach ($categories as $category)
                                <li><a href="#" data-filter=".{{ $category->slug }}" title="">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
                <div class="row">
                    <div id="gallery" class="all-project">
                        @foreach ($plans as $plan)
                            <div class="col-md-4 col-sm-6 item {{ $plan->slug }}" style="margin-bottom: 20px;">
                                <div class="project-box ">
                                    <a href="{{ route('front.plans.show', $plan) }}" class="image-project">
                                        <img src="{{ $plan->image }}" alt="{{ $plan->title }}">
                                        <span class="overlay"></span>
                                    </a>
                                    <h4><a href="{{ route('front.plans.show', $plan->slug) }}">{{ $plan->title }}</a></h4>
                                    {{-- <div class="cat-name">{{ $project->category->name }}, <i>{{ $project->tags->first()->name }}</i></div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <ul class="pagination">
                    {{ $plans->links('pagination::bootstrap-4') }}
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
