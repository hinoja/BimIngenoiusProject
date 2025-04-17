@extends('layouts.front')

@section('subtitle', $project->title)

@push('css')
    <style>
        .project-slider {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .project-slider img {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 500px;
        }

        .project-slider .owl-carousel {
            height: 500px;
            overflow: hidden;
        }

        .project-info p {
            margin-bottom: 0.75rem;
        }

        .project-info .plan-link {
            color: #007bff;
            font-weight: 500;
            transition: color 0.2s;
        }

        .project-info .plan-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .project-info .no-plan {
            color: #6c757d;
            font-style: italic;
        }
    </style>
@endpush

@section('content')

@section('previousUrl', route('front.projects.index'))
@section('previousTitle', __('Projects'))

<section class="single-project">
    <div class="container">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">
                <div class="project-slider owl-carousel">
                    @forelse ($project->images as $image)
                        <div><img src="{{ asset('storage/' . $image->name) }}"
                                alt="{{ $project->title . ' ' . $loop->iteration }}"></div>
                    @empty
                        <div><img src="{{ $project->image }}" alt="{{ $project->title }}"></div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="project-info">
                    <h4>@lang('PROJECT INFO')</h4>
                    <p><strong>@lang('Category:')</strong> {{ $project->category?->name ?? __('N/A') }}</p>
                    <p><strong>@lang('Company:')</strong> {{ $project->company ?? __('N/A') }}</p>
                    <p><strong>@lang('Address:')</strong> {{ $project->country }}, {{ $project->city }}</p>
                    <p><strong>@lang('Size:')</strong> {{ $project->size->label() }}</p>
                    <p><strong>@lang('Duration:')</strong> {{ $project->duration ?? __('N/A') }}</p>
                    <p><strong>@lang('Status:')</strong> {{ $project->status->label() }}</p>
                    <p>
                        <strong>@lang('Tags:')</strong>
                        {{ $project->tags->pluck('name')->implode(', ') ?: __('None') }}
                    </p>
                    <p>
                        <strong>@lang('Plan:')</strong>
                        @if ($project->plan)
                            <a href="{{ route('front.plans.show', $project->plan) }}" class="plan-link">
                                @lang('Discover the plan that gives life to this project')
                            </a>
                        @else
                            <span class="no-plan">@lang('No plan associated')</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-8">
                <div class="project-des">
                    <h4>{{ $project->title }}</h4>
                    <p class="text-justify">{{ $project->description }}</p>
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
