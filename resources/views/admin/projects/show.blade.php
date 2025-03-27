@extends('layouts.back')

@section('subtitle', __('Project Details'))

@section('content')
<div class="section-body py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card shadow-lg modern-card">
                    <!-- En-tête avec titre principal -->
                    <div class="card-header elegant-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1">{{ $project->title }}</h3>
                                <div class="d-flex align-items-center mt-2">
                                    <i class="fas fa-building mr-2"></i>
                                    <span class="header-subtitle">{{ $project->company }}</span>
                                </div>
                            </div>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left mr-2"></i> @lang('Back')
                            </a>
                        </div>
                    </div>

                    <div class="card-body px-4 py-5">
                        <!-- Carrousel amélioré -->
                        <section class="mb-5">
                            @if($project->images->isNotEmpty())
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    @foreach($project->images as $image)
                                    <div class="swiper-slide">
                                        <div class="image-container">
                                            <img src="{{ asset('storage/'.$image->name) }}"
                                                 class="gallery-image"
                                                 data-zoomable
                                                 alt="{{ $project->title }}">
                                            <div class="image-meta">
                                                <i class="fas fa-camera mr-2"></i>
                                                {{ $image->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Navigation -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                            </div>

                            <!-- Carrousel miniatures -->
                            <div class="swiper-container gallery-thumbs mt-3">
                                <div class="swiper-wrapper">
                                    @foreach($project->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/'.$image->name) }}"
                                             class="thumb-image"
                                             alt="Thumbnail">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="empty-gallery">
                                <i class="fas fa-image fa-3x mb-3"></i>
                                <p>@lang('No images available')</p>
                            </div>
                            @endif
                        </section>

                        <!-- Grille d'informations avec icones -->
                        <div class="row info-grid">
                            <!-- Colonne de gauche -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon bg-primary">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>@lang('Timeline')</h5>
                                        <ul class="info-list">
                                            <li>
                                                <i class="fas fa-play-circle mr-2"></i>
                                                <strong>@lang('Start'):</strong>
                                                {{ $project->formatted_start_date }}
                                            </li>
                                            <li>
                                                <i class="fas fa-flag-checkered mr-2"></i>
                                                <strong>@lang('End'):</strong>
                                                {{ $project->formatted_end_date }}
                                            </li>
                                            <li>
                                                <i class="fas fa-hourglass-half mr-2"></i>
                                                <strong>@lang('Duration'):</strong>
                                                {{ $project->duration }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon bg-success">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>@lang('Project Status')</h5>
                                        <div class="status-indicator">
                                            <span class="status-badge {{ $project->status }}">
                                            {{-- <span class="status-badge {{ $project->status->color() }}"> --}}
                                                <i class="{{ $project->status }} mr-2"></i>
                                                {{-- <i class="{{ $project->status->icon() }} mr-2"></i> --}}
                                                {{ __($project->status->value) }}
                                            </span>
                                            <span class="size-badge">
                                                <i class="fas fa-ruler-combined mr-2"></i>
                                                {{ __($project->size->value) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Colonne de droite -->
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon bg-info">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>@lang('Location')</h5>
                                        <div class="location-details">
                                            <div class="map-pin">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                                <div class="address">
                                                    <div>{{ $project->address }}</div>
                                                    <div>{{ $project->city }}, {{ $project->country }}</div>
                                                </div>
                                            </div>
                                            @if($project->coordinates)
                                            <a href="#" class="btn btn-map">
                                                <i class="fas fa-external-link-alt mr-2"></i>
                                                @lang('View on map')
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon bg-warning">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>@lang('Classification')</h5>
                                        <div class="category-tag">
                                            <i class="fas fa-folder-open mr-2"></i>
                                            {{ $project->category->name }}
                                        </div>
                                        @if($project->tags->isNotEmpty())
                                        <div class="tags-cloud mt-3">
                                            @foreach($project->tags as $tag)
                                            <span class="tag">
                                                <i class="fas fa-hashtag mr-1"></i>
                                                {{ $tag->name }}
                                            </span>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Descriptions -->
                        <section class="descriptions-section mt-5">
                            <h4 class="section-title">
                                <i class="fas fa-align-left mr-2"></i>
                                @lang('Descriptions')
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="lang-description">
                                        <div class="lang-header">
                                            <i class="flag-icon flag-fr"></i>
                                            <h6>@lang('French Version')</h6>
                                        </div>
                                        <p>{{ $project->fr_description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="lang-description">
                                        <div class="lang-header">
                                            <i class="flag-icon flag-gb"></i>
                                            <h6>@lang('English Version')</h6>
                                        </div>
                                        <p>{{ $project->en_description }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    /* Carrousel principal */
    .swiper-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .gallery-top {
        height: 600px;
        background: #000;
    }

    .gallery-thumbs {
        height: 100px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .gallery-thumbs .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
        transition: opacity 0.3s;
    }

    .gallery-thumbs .swiper-slide-active {
        opacity: 1;
    }

    .image-container {
        position: relative;
        height: 100%;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-meta {
        position: absolute;
        bottom: 20px;
        left: 20px;
        color: white;
        background: rgba(0,0,0,0.7);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9em;
    }

    /* Cartes d'information */
    .info-grid {
        gap: 1.5rem;
    }

    .info-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 15px rgba(0,0,0,0.06);
        display: flex;
        align-items: start;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: white;
        flex-shrink: 0;
        margin-right: 1.5rem;
    }

    .info-content h5 {
        color: #2A2E45;
        margin-bottom: 1rem;
    }

    .info-list li {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    /* Badges de statut */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 500;
    }

    .status-badge.completed { background: #28a74520; color: #28a745; }
    .status-badge.in_progress { background: #ffc10720; color: #ffc107; }

    /* Tags */
    .tags-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag {
        background: #f8f9fa;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.9em;
    }

    /* Descriptions */
    .lang-description {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        height: 100%;
    }

    .lang-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .flag-icon {
        width: 30px;
        height: 20px;
        border-radius: 3px;
        margin-right: 10px;
    }
</style>
@endsection

@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration du carrousel
    const galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 4,
        zoom: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    const galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        loop: true,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        loopedSlides: 4,
    });

    galleryTop.controller.control = galleryThumbs;
    galleryThumbs.controller.control = galleryTop;

    // Zoom sur clic image
    document.querySelectorAll('[data-zoomable]').forEach(img => {
        img.addEventListener('click', () => {
            if (!img.classList.contains('swiper-zoomed')) {
                galleryTop.zoom.in();
            } else {
                galleryTop.zoom.out();
            }
        });
    });
});
</script>
@endsection
