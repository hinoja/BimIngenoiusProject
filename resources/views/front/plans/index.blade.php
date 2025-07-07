@extends('layouts.front')

@section('subtitle', __('Plans'))
@section('description', __('Discover our collection of carefully crafted plans'))

@push('css')
    <style>
        /* CSS Variables for Consistency */
        :root {
            --primary-color: #007bff;
            --secondary-color: #0056b3;
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

        /* Base Styles */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Plans Grid */
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Plan Card */
        .plan-card {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.6s ease-out;
        }

        .plan-card:nth-child(even) {
            animation-delay: 0.1s;
        }

        .plan-card:nth-child(3n) {
            animation-delay: 0.2s;
        }

        .plan-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .plan-card-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .plan-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .plan-card:hover .plan-card-image img {
            transform: scale(1.05);
        }

        .plan-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
            opacity: 0;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .plan-card:hover .plan-card-overlay {
            opacity: 1;
        }

        .plan-card-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .plan-card-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 0.75rem;
            line-height: 1.3;
        }

        .plan-card-title a {
            color: inherit;
            text-decoration: none;
            transition: var(--transition);
        }

        .plan-card-title a:hover {
            color: var(--primary-color);
        }

        .plan-card-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .plan-card-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .plan-card-description {
            color: var(--text-light);
            margin: 0 0 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .plan-card-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .plan-card-link:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }

        .plan-card-link::after {
            content: '→';
            margin-left: 0.5rem;
            transition: var(--transition);
        }

        .plan-card-link:hover::after {
            transform: translateX(4px);
        }

        /* Empty State */
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

        .empty-state-description {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Pagination */
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

        /* Skeleton Loading for Images */
        .plan-card-image::before {
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

        .plan-card-image img {
            position: relative;
            z-index: 2;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .plans-hero h1 {
                font-size: 2.5rem;
            }

            .plans-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stats-bar {
                margin: -1rem 0.5rem 2rem;
                padding: 1.5rem;
            }

            .plan-card-content {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .plans-hero {
                padding: 2rem 0 1rem;
            }

            .plans-hero h1 {
                font-size: 2rem;
            }

            .plan-card-image {
                height: 200px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container">

        @if ($plans->isEmpty())
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">🗂️</div>
                <h3 class="empty-state-title">@lang('No plans available yet')</h3>
                <p class="empty-state-description">@lang('Check back later for the latest plans and offerings')</p>
            </div>
        @else
            <!-- Plans Grid -->
            <div class="plans-grid">
                @foreach ($plans as $plan)
                    <article class="plan-card">
                        <div class="plan-card-image">
                            <img src="{{ $plan->image }}" alt="{{ $plan->title }}" loading="lazy"
                                onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=&quot;display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8f9fa; color: #6c757d; font-size: 1rem; height: 100%;&quot;><i class=&quot;fas fa-image&quot; style=&quot;font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;&quot;></i><span>Image not available</span></div>';">
                            <div class="plan-card-overlay">
                                <a href="{{ route('front.plans.show', $plan) }}" class="plan-card-link">
                                    @lang('View Plan')
                                </a>
                            </div>
                        </div>

                        <div class="plan-card-content">
                            <h2 class="plan-card-title">
                                <a href="{{ route('front.plans.show', $plan->slug) }}">
                                    {{ $plan->title }}
                                </a>
                            </h2>

                            <div class="plan-card-meta">
                                <div class="plan-card-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $plan->created_at }}
                                </div>
                            </div>

                            cancelling
                            @if (isset($plan->description))
                                <p class="plan-card-description">
                                    {{ Str::limit(str_replace(' ', ' ', strip_tags($plan->description)), 150) }}
                                </p>
                            @endif

                            <a href="{{ route('front.plans.show', $plan) }}" class="plan-card-link">
                                @lang('Read More')
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($plans->hasPages())
                <div class="pagination-container">
                    {{ $plans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endif

        @include('includes.front.action-about')
    </div>
@endsection

@push('js')
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy loading des images
            const images = document.querySelectorAll('.plan-card-image img');
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
            const cards = document.querySelectorAll('.plan-card');
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

            // Debug
            console.log('Plans page loaded');
            console.log('Cards found:', cards.length);
        });
    </script>
@endpush
