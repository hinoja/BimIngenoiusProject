@extends('layouts.front')

@section('subtitle', isset($news) ? $news->title : 'News')

@php
    $tags = isset($news) && $news->tags ? $news->tags->pluck('name')->implode(', ') : '';
@endphp

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #b3b158 0%, #b3b158 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #4a6741 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .container { max-width: 1200px; position: relative; }

        .blog-single {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--glass-border);
            overflow: hidden;
            margin: 2rem 0;
            transition: var(--transition);
        }

        .blog-single:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }

        .post { position: relative; }

        .post-header {
            padding: 3rem 3rem 2rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            position: relative;
            overflow: hidden;
        }

        .post-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .post-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: var(--dark-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .post-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #666;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .meta-item:hover { background: rgba(255, 255, 255, 0.9); transform: translateY(-2px); }

        .meta-icon {
            width: 16px;
            height: 16px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
        }

        .post-thumbnail {
            position: relative;
            margin: 2rem 3rem;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .post-thumbnail img {
            width: 100%;
            height: 400px; /* Restauré temporairement pour éviter l'étirement */
            object-fit: cover;
            transition: var(--transition);
        }

        .post-thumbnail:hover img { transform: scale(1.05); }

        .zoom-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.2), transparent);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .post-thumbnail:hover .zoom-overlay { opacity: 1; }

        .btn-zoom {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #2c3e50;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-zoom:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .post-content {
            padding: 2rem 3rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .content-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .content-header h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .content-divider {
            flex: 1;
            height: 2px;
            background: var(--primary-gradient);
            border-radius: 1px;
        }

        .post-content-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            text-align: justify;
        }

        .post-content-text h1, .post-content-text h2, .post-content-text h3 {
            font-family: 'Playfair Display', serif;
            color: #2c3e50;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .post-content-text p { margin-bottom: 1.5rem; }

        .post-content-text a {
            color: #b3b158;
            text-decoration: none;
            border-bottom: 1px dotted #b3b158;
            transition: var(--transition);
        }

        .post-content-text a:hover { color: #b3b158; border-bottom-color: #b3b158; }

        .post-footer {
            padding: 2rem 3rem 3rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }

        .tag-section { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
        .tag-label { font-weight: 600; color: #2c3e50; font-size: 0.9rem; }
        .tags-container { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .tag-item {
            background: var(--primary-gradient);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .tag-item:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); }

        .share-section { display: flex; align-items: center; gap: 1rem; }
        .share-label { font-weight: 600; color: #2c3e50; font-size: 0.9rem; }

        .floating-actions {
            position: fixed;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            z-index: 1000;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .floating-btn:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: var(--primary-gradient);
            z-index: 1000;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .post-title { font-size: 2rem; }
            .post-header, .post-content { padding: 2rem 1.5rem; }
            .post-thumbnail { margin: 1.5rem; }
            .post-footer { padding: 1.5rem; flex-direction: column; align-items: flex-start; }
            .floating-actions { right: 1rem; }
            .post-meta { flex-direction: column; align-items: flex-start; gap: 1rem; }
        }

        /* Animation pour les éléments qui apparaissent au scroll */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: var(--transition);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush

@section('content')
    @section('previousUrl', route('front.news.index'))
    @section('previousTitle', __('News'))

    <!-- Barre de progression de lecture -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- Actions flottantes -->
    <div class="floating-actions">
        <button class="floating-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Retour en haut">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button class="floating-btn" onclick="window.print()" title="Imprimer">
            <i class="fas fa-print"></i>
        </button>
        <button class="floating-btn" onclick="toggleBookmark()" title="Marquer comme favori">
            <i class="fas fa-bookmark"></i>
        </button>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-list blog-single animate__animated animate__fadeInUp">
                    <article class="post">

                        <!-- En-tête de l'article -->
                        <div class="post-header">
                            <h1 class="post-title">{{ isset($news) ? $news->title : 'Titre non disponible' }}</h1>
                            <div class="post-meta">
                                <div class="meta-item">
                                    <div class="meta-icon">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <span>
                                        <strong>@lang('Published at:')</strong> {{ isset($news) ? $news->published_at : 'Date non disponible' }}
                                    </span>
                                </div>

                                @if (isset($news) && $news->created_at != $news->updated_at && $news->updated_at >= $news->published_at)
                                    <div class="meta-item">
                                        <div class="meta-icon">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <span>
                                            <strong>@lang('Updated at:')</strong> {{ $news->updated_at }}
                                        </span>
                                    </div>
                                @endif

                                <div class="meta-item">
                                    <div class="meta-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>
                                        <strong>@lang('By') : </strong> {{ isset($news) && isset($news->user) ? $news->user->name : 'Auteur non disponible' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Image principale -->
                        <div class="post-thumbnail">
                            @if (isset($news) && $news->image)
                                <a href="{{ $news->image }}" class="glightbox d-block">
                                    <img src="{{ $news->image }}" alt="{{ isset($news) ? $news->title : 'Image non disponible' }}">
                                    <div class="zoom-overlay">
                                        <div class="btn-zoom">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <p>Image non disponible</p>
                            @endif
                        </div>

                        <!-- Contenu de l'article -->
                        <div class="post-content reveal">
                            <div class="content-header">
                                <h4>@lang('NEWS DETAILS')</h4>
                                <div class="content-divider"></div>
                            </div>
                            <div class="post-content-text">
                                {{ isset($news) ? $news->content : 'Contenu non disponible' }}
                            </div>
                        </div>

                        <!-- Pied de page avec tags et partage -->
                        <div class="post-footer reveal">
                            <div class="tag-section">
                                <span class="tag-label">@lang('Tags:')</span>
                                <div class="tags-container">
                                    @if (isset($news) && $news->tags)
                                        @foreach ($news->tags as $tag)
                                            <span class="tag-item">{{ $tag->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="tag-item">Aucun tag</span>
                                    @endif
                                </div>
                            </div>

                            <div class="share-section">
                                <span class="share-label">@lang('Share'):</span>
                                @if (isset($news))
                                    @include('includes.front.social-media-share', ['data' => $news])
                                @endif
                            </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>

    @include('includes.front.action-about')

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation de GLightbox
            GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });

            // Barre de progression de lecture
            const readingProgress = document.getElementById('readingProgress');

            function updateReadingProgress() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = (scrollTop / scrollHeight) * 100;
                readingProgress.style.width = progress + '%';
            }

            window.addEventListener('scroll', updateReadingProgress);

            // Animation des éléments au scroll
            const revealElements = document.querySelectorAll('.reveal');

            function revealOnScroll() {
                revealElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementTop < windowHeight - 100) {
                        element.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', revealOnScroll);
            revealOnScroll(); // Vérifier au chargement

            // Smooth scroll pour les liens internes
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });

        // Fonction pour toggle bookmark
        function toggleBookmark() {
            const btn = event.target.closest('.floating-btn');
            const icon = btn.querySelector('i');

            if (icon.classList.contains('fas')) {
                icon.classList.remove('fas');
                icon.classList.add('far');
                showNotification('Retiré des favoris');
            } else {
                icon.classList.remove('far');
                icon.classList.add('fas');
                showNotification('Ajouté aux favoris');
            }
        }

        // Notification système
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--primary-gradient);
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                animation: slideInRight 0.3s ease-out;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Ajout des animations CSS pour les notifications
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
@endpush
