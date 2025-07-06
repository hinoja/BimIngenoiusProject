@extends('layouts.front')

@section('subtitle', __('Our Domains'))
@section('description', __("Explore our diverse domains of expertise. Discover our specialized areas and services organized by category for your convenience."))

    @push('css')
        <style>
            /* Variables CSS pour la cohérence */
            :root {
                --primary-color: #b3b158;
                --secondary-color: #764ba2;
                --accent-color: #b3b158;
                --text-light: #718096;
                --bg-light: #f7fafc;
                --bg-white: #ffffff;
                --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.15);
                --border-radius: 16px;
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Reset et styles de base */
            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                line-height: 1.6;
                color: var(--text-dark);
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
            }

            /* Container principal */
            .categories-container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem 1.5rem;
                position: relative;
                z-index: 1;
            }

            /* Grid des catégories - Layout moderne style Pinterest/Masonry */
            .categories-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
                margin-bottom: 4rem;
                align-items: start;
            }

            /* Carte de catégorie moderne - Style compact et élégant */
            .category-card {
                background: var(--bg-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
                transition: var(--transition), transform 0.4s ease-out;
                position: relative;
                border: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                flex-direction: column;
                animation: fadeInUp 0.6s ease-out forwards;
                height: fit-content;
            }

            .category-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-lg);
            }

            /* Zone image optimisée pour petites images */
            .category-card-image {
                position: relative;
                height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                padding: 1rem;
                overflow: hidden;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .category-card-image img {
                max-width: 64px;
                max-height: 64px;
                object-fit: contain;
                border-radius: 12px;
                transition: var(--transition);
                filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
            }

            .category-card:hover .category-card-image img {
                transform: scale(1.1);
                filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
            }

            /* Icône de fallback moderne */
            .category-card-image::after {
                content: '';
                position: absolute;
                width: 64px;
                height: 64px;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                border-radius: 12px;
                opacity: 0;
                transition: var(--transition);
                z-index: 1;
            }

            .category-card-image.no-image::after {
                opacity: 0.1;
            }

            .category-card-image.no-image::before {
                content: '📁';
                position: absolute;
                font-size: 2rem;
                z-index: 2;
                opacity: 0.6;
            }

            /* Overlay interactif moderne */
            .category-card-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(179, 177, 88, 0.9), rgba(118, 75, 162, 0.9));
                opacity: 0;
                transition: var(--transition);
                display: flex;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(2px);
            }

            .category-card:hover .category-card-overlay {
                opacity: 1;
            }

            .category-card-overlay .btn-overlay {
                background: white;
                color: var(--primary-color);
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.85rem;
                text-decoration: none;
                transition: var(--transition);
                transform: translateY(10px);
            }

            .category-card:hover .category-card-overlay .btn-overlay {
                transform: translateY(0);
            }

            .category-card-overlay .btn-overlay:hover {
                background: var(--primary-color);
                color: white;
            }

            /* Contenu de la carte - Style compact */
            .category-card-content {
                padding: 1.25rem;
                flex: 1;
                display: flex;
                flex-direction: column;
                text-align: center;
                min-height: 100px;
            }

            .category-card-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--text-dark);
                margin: 0 0 0.75rem;
                line-height: 1.3;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .category-card-title a {
                color: inherit;
                text-decoration: none;
                transition: var(--transition);
            }

            .category-card-title a:hover {
                color: var(--primary-color);
            }

            /* Badge de compteur moderne */
            .category-badge {
                position: absolute;
                top: 0.75rem;
                right: 0.75rem;
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 0.25rem 0.5rem;
                border-radius: 12px;
                font-size: 0.75rem;
                font-weight: 600;
                box-shadow: var(--shadow-sm);
                z-index: 3;
            }

            /* Lien d'action moderne */
            .category-card-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: var(--primary-color);
                font-weight: 600;
                font-size: 0.9rem;
                text-decoration: none;
                transition: var(--transition);
                margin-top: auto;
                padding: 0.5rem 1rem;
                border: 2px solid var(--primary-color);
                border-radius: 20px;
                background: transparent;
                justify-content: center;
            }

            .category-card-link:hover {
                background: var(--primary-color);
                color: white;
                text-decoration: none;
                transform: translateY(-2px);
            }

            .category-card-link::after {
                content: '→';
                margin-left: 0.5rem;
                transition: var(--transition);
            }

            .category-card-link:hover::after {
                transform: translateX(4px);
            }

            /* État vide moderne */
            .empty-state {
                text-align: center;
                padding: 4rem 2rem;
                background: var(--bg-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                margin: 2rem 0;
                animation: fadeInUp 0.6s ease-out;
            }

            .empty-state-icon {
                font-size: 4rem;
                color: var(--text-light);
                margin-bottom: 1rem;
                animation: pulse 2s infinite ease-in-out;
            }

            .empty-state-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--text-dark);
                margin-bottom: 0.5rem;
            }

            .empty-state-text {
                color: var(--text-light);
                font-size: 1.1rem;
            }

            /* Pagination moderne */
            .pagination-container {
                display: flex;
                justify-content: center;
                margin: 3rem 0;
            }

            .pagination {
                display: flex;
                gap: 0.5rem;
                align-items: center;
            }

            .pagination .page-item {
                list-style: none;
            }

            .pagination .page-link {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border: 2px solid #e2e8f0;
                border-radius: 50%;
                color: var(--text-dark);
                text-decoration: none;
                font-weight: 500;
                transition: var(--transition);
                background: var(--bg-white);
            }

            .pagination .page-link:hover {
                border-color: var(--primary-color);
                background: var(--primary-color);
                color: white;
            }

            .pagination .page-item.active .page-link {
                background: var(--primary-color);
                border-color: var(--primary-color);
                color: white;
            }

            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            /* Animation décalée pour les cartes */
            .category-card:nth-child(2n) {
                animation-delay: 0.1s;
            }

            .category-card:nth-child(3n) {
                animation-delay: 0.2s;
            }

            .category-card:nth-child(4n) {
                animation-delay: 0.3s;
            }

            /* Skeleton Loading optimisé */
            .category-card-image.loading::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 64px;
                height: 64px;
                margin: -32px 0 0 -32px;
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
                border-radius: 12px;
                z-index: 1;
            }

            @keyframes loading {
                0% {
                    background-position: 200% 0;
                }

                100% {
                    background-position: -200% 0;
                }
            }

            /* Responsive Design optimisé */
            @media (max-width: 1024px) {
                .categories-grid {
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                    gap: 1.25rem;
                }
            }

            @media (max-width: 768px) {
                .categories-grid {
                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                    gap: 1rem;
                }

                .category-card-content {
                    padding: 1rem;
                    min-height: 80px;
                }

                .category-card-title {
                    font-size: 1.1rem;
                }
            }

            @media (max-width: 480px) {
                .categories-container {
                    padding: 1rem;
                }

                .categories-grid {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }

                .category-card-image {
                    height: 80px;
                }

                .category-card-image img {
                    max-width: 48px;
                    max-height: 48px;
                }

                .category-card-title {
                    font-size: 1rem;
                }

                .category-card-link {
                    font-size: 0.85rem;
                    padding: 0.4rem 0.8rem;
                }
            }

            /* Accessibilité */
            @media (prefers-reduced-motion: reduce) {
                * {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }


        </style>
    @endpush

@section('content')
    <div class="categories-container">
        <!-- Contenu principal -->
        <div class="row">
            <div class="col-12">
                @if ($categories->isEmpty())
                    <!-- État vide moderne -->
                    <div class="empty-state">
                        <div class="empty-state-icon">📁</div>
                        <h3 class="empty-state-title">@lang('No domains available yet')</h3>
                        <p class="empty-state-text">@lang('Check back later for new domains and categories')</p>
                    </div>
                @else
                    <!-- Grid des catégories -->
                    <div class="categories-grid">
                        @foreach ($categories as $category)
                            <article class="category-card">
                                @if ($category->products_count ?? 0 > 0)
                                    <span class="category-badge">{{ $category->products_count }}</span>
                                @endif

                                <div class="category-card-image loading">
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy"
                                        onload="this.parentElement.classList.remove('loading')"
                                        onerror="this.style.display='none'; this.parentElement.classList.add('no-image'); this.parentElement.classList.remove('loading');">

                                    <div class="category-card-overlay">
                                        <a href="{{ route('front.categories.show', $category) }}" class="btn-overlay">
                                            @lang('View Category')
                                        </a>
                                    </div>
                                </div>

                                <div class="category-card-content">
                                    <h2 class="category-card-title">
                                        <a href="{{ route('front.categories.show', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </h2>

                                    <a href="{{ route('front.categories.show', $category) }}" class="category-card-link">
                                        @lang('Explore')
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination moderne -->
                    @if ($categories->hasPages())
                        <div class="pagination-container">
                            {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </div>

    @include('includes.front.action-about')
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy loading optimisé des images
            const images = document.querySelectorAll('.category-card-image img');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const imageContainer = img.parentElement;

                        // Précharger l'image
                        const tempImg = new Image();
                        tempImg.onload = function() {
                            img.src = tempImg.src;
                            imageContainer.classList.remove('loading');
                            img.classList.add('loaded');
                        };
                        tempImg.onerror = function() {
                            img.style.display = 'none';
                            imageContainer.classList.add('no-image');
                            imageContainer.classList.remove('loading');
                        };
                        tempImg.src = img.dataset.src || img.src;

                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px 100px 0px'
            });

            images.forEach(img => {
                imageObserver.observe(img);
            });

            // Animation au scroll optimisée
            const cards = document.querySelectorAll('.category-card');
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                        cardObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            cards.forEach(card => {
                cardObserver.observe(card);
            });

            // Gestion des erreurs d'images améliorée
            images.forEach(img => {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    this.parentElement.classList.add('no-image');
                    this.parentElement.classList.remove('loading');
                });
            });

            // Optimisation des performances
            let ticking = false;

            function updateOnScroll() {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        // Logique de scroll optimisée ici si nécessaire
                        ticking = false;
                    });
                    ticking = true;
                }
            }

            window.addEventListener('scroll', updateOnScroll, {
                passive: true
            });
        });
    </script>
@endpush
