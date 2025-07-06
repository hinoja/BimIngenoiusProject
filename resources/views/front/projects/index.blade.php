@extends('layouts.front')

@section('subtitle', __('Our Projects'))
@section('description', __('Explore our latest and greatest projects'))

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
        .projects-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 4rem 0 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .projects-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 0,100 1000,100"/></svg>');
            background-size: cover;
        }

        .projects-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .projects-header p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin: 1rem 0 0;
            position: relative;
            z-index: 1;
        }

        /* Container principal */
        .projects-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
            z-index: 1;
        }

        /* Filtres et recherche */
        .project-filters {
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
            margin: 0 auto 1.5rem;
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

        .filter-projects {
            display: flex;
            justify-content: center;
            gap: 1rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .filter-projects li a {
            text-decoration: none;
            color: var(--text-dark);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: var(--transition);
            font-weight: 500;
        }

        .filter-projects li a.current,
        .filter-projects li a:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Grid des projets */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Carte de projet moderne */
        .project-card {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .project-card-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .project-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .project-card:hover .project-card-image img {
            transform: scale(1.05);
        }

        .project-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
            opacity: 0;
            transition: var(--transition);
        }

        .project-card:hover .project-card-overlay {
            opacity: 1;
        }

        .project-card-content {
            padding: 1.5rem;
        }

        .project-card-category {
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

        .project-card-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 0.75rem;
            line-height: 1.3;
        }

        .project-card-title a {
            color: inherit;
            text-decoration: none;
            transition: var(--transition);
        }

        .project-card-title a:hover {
            color: var(--primary-color);
        }

        .project-card-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .project-card-tags {
            color: var(--text-light);
            font-style: italic;
        }

        .project-card-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .project-card-link:hover {
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

        .project-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .project-card:nth-child(even) {
            animation-delay: 0.1s;
        }

        .project-card:nth-child(3n) {
            animation-delay: 0.2s;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .projects-header h1 {
                font-size: 2.5rem;
            }

            .projects-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .project-filters {
                margin: -1rem 0.5rem 2rem;
                padding: 1.5rem;
            }

            .project-card-content {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .projects-header {
                padding: 2rem 0 1rem;
            }

            .projects-header h1 {
                font-size: 2rem;
            }

            .project-card-image {
                height: 200px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container projects-container">


        <!-- Contenu principal -->
        <div class="row">
            <div class="col-12">
                @if ($projects->isEmpty())
                    <!-- État vide moderne -->
                    <div class="empty-state">
                        <div class="empty-state-icon">🏗️</div>
                        <h3 class="empty-state-title">@lang('No project uploaded yet.')</h3>
                        <p class="empty-state-text">@lang('Check back later for new project updates')</p>
                    </div>
                @else
                    <!-- Filtres et recherche -->
                    <div class="project-filters">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="projectSearch" class="search-input" placeholder="@lang('Search projects...')">
                        </div>
                        <ul id="filter" class="filter-projects none-style">
                            <li><a href="#" class="current" data-filter="*" title="">@lang('All Projects')</a></li>
                            @foreach ($categories as $category)
                                <li><a href="#" data-filter=".{{ $category->slug }}"
                                        title="">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Grid des projets -->
                    <div id="gallery" class="projects-grid all-project">
                        @foreach ($projects as $project)
                            <div class="col-md-4 col-sm-6 item {{ $project->category->slug }}">
                                <article class="project-card">
                                    <div class="project-card-image">
                                        <img src="{{ $project->image }}" alt="{{ $project->title }}" loading="lazy">
                                        <div class="project-card-overlay"></div>
                                    </div>
                                    <div class="project-card-content">
                                        <span class="project-card-category">{{ $project->category->name }}</span>
                                        <h2 class="project-card-title">
                                            <a href="{{ route('front.projects.show', $project) }}">{{ $project->title }}</a>
                                        </h2>
                                        <div class="project-card-meta">
                                            <div class="project-card-tags">
                                                <i>{{ $project->tags->first()->name ?? 'No tag' }}</i>
                                            </div>
                                        </div>
                                        <a href="{{ route('front.projects.show', $project) }}" class="project-card-link">
                                            @lang('View Project')
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Pagination moderne -->
                @if (!$projects->isEmpty())
                    <div class="pagination-container">
                        {{ $projects->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('includes.front.action-about')
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.isotope.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-projectlist.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-blog.js') }}"></script>
    <script>
        // Recherche en temps réel
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('projectSearch');
            const projectCards = document.querySelectorAll('.project-card');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    projectCards.forEach(card => {
                        const title = card.querySelector('.project-card-title').textContent
                            .toLowerCase();
                        const category = card.querySelector('.project-card-category').textContent
                            .toLowerCase();
                        if (title.includes(query) || category.includes(query)) {
                            card.parentElement.style.display = '';
                            card.style.animation = 'fadeInUp 0.3s ease-out';
                        } else {
                            card.parentElement.style.display = 'none';
                        }
                    });
                });
            }

            // Lazy loading des images
            const images = document.querySelectorAll('.project-card-image img');
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
            const cards = document.querySelectorAll('.project-card');
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
