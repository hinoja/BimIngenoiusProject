@extends('layouts.back')

@section('subtitle', __('Project Details'))

@section('content')
    <div class="section-body py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-9">
                    <div class="card shadow-lg modern-card">
                        <!-- En-tête -->
                        <div class="card-header elegant-header">
                            <h3 class="mb-0">{{ $project->title ?? __('No Title') }}</h3>
                        </div>

                        <div class="card-body px-4 py-5">
                            <!-- Section 1 : Carrousel amélioré -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Project Gallery')</h4>
                                @if ($project->images && $project->images->isNotEmpty())
                                    <div class="modern-carousel-container">
                                        <div id="projectCarousel" class="carousel slide modern-carousel"
                                            data-ride="carousel" data-interval="5000">
                                            <!-- Indicateurs modernes -->
                                            <div class="carousel-indicators-container">
                                                <ol class="carousel-indicators">
                                                    @foreach ($project->images as $index => $image)
                                                        <li data-target="#projectCarousel"
                                                            data-slide-to="{{ $index }}"
                                                            class="{{ $index === 0 ? 'active' : '' }}">
                                                            <span class="indicator-progress"></span>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>

                                            <!-- Contenu du carrousel -->
                                            <div class="carousel-inner">
                                                @foreach ($project->images as $index => $image)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <div class="image-container">
                                                            <img class="d-block gallery-image"
                                                                src="{{ asset('storage/' . $image->name) }}"
                                                                alt="{{ $image->name ?? 'Project Image ' . ($index + 1) }}">
                                                            <div class="image-overlay">
                                                                <div class="overlay-content">
                                                                    <h5>{{ $project->title ?? __('Project Image') }}</h5>
                                                                    <p>Image {{ $index + 1 }} of
                                                                        {{ count($project->images) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Contrôles améliorés -->
                                            <a class="carousel-control-prev" href="#projectCarousel" role="button"
                                                data-slide="prev">
                                                <div class="control-inner">
                                                    <span class="carousel-control-icon" aria-hidden="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M15 18l-6-6 6-6" />
                                                        </svg>
                                                    </span>
                                                    <span class="sr-only">Previous</span>
                                                </div>
                                            </a>
                                            <a class="carousel-control-next" href="#projectCarousel" role="button"
                                                data-slide="next">
                                                <div class="control-inner">
                                                    <span class="carousel-control-icon" aria-hidden="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M9 18l6-6-6-6" />
                                                        </svg>
                                                    </span>
                                                    <span class="sr-only">Next</span>
                                                </div>
                                            </a>

                                            <!-- Bouton plein écran -->
                                            <button class="fullscreen-toggle" aria-label="Toggle fullscreen">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">@lang('No images associated with this project')</p>
                                @endif
                            </section>

                            <!-- Section 2 : Informations principales -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Key Information')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <span class="header-subtitle"><strong>@lang('Company'):</strong>
                                            {{ $project->company ?? 'N/A' }}</span>
                                        <div class="detail-item"><strong>@lang('Status'):</strong>
                                            {{ $project->status ? __($project->status->value) : 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Start Date'):</strong>
                                            {{ $project->formatted_start_date ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('End Date'):</strong>
                                            {{ $project->formatted_end_date ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Duration'):</strong>
                                            {{ $project->duration ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Size'):</strong>
                                            {{ $project->size ? __($project->size->value) : 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Category'):</strong>
                                            {{ $project->category?->name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 3 : Description -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Description')</h4>
                                <p class="description-text">{!!  $project->description ?? 'N/A' !!}</p>
                            </section>

                            <!-- Section 4 : Localisation -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Location')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Country'):</strong>
                                            {{ $project->country ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('City'):</strong>
                                            {{ $project->city ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Address'):</strong>
                                            {{ $project->address ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 5 : Tags -->
                            <section>
                                <h4 class="section-title">@lang('Tags')</h4>
                                @if ($project->tags->isNotEmpty())
                                    <div class="tags-list">
                                        @foreach ($project->tags as $tag)
                                            <span class="tag-badge">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p>N/A</p>
                                @endif
                            </section>
                        </div>

                        <div class="card-footer text-right elegant-footer">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-cancel">@lang('Back')</a>
                            {{-- <a href="{{ route('admin.projects.edit',) }}" class="btn btn-cancel">@lang('Back')</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // Activer le mode plein écran
        document.querySelectorAll('.fullscreen-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const carousel = this.closest('.modern-carousel');
                carousel.classList.toggle('fullscreen');

                // Changer l'icône
                const icon = this.querySelector('svg');
                if (carousel.classList.contains('fullscreen')) {
                    icon.innerHTML =
                        '<path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"/>';
                    document.body.style.overflow = 'hidden';
                } else {
                    icon.innerHTML =
                        '<path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>';
                    document.body.style.overflow = '';
                }
            });
        });

        // Réinitialiser l'animation de la barre de progression lors du changement de slide
        $('#projectCarousel').on('slide.bs.carousel', function() {
            const activeIndicator = this.querySelector('.carousel-indicators .active');
            if (activeIndicator) {
                const progressBar = activeIndicator.querySelector('.indicator-progress');
                if (progressBar) {
                    progressBar.style.animation = 'none';
                    void progressBar.offsetWidth; // Déclencher un reflow
                    progressBar.style.animation = 'progressBar 5s linear forwards';
                }
            }
        });

        // Pause l'animation au survol
        $('#projectCarousel').hover(
            function() {
                const activeIndicator = this.querySelector('.carousel-indicators .active .indicator-progress');
                if (activeIndicator) {
                    activeIndicator.style.animationPlayState = 'paused';
                }
            },
            function() {
                const activeIndicator = this.querySelector('.carousel-indicators .active .indicator-progress');
                if (activeIndicator) {
                    activeIndicator.style.animationPlayState = 'running';
                }
            }
        );
    </script>
@endpush
@push('css')
    <style>
        /* Styles pour le carrousel moderne */
        .modern-carousel-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .modern-carousel-container:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .modern-carousel {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Conteneur d'image avec ratio 16:9 */
        .image-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
            background: #f5f5f5;
        }

        .gallery-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.5s ease;
        }

        .carousel-item.active .gallery-image {
            transform: scale(1);
        }

        .carousel-item:not(.active) .gallery-image {
            transform: scale(1.05);
        }

        /* Overlay d'image */
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .carousel-item.active .image-overlay {
            opacity: 1;
        }

        .overlay-content {
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease 0.2s;
        }

        .carousel-item.active .overlay-content {
            transform: translateY(0);
        }

        .overlay-content h5 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .overlay-content p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 0;
        }

        /* Indicateurs modernes */
        .carousel-indicators-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 15;
            padding: 0 1rem 1rem;
            display: flex;
            justify-content: center;
        }

        .carousel-indicators {
            position: static;
            margin: 0;
            display: flex;
            gap: 8px;
        }

        .carousel-indicators li {
            width: 40px;
            height: 4px;
            border-radius: 2px;
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            margin: 0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .carousel-indicators li.active {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .carousel-indicators li.active .indicator-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background-color: #FF6B35;
            animation: progressBar 5s linear forwards;
        }

        @keyframes progressBar {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }

        /* Contrôles améliorés */
        .carousel-control-prev,
        .carousel-control-next {
            width: 60px;
            height: 60px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 20;
        }

        .modern-carousel:hover .carousel-control-prev,
        .modern-carousel:hover .carousel-control-next {
            opacity: 1;
        }

        .control-inner {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .carousel-control-prev .control-inner {
            margin-right: auto;
            margin-left: 20px;
        }

        .carousel-control-next .control-inner {
            margin-left: auto;
            margin-right: 20px;
        }

        .control-inner:hover {
            background: rgba(0, 0, 0, 0.6);
            transform: scale(1.1);
        }

        .carousel-control-icon {
            color: white;
            width: 24px;
            height: 24px;
        }

        /* Bouton plein écran */
        .fullscreen-toggle {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modern-carousel:hover .fullscreen-toggle {
            opacity: 1;
        }

        .fullscreen-toggle:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Animation entre les slides */
        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }

        .carousel-item-next.carousel-item-left,
        .carousel-item-prev.carousel-item-right {
            transform: translateX(0);
        }

        .carousel-item-next,
        .active.carousel-item-right {
            transform: translateX(100%);
        }

        .carousel-item-prev,
        .active.carousel-item-left {
            transform: translateX(-100%);
        }

        /* Mode plein écran */
        .modern-carousel.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            border-radius: 0;
        }

        .modern-carousel.fullscreen .image-container {
            height: 100%;
            padding-top: 0;
        }

        .modern-carousel.fullscreen .gallery-image {
            object-fit: contain;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .modern-carousel-container {
                max-width: 100%;
                border-radius: 8px;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 40px;
                height: 40px;
                opacity: 1;
            }

            .carousel-control-prev .control-inner {
                margin-left: 10px;
            }

            .carousel-control-next .control-inner {
                margin-right: 10px;
            }

            .overlay-content h5 {
                font-size: 1.2rem;
            }

            .fullscreen-toggle {
                opacity: 1;
                width: 36px;
                height: 36px;
            }
        }
    </style>
@endpush
