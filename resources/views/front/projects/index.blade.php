@extends('layouts.front')

@section('subtitle', __('Our Projects'))
@section('description', __('Explore our latest and greatest projects'))


 @push('css')
    <style>
        :root {
            --primary-color: #b3b158;
            --secondary-color: #764ba2;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--bg-light);
            min-height: 100vh;
        }

        /* Header Section */
        .projects-header {
            background: linear-gradient(135deg, var(--primary-color), #8b6914);
            padding: clamp(2rem, 5vw, 4rem) 0 clamp(1rem, 3vw, 2rem);
            text-align: center;
            position: relative;
        }

        .projects-header h1 {
            font-size: clamp(1.75rem, 5vw, 3.5rem);
            font-weight: 700;
            color: #fff;
            margin: 0;
            line-height: 1.2;
        }

        .projects-header p {
            font-size: clamp(0.9rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.9);
            margin: clamp(0.5rem, 2vw, 1rem) 0 0;
        }

        /* Container */
        .projects-container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }

        /* Filtres et recherche */
        .project-filters {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            padding: clamp(1rem, 3vw, 2rem);
            margin: clamp(-1.5rem, -3vw, -2rem) 0.5rem clamp(1.5rem, 3vw, 3rem);
            position: relative;
        }

        .search-box { position: relative; max-width: 100%; margin: 0 0 clamp(0.75rem, 2vw, 1.5rem); }
        .search-input {
            width: 100%;
            padding: clamp(0.5rem, 2vw, 1rem) clamp(0.5rem, 2vw, 1rem) clamp(0.5rem, 2vw, 1rem) clamp(1.5rem, 3vw, 3rem);
            border: 1px solid #ced4da;
            border-radius: 50px;
            font-size: clamp(0.85rem, 2vw, 1rem);
            transition: var(--transition);
            background: #fff;
        }
        .search-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(179, 177, 88, 0.2); }
        .search-icon {
            position: absolute;
            left: clamp(0.5rem, 1.5vw, 1rem);
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: clamp(0.9rem, 2vw, 1rem);
        }

        .filter-toggle {
            display: none;
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: clamp(0.5rem, 1.5vw, 0.75rem) clamp(1rem, 2vw, 1.5rem);
            border-radius: 8px;
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
            cursor: pointer;
            margin: clamp(0.5rem, 1vw, 1rem) auto;
            width: 100%;
            text-align: center;
        }

        .filter-projects {
            display: flex;
            justify-content: center;
            gap: clamp(0.5rem, 1.5vw, 1rem);
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .filter-projects li a {
            text-decoration: none;
            color: var(--text-dark);
            padding: clamp(0.4rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1rem);
            border-radius: 20px;
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
            font-weight: 500;
            transition: var(--transition);
        }

        .filter-projects li a.current,
        .filter-projects li a:hover { background: var(--primary-color); color: #fff; }

        /* Grid des projets */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: clamp(1rem, 3vw, 2rem);
            margin-bottom: clamp(1.5rem, 3vw, 3rem);
        }

        /* Carte de projet */
        .project-card {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: var(--transition);
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .project-card-image {
            position: relative;
            aspect-ratio: 4 / 3;
            overflow: hidden;
        }

        .project-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .project-card:hover .project-card-image img { transform: scale(1.05); }
        .project-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.4));
            opacity: 0;
            transition: var(--transition);
        }

        .project-card:hover .project-card-overlay { opacity: 1; }
        .project-card-content { padding: clamp(1rem, 2vw, 1.5rem); }

        .project-card-category {
            padding: clamp(0.2rem, 1vw, 0.25rem) clamp(0.5rem, 1.5vw, 0.75rem);
            background: var(--primary-color);
            color: #fff;
            border-radius: 20px;
            font-size: clamp(0.65rem, 1.5vw, 0.75rem);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: clamp(0.5rem, 1.5vw, 1rem);
        }

        .project-card-title {
            font-size: clamp(1.1rem, 2.5vw, 1.375rem);
            font-weight: 600;
            color: var(--text-dark);
            margin: 0 0 clamp(0.5rem, 1.5vw, 0.75rem);
            line-height: 1.3;
        }

        .project-card-title a { color: inherit; text-decoration: none; }
        .project-card-title a:hover { color: var(--primary-color); }

        .project-card-meta {
            font-size: clamp(0.75rem, 1.5vw, 0.875rem);
            color: var(--text-light);
            margin-bottom: clamp(0.5rem, 1.5vw, 1rem);
        }

        .project-card-link {
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .project-card-link:hover { color: var(--secondary-color); }

        /* État vide */
        .empty-state {
            padding: clamp(2rem, 5vw, 4rem) clamp(1rem, 3vw, 2rem);
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin: clamp(1rem, 2vw, 2rem) 0;
            text-align: center;
        }

        .empty-state-icon { font-size: clamp(2.5rem, 6vw, 4rem); color: var(--text-light); margin-bottom: clamp(0.5rem, 1.5vw, 1rem); }
        .empty-state-title { font-size: clamp(1.25rem, 3vw, 1.5rem); font-weight: 600; color: var(--text-dark); margin-bottom: clamp(0.25rem, 1vw, 0.5rem); }
        .empty-state-text { font-size: clamp(0.85rem, 2vw, 1.1rem); color: var(--text-light); }

        /* Pagination */
        .pagination-container { display: flex; justify-content: center; margin: clamp(1.5rem, 3vw, 3rem) 0; }
        .pagination { display: flex; gap: clamp(0.25rem, 1vw, 0.5rem); align-items: center; }
        .pagination .page-item { list-style: none; }
        .pagination .page-link {
            width: clamp(36px, 4vw, 48px);
            height: clamp(36px, 4vw, 48px);
            border: 1px solid #ced4da;
            border-radius: 50%;
            color: var(--text-dark);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(0.8rem, 1.5vw, 0.9rem);
            text-decoration: none;
            transition: var(--transition);
        }
        .pagination .page-link:hover { background: var(--primary-color); border-color: var(--primary-color); color: #fff; }
        .pagination .page-item.active .page-link { background: var(--primary-color); border-color: var(--primary-color); color: #fff; }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .project-card { animation: fadeInUp 0.5s ease-out; }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .projects-grid { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
            .project-card-image { aspect-ratio: 4 / 3; }
        }

        @media (max-width: 768px) {
            .filter-toggle { display: block; }
            .filter-projects {
                display: none;
                flex-direction: column;
                gap: 0.5rem;
                background: var(--bg-white);
                padding: 1rem;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 10;
            }
            .filter-projects.active { display: flex; }
            .projects-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            .project-card-content { padding: clamp(0.75rem, 2vw, 1rem); }
            .project-card-title { font-size: clamp(1rem, 2.5vw, 1.15rem); }
            .project-card-meta { font-size: clamp(0.7rem, 1.5vw, 0.8rem); }
            .project-card-link { font-size: clamp(0.75rem, 1.5vw, 0.85rem); }
        }

        @media (max-width: 480px) {
            .project-card-image { aspect-ratio: 3 / 2; }
            .pagination .page-link { width: 48px; height: 48px; }
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('assets/front/js/jquery.isotope.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/front/js/custom-projectlist.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/front/js/custom-blog.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('projectSearch');
            const projectCards = document.querySelectorAll('.project-card');
            const filterToggle = document.querySelector('.filter-toggle');
            const filterProjects = document.querySelector('.filter-projects');

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    const query = searchInput.value.toLowerCase().trim();
                    projectCards.forEach(card => {
                        const title = card.querySelector('.project-card-title').textContent.toLowerCase();
                        const category = card.querySelector('.project-card-category').textContent.toLowerCase();
                        const parent = card.parentElement;
                        if (title.includes(query) || category.includes(query)) {
                            parent.style.display = '';
                        } else {
                            parent.style.display = 'none';
                        }
                    });
                });
            }

            if (filterToggle && filterProjects) {
                filterToggle.addEventListener('click', () => {
                    filterProjects.classList.toggle('active');
                });
            }

            const images = document.querySelectorAll('.project-card-image img');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.src = entry.target.src;
                        entry.target.classList.add('loaded');
                        observer.unobserve(entry.target);
                    }
                });
            });
            images.forEach(img => imageObserver.observe(img));

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.style.animation = 'fadeInUp 0.5s ease-out';
                });
            }, { threshold: 0.2 });
            document.querySelectorAll('.project-card').forEach(card => observer.observe(card));
        });
    </script>
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
                        {{-- <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="projectSearch" class="search-input" placeholder="@lang('Search projects...')">
                        </div> --}}
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
                        @forelse ($projects as $project)
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
                            @empty
                        @endforelse
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

