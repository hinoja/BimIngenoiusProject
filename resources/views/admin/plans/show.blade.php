@extends('layouts.back')

@section('subtitle', __('Plan Details'))

@section('content')
    <div class="section-body py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-9">
                    <div class="card shadow-lg modern-card">
                        <!-- En-tête -->
                        <div class="card-header elegant-header">
                            <h3 class="mb-0">{{ $plan->fr_title ?? ($plan->title ?? __('No Title')) }}</h3>
                        </div>

                        <div class="card-body px-4 py-5">
                            <!-- Section 1 : Image 2D -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('2D Plan Image')</h4>
                                @if ($plan->image2D)
                                    <div class="image-wrapper ">
                                        <img  class="d-block gallery-image" src="{{ asset('storage/' . $plan->image2D) }}"
                                            alt="{{ $plan->title ?? 'News Image' }}">
                                        <div class="image-overlay">
                                            <div class="overlay-content">
                                                <h5>{{ $plan->title ?? __('News Image') }}</h5>
                                                <p>@lang('Featured Image')</p>
                                            </div>
                                        </div>
                                        <!-- Fullscreen Toggle -->
                                        <button class="fullscreen-toggle" aria-label="Toggle fullscreen">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3" />
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    <p class="text-muted">@lang('No 2D image available')</p>
                                @endif
                            </section>

                            <!-- Section 2 : Carrousel des images 3D -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('3D Plan Gallery')</h4>
                                @if ($plan->images && !empty(json_decode($plan->images)))
                                    <div class="modern-carousel-container">
                                        <div id="planCarousel" class="carousel slide modern-carousel" data-ride="carousel"
                                            data-interval="5000">
                                            <!-- Indicateurs modernes -->
                                            <div class="carousel-indicators-container">
                                                <ol class="carousel-indicators">
                                                    @foreach (json_decode($plan->images) as $index => $image)
                                                        <li data-target="#planCarousel" data-slide-to="{{ $index }}"
                                                            class="{{ $index === 0 ? 'active' : '' }}">
                                                            <span class="indicator-progress"></span>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>

                                            <!-- Contenu du carrousel -->
                                            <div class="carousel-inner">
                                                @foreach (json_decode($plan->images) as $index => $image)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <div class="image-container">
                                                            <img class="d-block gallery-image"
                                                                src="{{ asset('storage/' . $image->name) }}"
                                                                alt="{{ $plan->title . '3D' . $loop->iteration }}">

                                                            <div class="image-overlay">
                                                                <div class="overlay-content">
                                                                    <h5>{{ $plan->fr_title ?? ($plan->title ?? __('Plan Image')) }}
                                                                    </h5>
                                                                    <p>Image {{ $index + 1 }} of
                                                                        {{ count(json_decode($plan->images)) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Contrôles améliorés -->
                                            <a class="carousel-control-prev" href="#planCarousel" role="button"
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
                                            <a class="carousel-control-next" href="#planCarousel" role="button"
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
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">@lang('No 3D images available')</p>
                                @endif
                            </section>

                            <!-- Section 3 : Informations principales -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Key Information')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Title'):</strong>
                                            {{ $plan->title ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Slug'):</strong>
                                            {{ $plan->slug ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Author'):</strong>
                                            {{ $plan->user?->name ?? 'N/A' }}</div>
                                        <div class="detail-item"><strong>@lang('Status'):</strong>
                                            <span class="badge {{ $plan->published_at ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $plan->published_at ? __('Published') : __('Unpublished') }}
                                            </span>
                                        </div>
                                        <div class="detail-item"><strong>@lang('Published At'):</strong>
                                            {{ $plan->published_at ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>

                            <!-- Section 4 : Descriptions -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Descriptions')</h4>
                                <div class="row">
                                    <div class="col-md-12 detail-group">
                                        <div class="detail-item"><strong>@lang('Description'):</strong>
                                            {!! $plan->description ?? 'N/A' !!}</div>
                                    </div>

                                </div>
                            </section>

                            <!-- Section 5 : Dates -->
                            <section class="mb-5">
                                <h4 class="section-title">@lang('Dates')</h4>
                                <div class="row">
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Created At'):</strong>
                                            {{ $plan->created_at ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6 detail-group">
                                        <div class="detail-item"><strong>@lang('Updated At'):</strong>
                                            {{ $plan->updated_at ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="card-footer text-right elegant-footer">
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-cancel">@lang('Back')</a>
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
        // Toggle fullscreen mode for the image
        document.querySelectorAll('.fullscreen-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const imageWrapper = this.closest('.image-wrapper');
                imageWrapper.classList.toggle('fullscreen');

                const icon = this.querySelector('svg');
                if (imageWrapper.classList.contains('fullscreen')) {
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
        $('#planCarousel').on('slide.bs.carousel', function() {
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
        $('#planCarousel').hover(
            function() {
                const activeIndicator = this.querySelector('.carousel-indicators .active .indicator-progress');
                if (activeIndicator) activeIndicator.style.animationPlayState = 'paused';
            },
            function() {
                const activeIndicator = this.querySelector('.carousel-indicators .active .indicator-progress');
                if (activeIndicator) activeIndicator.style.animationPlayState = 'running';
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
            width: 50%;
            height: 50%;
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

        .modern-card {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .elegant-header {
            background: linear-gradient(135deg, #2A2E45 0%, #3A3F5A 100%);
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
            padding: 1.5rem 2rem;
            border-radius: 15px 15px 0 0;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2A2E45;
            border-bottom: 2px solid #FF6B35;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-group {
            padding: 0 1rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            font-size: 1rem;
            color: #2A2E45;
        }

        .detail-item strong {
            color: #FF6B35;
            margin-right: 0.5rem;
        }

        .elegant-footer {
            background: #f8f9fa;
            border-top: 2px solid #FF6B35;
            padding: 1rem 2rem;
            border-radius: 0 0 15px 15px;
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #2A2E45;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #c0c0c0;
            color: #2A2E45;
            text-decoration: none;
        }

        /* Responsive adjustments */


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

            .section-title {
                font-size: 1.1rem;
            }

            .detail-item {
                font-size: 0.9rem;
            }
        }

        .image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
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

        .image-wrapper:hover .gallery-image {
            transform: scale(1.05);
        }

        /* Image overlay */
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

        .image-wrapper:hover .image-overlay {
            opacity: 1;
        }

        .overlay-content {
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease 0.2s;
        }

        .image-wrapper:hover .overlay-content {
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

        /* Fullscreen button */
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
            opacity: 0;
            transition: all 0.3s ease;
        }

        .image-wrapper:hover .fullscreen-toggle {
            opacity: 1;
        }

        .fullscreen-toggle:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Fullscreen mode */
        .image-wrapper.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            border-radius: 0;
            padding-top: 0;
        }
    </style>
@endpush
