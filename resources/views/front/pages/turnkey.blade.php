
@extends('layouts.front')

@section('subtitle', __('Turnkey Offer'))
@section('description', __('Discover our turnkey offer, a complete solution for your construction needs, from design to execution, ensuring quality and efficiency.'))
@section('meta-keywords', 'turnkey offer, construction, design, execution, quality, efficiency')

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
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), #8b6914);
            min-height: 50vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 4rem 0;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            opacity: 0.5;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            padding: 2rem;
        }

        .hero-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.15rem);
            font-weight: 400;
            max-width: 500px;
            margin: 0 auto 1.5rem;
            opacity: 0.9;
        }

        .cta-button {
            background: #fff;
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .cta-button:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            text-decoration: none;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .section-title h2 {
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .section-title p {
            font-size: 1rem;
            color: var(--text-light);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Cards */
        .modern-card {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: var(--primary-color);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .card-list {
            list-style: none;
            padding: 0;
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .card-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .card-list i {
            color: var(--secondary-color);
            font-size: 1rem;
            margin-top: 0.2rem;
        }

        /* Features Section */
        .features-section {
            background: var(--bg-light);
            padding: 4rem 0;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .feature-item {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .feature-description {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 40vh;
                padding: 2rem 0;
            }

            .hero-title {
                font-size: clamp(1.75rem, 3vw, 2rem);
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .modern-card {
                padding: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-on-scroll {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
@endpush

@section('content')
 
    <!-- Offre Principale -->
    <section id="key-offering" class="py-5">
        <div class="container">
            <div class="section-title">
                <h2>@lang('Why Choose Our Approach')</h2>
                <p>@lang('Comprehensive expertise for your peace of mind')</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 animate-on-scroll">
                    <div class="modern-card">
                        <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3 class="card-title">@lang('Peace of Mind')</h3>
                        <ul class="card-list">
                            <li><i class="fas fa-check-circle"></i> @lang('Anticipation of execution and safety constraints')</li>
                            <li><i class="fas fa-check-circle"></i> @lang('Experience-driven analysis and benchmarking')</li>
                            <li><i class="fas fa-check-circle"></i> @lang('Transparent PMG offer')</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll">
                    <div class="modern-card">
                        <div class="card-icon"><i class="fas fa-star"></i></div>
                        <h3 class="card-title">@lang('Our Strengths & Benefits')</h3>
                        <ul class="card-list">
                            <li><i class="fas fa-gem"></i> @lang('Single team from design to delivery')</li>
                            <li><i class="fas fa-cogs"></i> @lang('Multidisciplinary expertise')</li>
                            <li><i class="fas fa-user-check"></i> @lang('Deep understanding of client needs')</li>
                            <li><i class="fas fa-chart-line"></i> @lang('Optimized financial performance')</li>
                            <li><i class="fas fa-sync"></i> @lang('System & process integration')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Engagements -->
    <section class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>@lang('Our Commitments')</h2>
                <p>@lang('Four core pillars for your success')</p>
            </div>
            <div class="feature-grid">
                <div class="feature-item animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-thumbs-up"></i></div>
                    <h3 class="feature-title">@lang('Quality')</h3>
                    <p class="feature-description">
                        @lang('High-quality finishes, seamless commissioning, and personalized client service.')
                    </p>
                </div>
                <div class="feature-item animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h3 class="feature-title">@lang('Cost')</h3>
                    <p class="feature-description">
                        @lang('Value engineering, transparent pricing, and Guaranteed Maximum Price (GMP) contract.')
                    </p>
                </div>
                <div class="feature-item animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-clock"></i></div>
                    <h3 class="feature-title">@lang('Timeline')</h3>
                    <p class="feature-description">
                        @lang('Committed scheduling from design phase and daily project management.')
                    </p>
                </div>
                <div class="feature-item animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3 class="feature-title">@lang('Insurance')</h3>
                    <p class="feature-description">
                        @lang('Comprehensive coverage included as standard in our projects.')
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('includes.front.action-about')
@endsection

@push('js')
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-on-scroll');
                    entry.target.style.animationDelay = `${entry.target.dataset.delay || 0}s`;
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.animate-on-scroll').forEach((el, index) => {
            el.dataset.delay = (index * 0.1).toFixed(1);
            observer.observe(el);
        });
    </script>
@endpush
