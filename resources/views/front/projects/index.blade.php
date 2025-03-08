@extends('layouts.front')

@section('subtitle', __('Projects'))

@section('content')

    @if ($projects->isEmpty())
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        @lang('No project uploaded yet.')
                    </div>
                </div>
            </div>
        </div>
    @else
        <section class="list-projects">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="filter" class="filter-projects none-style">
                            <li><a href="#" class="current" data-filter="*" title="">@lang('All Projects')</a></li>
                            @foreach ($categories as $category)
                                <li><a href="#" data-filter=".{{ $category->slug }}" title="">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>							
                </div>
                <div class="row">
                    <div id="gallery" class="all-project">
                        @foreach ($projects as $project)
                            <div class="col-md-4 col-sm-6 item {{ $project->category->slug }}">
                                <div class="project-box ">
                                    <a href="{{ route('front.projects.show', $project->slug) }}" class="image-project">
                                        <img src="{{ $project->images->first()->name }}" alt="{{ $project->title }}">
                                        <span class="overlay"></span>
                                    </a>
                                    <h4><a href="{{ route('front.projects.show', $project->slug) }}">{{ $project->title }}</a></h4>
                                    <div class="cat-name"><a href="#">{{ $project->category->name }}</a>, <a href="#">{{ $project->tags->first()->name }}</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <ul class="pagination">				                        
                    {{ $projects->links('pagination::bootstrap-4') }}
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