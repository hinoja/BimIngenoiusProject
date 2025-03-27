@extends('layouts.back')

@section('subtitle', __('Project Details'))

@section('content')
    <div class="section-body py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-9">
                    <div class="card shadow-lg modern-card">
                        <!-- En-tête avec titre principal -->
                        <div class="card-header elegant-header">
                            <h3 class="mb-0">{{ $project->title ?? __('No Title') }}</h3>
                            <span class="header-subtitle">{{ $project->company ?? 'N/A' }}</span>
                            <div class="category-badge">{{ $project->category ? $project->category->name : 'N/A' }}</div>
                        </div>

                        <div class="card-body px-4 py-5">
                            <!-- Section 1 : Carrousel des images -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Project Gallery')</h4>
                                @if ($project->images && $project->images->isNotEmpty())
                                    <div id="projectCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($project->images as $index => $image)
                                                <li data-target="#projectCarousel" data-slide-to="{{ $index }}"
                                                    class="{{ $index === 0 ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($project->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="image-container">
                                                        <img style="align-content: center" class="d-block gallery-image" width="500px" height="300px"
                                                            src="{{ asset('storage/' . $image->name) }}"
                                                            alt="{{ $image->name ?? 'Project Image ' . ($index + 1) }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Contrôles du carrousel -->
                                        <a class="carousel-control-prev" href="#projectCarousel" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#projectCarousel" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                @else
                                    <p class="text-muted">@lang('No images associated with this project')</p>
                                @endif
                            </section>

                            <!-- Autres sections (inchangées) -->
                            <!-- Section 2 : Informations principales -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Key Information')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-info-circle mr-2"></i>@lang('Status')</span>
                                            <span class="detail-value">{{ $project->status ? __($project->status->value) : 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-calendar-day mr-2"></i>@lang('Start Date')</span>
                                            <span class="detail-value">{{ $project->formatted_start_date ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-calendar-check mr-2"></i>@lang('End Date')</span>
                                            <span class="detail-value">{{ $project->formatted_end_date ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-clock mr-2"></i>@lang('Duration')</span>
                                            <span class="detail-value">{{ $project->duration ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-ruler-combined mr-2"></i>@lang('Size')</span>
                                            <span class="detail-value">{{ $project->size ? __($project->size->value) : 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-folder-open mr-2"></i>@lang('Category')</span>
                                            <span class="detail-value">{{ $project->category ? $project->category->name : 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 3 : Descriptions -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Descriptions')</h4>
                                <div class="description-tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#fr-desc">@lang('French')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#en-desc">@lang('English')</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="fr-desc" class="tab-pane fade show active">
                                            <p class="description-text">{{ $project->fr_description ?? 'N/A' }}</p>
                                        </div>
                                        <div id="en-desc" class="tab-pane fade">
                                            <p class="description-text">{{ $project->en_description ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 4 : Localisation -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Location')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-globe mr-2"></i>@lang('Country')</span>
                                            <span class="detail-value">{{ $project->country ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-city mr-2"></i>@lang('City')</span>
                                            <span class="detail-value">{{ $project->city ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-map-marker-alt mr-2"></i>@lang('Address')</span>
                                            <span class="detail-value">{{ $project->address ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 5 : Tags -->
                            <section>
                                <h4 class="section-title">@lang('Tags')</h4>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-tags mr-2"></i>@lang('Associated Tags')</span>
                                    <span class="detail-value">
                                        @if ($project->tags->isNotEmpty())
                                            <div class="tags-list">
                                                @foreach ($project->tags as $tag)
                                                    <span class="tag-badge">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </section>
                        </div>

                        <div class="card-footer text-right elegant-footer">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-cancel">@lang('Back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* Style du carrousel principal */
        .carousel {
            max-width: 500px; /* Largeur maximale du carrousel */
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Conteneur des images avec taille fixe */
        .image-container {
            width: 100%;
            height: 300px; /* Hauteur fixe choisie pour toutes les images */
            overflow: hidden;
            position: relative;
        }

        /* Style des images dans le carrousel */
        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Remplit le conteneur sans déformation */
            object-position: center; /* Centre l'image */
        }

        /* Contrôles du carrousel */
        .carousel-control-prev,
        .carousel-control-next {
            width: 8%;
            background: rgba(0, 0, 0, 0.2);
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.4);
            width: 10%;
        }

        /* Indicateurs modernes */
        .carousel-indicators {
            position: static;
            margin: 15px 0;
        }

        .carousel-indicators li {
            width: 30px;
            height: 4px;
            border-radius: 2px;
            background-color: rgba(108, 117, 125, 0.4);
            transition: width 0.3s ease;
        }

        .carousel-indicators .active {
            background-color: #FF6B35;
            width: 40px;
        }

        /* Responsive : ajustement pour petits écrans */
        @media (max-width: 768px) {
            .carousel {
                max-width: 100%;
                border-radius: 8px;
            }

            .image-container {
                height: 200px; /* Hauteur réduite pour petits écrans */
            }
        }
    </style>
@endsection
