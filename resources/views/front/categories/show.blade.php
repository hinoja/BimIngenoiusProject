@extends('layouts.front')

@section('subtitle', $category->name)
@section('description',__('Discover our expertise in this domain'))

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        /* Variables CSS pour la cohérence */
        :root {
            --primary-color: #b3b158;
            --secondary-color: #764ba2;
            --accent-color: #b3b158;
            --text-dark: #2d3748;
            --text-light: #718096;
            --text-muted: #a0aec0;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.15);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --border-radius: 16px;
            --border-radius-sm: 8px;
            --border-radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Reset et styles de base */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--gradient-bg);
            min-height: 100vh;
        }

        /* Container principal */
        .page-content {
            padding: 2rem 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Article principal moderne */
        .post {
            background: var(--bg-card);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        /* Header avec gradient */
        .post-header {
            background: var(--gradient-primary);
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
        }

        .post-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="0,0 1000,0 1000,100"/></svg>') no-repeat center center;
            background-size: cover;
            opacity: 0.1;
        }

        .post-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .post-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }

        /* Contenu principal */
        .post-body {
            padding: 2.5rem;
        }

        .post-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        /* Zone image modernisée */
        .post-thumbnail-wrapper {
            position: relative;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .post-thumbnail-wrapper:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .post-thumbail {
            position: relative;
            overflow: hidden;
        }

        .post-thumbail img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: var(--border-radius);
            display: block;
            transition: var(--transition);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .post-thumbail:hover img {
            transform: scale(1.05);
        }

        /* Bouton zoom moderne */
        .btn-zoom {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.7) !important;
            color: white !important;
            border: none !important;
            border-radius: 50% !important;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-md);
        }

        .btn-zoom:hover {
            background: var(--primary-color) !important;
            transform: scale(1.1);
            box-shadow: var(--shadow-lg);
        }

        .btn-zoom i {
            font-size: 1.1rem;
        }

        /* Zone description */
        .post-description {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
        }

        .post-content {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        .post-content p {
            margin-bottom: 1.5rem;
        }

        .post-content h1, .post-content h2, .post-content h3 {
            color: var(--text-dark);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        /* Footer moderne */
        .post-footer {
            background: var(--bg-light);
            padding: 2rem 2.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .tag-post {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .project-count {
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-sm);
        }

        .tag-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Sidebar moderne */
        .sidebar {
            background: var(--bg-card);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .widget {
            margin: 0;
        }

        .widget-header {
            background: var(--gradient-primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .widget-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .widget-content {
            padding: 1.5rem;
        }

        .widget ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .widget li {
            margin-bottom: 0.75rem;
        }

        .widget a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius-sm);
            display: block;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .widget a:hover {
            background: var(--bg-light);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            transform: translateX(5px);
        }

        /* Breadcrumb moderne */
        .breadcrumb-modern {
            background: var(--bg-card);
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .breadcrumb-modern a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .breadcrumb-modern a:hover {
            color: var(--secondary-color);
        }

        .breadcrumb-separator {
            color: var(--text-muted);
            margin: 0 0.5rem;
        }

        /* Badge moderne */
        .category-badge {
            background: var(--gradient-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-left: 0.5rem;
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .post {
            animation: fadeInUp 0.6s ease-out;
        }

        .sidebar {
            animation: slideInRight 0.6s ease-out;
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .post-content-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .post-title {
                font-size: 2rem;
            }

            .post-header {
                padding: 2rem 1.5rem;
            }

            .post-body {
                padding: 2rem 1.5rem;
            }

            .post-footer {
                padding: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .post-thumbail img {
                height: 250px;
            }

            .breadcrumb-modern {
                padding: 0.75rem 1rem;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }

            .post-title {
                font-size: 1.75rem;
            }

            .post-header {
                padding: 1.5rem 1rem;
            }

            .post-body {
                padding: 1.5rem 1rem;
            }

            .post-content-grid {
                gap: 1.5rem;
            }

            .post-thumbail img {
                height: 200px;
            }

            .section-title {
                font-size: 1.25rem;
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

@section('previousUrl', route('front.categories.index'))
@section('previousTitle', __('Domains'))

<div class="page-content blog-page">
    <div class="container">


        <div class="row">
            <div class="col-md-9">
                <div class="blog-list blog-single">
                    <article class="post">


                        <!-- Corps du contenu -->
                        <div class="post-body">
                            <div class="post-content-grid">
                                <div class="post-thumbnail-wrapper">
                                    <div class="post-thumbail position-relative">
                                        <a href="{{ $category->image }}" class="glightbox d-block">
                                            <img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy">
                                            <button type="button" class="btn btn-zoom">
                                                <i class="fas fa-search-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="post-description">
                                    <h4 class="section-title">@lang('Description')</h4>
                                    <div class="post-content">{!! $category->description !!}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer moderne -->
                        <div class="post-footer">
                            <div class="tag-post">
                                <span class="tag-label">@lang('Projects in this category :')</span>
                                <span class="project-count">
                                    <i class="fas fa-folder"></i>
                                    {{ $category->projects->count() }} @lang('project(s)')
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="col-md-3">
                <div class="sidebar">
                    <aside class="widget">
                        <div class="widget-header">
                            <h4>@lang('Other categories')</h4>
                        </div>
                        <div class="widget-content">
                            <ul>
                                @foreach ($other_categories as $other_category)
                                    <li>
                                        <a href="{{ route('front.categories.show', $other_category) }}">
                                            {{ $other_category->name }}
                                            @if($other_category->projects->count() > 0)
                                                <span class="category-badge">{{ $other_category->projects->count() }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialisation GLightbox avec options personnalisées
            GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                zoomable: true,
                draggable: true,
                closeButton: true,
                slideEffect: 'slide',
                moreText: 'Voir plus',
                moreLength: 60,
                closeText: 'Fermer',
                downloadText: 'Télécharger',
                openEffect: 'zoom',
                closeEffect: 'zoom'
            });

            // Animation d'entrée améliorée
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observer les éléments
            document.querySelectorAll('.post, .sidebar').forEach(el => {
                observer.observe(el);
            });

            // Gestion des erreurs d'images
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    this.style.background = 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)';
                    this.style.display = 'flex';
                    this.style.alignItems = 'center';
                    this.style.justifyContent = 'center';
                    this.setAttribute('alt', 'Image non disponible');
                });
            });

            // Amélioration de la navigation au clavier
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Fermer la lightbox si ouverte
                    const lightbox = document.querySelector('.glightbox-open');
                    if (lightbox) {
                        lightbox.querySelector('.gclose').click();
                    }
                }
            });

            // Smooth scroll pour les liens internes
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endpush
