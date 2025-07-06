@extends('layouts.front')

@section('subtitle', __('Turnkey Offer'))

@section('description', __('Discover our turnkey offer, designed to provide you with a complete solution for your construction needs. We handle everything from design to execution, ensuring quality and efficiency throughout the process.'))
@section('meta-keywords', 'turnkey offer, construction, design, execution, quality, efficiency')

@push('css')
<style>
    /* Variables CSS pour la cohérence */
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #f59e0b;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --bg-light: #f8fafc;
        --bg-card: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    /* Hero Section Moderne */
    .hero-modern {
        background: var(--gradient-primary);
        min-height: 60vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="white" stop-opacity="0.1"/><stop offset="100%" stop-color="white" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
        background-size: cover;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-subtitle {
        font-size: clamp(1.1rem, 2vw, 1.25rem);
        font-weight: 300;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.6;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: white;
        color: var(--primary-color);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-lg);
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: var(--primary-color);
        text-decoration: none;
    }

    /* Cards Modernes */
    .modern-card {
        background: var(--bg-card);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        height: 100%;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        background: var(--gradient-secondary);
        color: white;
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .card-list {
        list-style: none;
        padding: 0;
    }

    .card-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        padding: 0.5rem;
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    .card-list li:hover {
        background: var(--bg-light);
    }

    .card-list i {
        color: var(--accent-color);
        font-size: 1.1rem;
        margin-top: 0.1rem;
    }

    /* Section Features */
    .features-section {
        background: var(--bg-light);
        padding: 5rem 0;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .feature-item {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    .feature-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .feature-description {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .section-title p {
        font-size: 1.1rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-modern {
            min-height: 50vh;
        }

        .modern-card {
            padding: 1.5rem;
        }

        .feature-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
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

    .animate-fade-in {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Glassmorphism Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

@section('content')
    <!-- Hero Section Moderne -->
    <section class="hero-modern">
        <div class="container">
            <div class="hero-content animate-fade-in">
                <h1 class="hero-title">@lang('Notre Offre Clés en Main')</h1>
                <p class="hero-subtitle">
                    @lang('Découvrez notre offre clés en main, conçue pour vous fournir une solution complète pour vos besoins de construction. Nous gérons tout, de la conception à la réalisation.')
                </p>
                <a href="#key-offering" class="cta-button">
                    @lang('Découvrir nos services')
                    <i class="fas fa-arrow-down"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Offre Principale -->
    <section id="key-offering" class="py-5">
        <div class="container">
            <div class="section-title">
                <h2>@lang('Pourquoi Choisir Notre Approche')</h2>
                <p>@lang('Une expertise complète pour votre tranquillité d\'esprit')</p>
            </div>

            <div class="row g-4">
                <!-- Card 1 - Tranquillité d'esprit -->
                <div class="col-lg-6">
                    <div class="modern-card">
                        <div class="card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="card-title">@lang('Profitez d\'une Tranquillité d\'Esprit')</h3>
                        <ul class="card-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>@lang('Anticipation des contraintes d\'exécution et de sécurité')</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>@lang('Retour d\'expérience et analyse comparative')</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>@lang('Offre PMG pour plus de transparence')</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card 2 - Forces et Bénéfices -->
                <div class="col-lg-6">
                    <div class="modern-card">
                        <div class="card-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="card-title">@lang('Nos Forces & Bénéfices')</h3>
                        <div class="row g-3">
                            <div class="col-12">
                                <ul class="card-list">
                                    <li>
                                        <i class="fas fa-gem"></i>
                                        <span>@lang('Équipe unique de la conception à la livraison')</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-cogs"></i>
                                        <span>@lang('Expertise multidisciplinaire')</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-user-check"></i>
                                        <span>@lang('Immersion dans le métier du client')</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-chart-line"></i>
                                        <span>@lang('Performance financière optimisée')</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-industry"></i>
                                        <span>@lang('Expertise en sites occupés')</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-sync"></i>
                                        <span>@lang('Intégration Système & Processus')</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Features -->
    <section class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>@lang('Nos Engagements')</h2>
                <p>@lang('Quatre piliers fondamentaux pour votre succès')</p>
            </div>

            <div class="feature-grid">
                <!-- Quality -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <h3 class="feature-title">@lang('Qualité')</h3>
                    <div class="feature-description">
                        <ul class="card-list">
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Finition de haute qualité sans réserve majeure')</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Mise en service anticipée et fluide')</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Service client personnalisé avec adaptation')</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cost -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">@lang('Coût')</h3>
                    <div class="feature-description">
                        <ul class="card-list">
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Ingénierie de valeur tout au long du projet')</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Tarification transparente')</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Contrat Prix Maximum Garanti (PMG)')</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Time -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">@lang('Délais')</h3>
                    <div class="feature-description">
                        <ul class="card-list">
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Engagement sur un planning global dès la phase conception')</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Gestion de projet quotidienne')</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Insurance -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">@lang('Assurance')</h3>
                    <div class="feature-description">
                        <ul class="card-list">
                            <li>
                                <i class="fas fa-check"></i>
                                <span>@lang('Couverture très efficace incluse en standard dans nos projets')</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.front.action-about')

@endsection

@push('js')
<script>
    // Smooth scrolling pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observer tous les éléments à animer
    document.querySelectorAll('.modern-card, .feature-item').forEach(el => {
        observer.observe(el);
    });
</script>
@endpush
