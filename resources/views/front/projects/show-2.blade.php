@extends('layouts.front')

@section('subtitle', $project->title)

@section('content')

    @section('previousUrl', route('front.projects.index'))
    @section('previousTitle', __('Projects'))

    <section class="single-project detailsv2">
        <div class="container">						
            <div class="row">

                <div class="col-md-6">
                    <div class="project-info">
                        <h4>PROJECT DETAILS</h4>
                        <p><strong>@lang('Category:')</strong> {{ $project->category?->name }}</p>
                        <p><strong>@lang('Company:')</strong> {{ $project->company }}</p>
                        <p><strong>@lang('Address:')</strong> {{ $project->country }}, {{ $project->city }}</p>
                        <p><strong>@lang('Size:')</strong> {{ $project->size->label() }}</p>
                        <p><strong>@lang('Duration:')</strong> {{ $project->duration }}</p>
                        <p><strong>@lang('Status:')</strong> {{ $project->status->label() }}</p>
                        <p>
                            <strong>@lang('Tags:')</strong> 
                            {{ $project->tags->pluck('name')->implode(', ') }}
                        </p>
                    </div>
                
                    <div class="project-des">
                        <h4>{{ $project->title }}</h4>
                        <p class="text-justify">{{ $project->description }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="images-right">
                        <img src="{{ $project->images->first()->path ?? $project->image }}" alt="{{ $project->title }}">
                        <div class="s-images">
                            @foreach ($project->images as $image)
                                <a class="item-image" href="{{ $image->path ?? $project->image }}">
                                    <img src="{{ $image->path ?? $project->image }}" alt="{{ $project->title }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projects.js') }}"></script>  
@endpush