@extends('layouts.front')

@section('subtitle', __('Search Results'))

@php
    $descriptionLength = 320;
@endphp

@push('css')
    <style>
    .search-group-title {
        margin-top: 2.5rem;
        margin-bottom: 1.2rem;
        font-size: 2.25em;
        font-weight: 600;
        color: #b3b158;
        letter-spacing: 0.5px;
    }
    .search-result-item {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        padding: 18px 0 14px 0;
        border-bottom: 1px solid #ececec;
    }
    .search-result-item:last-child {
        border-bottom: none;
    }
    .search-result-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        background: #f6f6f6;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .search-result-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .search-result-link {
        font-size: 1.13em;
        color: #6d6c3c;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
        word-break: break-word;
    }
    .search-result-link:hover {
        color: #b3b158;
        text-decoration: underline;
    }
    .search-result-desc {
        color: #444;
        font-size: 1em;
        margin-bottom: 0;
        word-break: break-word;
    }
    @media (max-width: 600px) {
        .search-group-title { font-size: 1.07em; }
        .search-result-item {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            padding: 12px 0 10px 0;
        }
        .search-result-img {
            width: 100%;
            max-width: 100%;
            height: 160px;
            margin-bottom: 6px;
        }
    }
    </style>
@endpush

@section('content')
    <div class="container" style="margin-bottom: 25px;">
        <h2>@lang('Search results for:') <em>{{ $query }} ({{ $totalResults }})</em></h2>
        <hr>

        @if ($totalResults === 0)
            <p>@lang('No results found for your search query. Please try again with different keywords.')</p>
        @else
            @if ($totalProjects !== 0)
                <h3 class="search-group-title">@lang('Projects') ({{ $totalProjects }})</h3>
                @foreach ($projects as $project)
                    <div class="search-result-item">
                        <img src="{{ $project->image ?? asset('assets/front/images/no-image.png') }}" alt="{{ $project->title }}" class="search-result-img">
                        <div class="search-result-content">
                            <a href="{{ route('front.projects.show', $project) }}" class="search-result-link">
                                {{ $project->title }}
                            </a>
                            <p class="search-result-desc">{{ Str::limit(strip_tags($project->description), $descriptionLength) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($totalPlans !== 0)
                <h3 class="search-group-title">@lang('Plans') ({{ $totalPlans }})</h3>
                @foreach ($plans as $plan)
                    <div class="search-result-item">
                        <img src="{{ $plan->image ?? asset('assets/front/images/no-image.png') }}" alt="{{ $plan->title }}" class="search-result-img">
                        <div class="search-result-content">
                            <a href="{{ route('front.plans.show', $plan) }}" class="search-result-link">
                                {{ $plan->title }}
                            </a>
                            <p class="search-result-desc">{{ Str::limit(strip_tags($plan->description), $descriptionLength) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($totalNews !== 0)
                <h3 class="search-group-title">@lang('News') ({{ $totalNews }})</h3>
                @foreach ($news as $news_item)
                    <div class="search-result-item">
                        <img src="{{ $news_item->image ?? asset('assets/front/images/no-image.png') }}" alt="{{ $news_item->title }}" class="search-result-img">
                        <div class="search-result-content">
                            <a href="{{ route('front.news.show', $news_item) }}" class="search-result-link">
                                {{ $news_item->title }}
                            </a>
                            <p class="search-result-desc">{{ Str::limit(strip_tags($news_item->content), $descriptionLength) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
@endsection