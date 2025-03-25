@extends('layouts.front')

@section('subtitle', $plan->title)

@section('content')

    @section('previousUrl', route('front.projects.index'))
    @section('previousTitle', __('Projects'))

    <section class="single-project">
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <div class="project-slider owl-carousel">
                        @forelse ($plan->images as $image)
                            <div><img src="{{ $image->path }}" alt="{{ $plan->title . ' ' . $loop->iteration }}"></div>
                        @empty
                            <div><img src="{{ $plan->image }}" alt="{{ $plan->title }}"></div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">

                {{-- <div class="col-md-4">
                    <div class="project-info">
                        <h4>@lang('PROJECT INFO')</h4>
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
                </div> --}}

                <div class="col-md-12">
                    <div class="project-des">
                        <h4>{{ $plan->title }}</h4>
                        <p class="text-justify">{{ $plan->description }}</p>
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