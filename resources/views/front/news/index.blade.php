@extends('layouts.front')

@section('subtitle', __('News'))
@section('description', __('Stay informed with our latest news and updates. Discover carefully curated articles,
    stories, and announcements that matter to you.'))
    @push('css')
        <style>
            /* Variables CSS pour la cohérence */
            :root {
                --primary-color: #b3b158;
                --secondary-color: #764ba2;
                --accent-color: #b3b158;
                --text-dark: #2d3748;
                --text-light: #718096;
                --bg-light: #f7fafc;
                --bg-white: #ffffff;
                --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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

            /* Header Section */
            .news-header {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                padding: 4rem 0 2rem;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .news-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 0,100 1000,100"/></svg>');
                background-size: cover;
            }

            .news-header h1 {
                font-size: 3.5rem;
                font-weight: 800;
                color: white;
                margin: 0;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                position: relative;
                z-index: 1;
            }

            .news-header p {
                font-size: 1.25rem;
                color: rgba(255, 255, 255, 0.9);
                margin: 1rem 0 0;
                position: relative;
                z-index: 1;
            }

            /* Container principal */
            .news-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
                position: relative;
                z-index: 1;
            }

            /* Filtres et recherche */
            .news-filters {
                background: var(--bg-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-md);
                padding: 2rem;
                margin: -2rem 1rem 3rem;
                position: relative;
                z-index: 2;
            }

            .search-box {
                position: relative;
                max-width: 400px;
                margin: 0 auto;
            }

            .search-input {
                width: 100%;
                padding: 1rem 1rem 1rem 3rem;
                border: 2px solid #e2e8f0;
                border-radius: 50px;
                font-size: 1rem;
                transition: var(--transition);
                background: var(--bg-light);
            }

            .search-input:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .search-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-light);
            }

            /* Grid des articles */
            .news-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            /* Carte d'article moderne */
            .news-card {
                background: var(--bg-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
                transition: var(--transition);
                position: relative;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .news-card:hover {
                transform: translateY(-8px);
                box-shadow: var(--shadow-lg);
            }

            .news-card-image {
                position: relative;
                height: 240px;
                overflow: hidden;
            }

            .news-card-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: var(--transition);
            }

            .news-card:hover .news-card-image img {
                transform: scale(1.05);
            }

            .news-card-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
                opacity: 0;
                transition: var(--transition);
            }

            .news-card:hover .news-card-overlay {
                opacity: 1;
            }

            .news-card-content {
                padding: 1.5rem;
            }

            .news-card-category {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
                color: white;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 1rem;
            }

            .news-card-title {
                font-size: 1.375rem;
                font-weight: 700;
                color: var(--text-dark);
                margin: 0 0 0.75rem;
                line-height: 1.3;
            }

            .news-card-title a {
                color: inherit;
                text-decoration: none;
                transition: var(--transition);
            }

            .news-card-title a:hover {
                color: var(--primary-color);
            }

            .news-card-meta {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1rem;
                font-size: 0.875rem;
                color: var(--text-light);
            }

            .news-card-date {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .news-card-excerpt {
                color: var(--text-light);
                margin: 0 0 1.5rem;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .news-card-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: var(--primary-color);
                font-weight: 600;
                text-decoration: none;
                transition: var(--transition);
            }

            .news-card-link:hover {
                color: var(--secondary-color);
                text-decoration: none;
            }

            /* État vide moderne */
            .empty-state {
                text-align: center;
                padding: 4rem 2rem;
                background: var(--bg-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                margin: 2rem 0;
            }

            .empty-state-icon {
                font-size: 4rem;
                color: var(--text-light);
                margin-bottom: 1rem;
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

            /* Animations de chargement */
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

            .news-card {
                animation: fadeInUp 0.6s ease-out;
            }

            .news-card:nth-child(even) {
                animation-delay: 0.1s;
            }

            .news-card:nth-child(3n) {
                animation-delay: 0.2s;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .news-header h1 {
                    font-size: 2.5rem;
                }

                .news-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .news-filters {
                    margin: -1rem 0.5rem 2rem;
                    padding: 1.5rem;
                }

                .news-card-content {
                    padding: 1rem;
                }
            }

            @media (max-width: 480px) {
                .news-header {
                    padding: 2rem 0 1rem;
                }

                .news-header h1 {
                    font-size: 2rem;
                }

                .news-card-image {
                    height: 200px;
                }
            }

            /* Micro-interactions */
            .news-card-link::after {
                content: '→';
                margin-left: 0.5rem;
                transition: var(--transition);
            }

            .news-card-link:hover::after {
                transform: translateX(4px);
            }

            /* Skeleton Loading pour les images */
            .news-card-image::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
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

            .news-card-image img {
                position: relative;
                z-index: 2;
            }
        </style>
    @endpush

@section('content')

    <div class="container news-container">


        <!-- Contenu principal -->
        <div class="row">
            <div class="col-12">
                @if ($news->isEmpty())
                    <!-- État vide moderne -->
                    <div class="empty-state">
                        <div class="empty-state-icon">📰</div>
                        <h3 class="empty-state-title">@lang('No news published yet')</h3>
                        <p class="empty-state-text">@lang('Check back later for the latest updates and stories')</p>
                    </div>
                @else
                    <!-- Grid des articles -->
                    <div class="news-grid">
                        @foreach ($news as $news_item)
                            <article class="news-card">
                                <div class="news-card-image">
                                    <img src="{{ $news_item->image }}" alt="{{ $news_item->title }}" loading="lazy">
                                    <div class="news-card-overlay"></div>
                                </div>

                                <div class="news-card-content">
                                    <span class="news-card-category">@lang('News')</span>

                                    <h2 class="news-card-title">
                                        <a href="{{ route('front.news.show', $news_item) }}">
                                            {{ $news_item->title }}
                                        </a>
                                    </h2>

                                    <div class="news-card-meta">
                                        <div class="news-card-date">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                    ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ $news_item->published_at }}
                                        </div>
                                    </div>

                                    <p class="news-card-excerpt">
                                        {{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($news_item->medium_content)), 150) }}
                                    </p>

                                    <a href="{{ route('front.news.show', $news_item) }}" class="news-card-link">
                                        @lang('Read More')
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif

                <!-- Pagination moderne -->
                @if (!$news->isEmpty())
                    <div class="pagination-container">
                        {{ $news->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('includes.front.action-about')
@endsection

@push('js')
    {{-- <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog.js') }}"></script> --}}
    <script>
        // Recherche en temps réel
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const newsCards = document.querySelectorAll('.news-card');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();

                    newsCards.forEach(card => {
                        const title = card.querySelector('.news-card-title').textContent
                            .toLowerCase();
                        const excerpt = card.querySelector('.news-card-excerpt').textContent
                            .toLowerCase();

                        if (title.includes(query) || excerpt.includes(query)) {
                            card.style.display = '';
                            card.style.animation = 'fadeInUp 0.3s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Lazy loading des images
            const images = document.querySelectorAll('.news-card-image img');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));

            // Animation au scroll
            const cards = document.querySelectorAll('.news-card');
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => cardObserver.observe(card));
        });
    </script>
@endpush
