@extends('layouts.front')

@section('subtitle', 'Notre offre clés en main')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center py-5">
        <div class="container position-relative">
            <span class="badge badge-primary mb-3 animate__animated animate__fadeIn">OFFRE CLÉS EN MAIN</span>
            <h1 class="main-title mb-4 animate__animated animate__fadeIn">NOTRE OFFRE CLÉS EN MAIN</h1>
            <div class="title-underline animate__animated animate__fadeIn"></div>
        </div>
    </section>

    <!-- Main Content Section -->
     <!-- Key Offering Section -->
     <section id="key-offering" class="key-offering-section py-6">
        <div class="container">
            <div class="row gx-5 gy-4">
                <!-- Card 1 -->
                <div class="col-lg-6">
                    <div class="card shadow-lg h-100 border-0 hover-lift">
                        <div class="card-body p-5">
                            <h2 class="h4 fw-semibold mb-3 text-primary">Offrez-vous de la sérénité !</h2>
                            <p>Cap Ingelec, en tant que contractant général, maîtrise tous les aspects techniques, logistiques et financiers pour vous garantir un projet clé en main sans souci.</p>
                            <ul class="list-unstyled mt-4">
                                <li class="d-flex align-items-start mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Anticipation des contraintes d’exécution et de sécurité
                                </li>
                                <li class="d-flex align-items-start mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Retour d’expérience et analyse comparative
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Offre PMG pour plus de transparence
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-6">
                    <div class="card shadow-lg h-100 border-0 hover-lift">
                        <div class="card-body p-5">
                            <h2 class="h4 fw-semibold mb-3 text-primary">Nos atouts & bénéfices</h2>
                            <ul class="list-unstyled benefits-grid">
                                <li><i class="fas fa-gem text-warning me-2"></i>Équipe unique de la conception à la réception</li>
                                <li><i class="fas fa-cogs text-warning me-2"></i>Compétences multidisciplinaires</li>
                                <li><i class="fas fa-user-check text-warning me-2"></i>Immersion métier chez le client</li>
                                <li><i class="fas fa-chart-line text-warning me-2"></i>Performance financière optimisée</li>
                                <li><i class="fas fa-hard-hat text-warning me-2"></i>Expertise en site occupé</li>
                                <li><i class="fas fa-sync-alt text-warning me-2"></i>Intégration System & Process</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Quality Column -->
                <div class="col-md-3">
                    <div class="feature-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fas fa-thumbs-up fa-2x"></i>
                        </div>
                        <h3>Qualité</h3>
                        <ul class="feature-list">
                            <li>Une qualité de finition élevée et sans réserve majeure</li>
                            <li>Un commissioning anticipé et réalisé sans difficulté</li>
                            <li>Un service client personnalisé avec une adaptation</li>
                        </ul>
                    </div>
                </div>

                <!-- Cost Column -->
                <div class="col-md-3">
                    <div class="feature-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h3>Coût</h3>
                        <ul class="feature-list">
                            <li>Value engineering tout au long du projet afin d'optimiser le coût de l'ouvrage</li>
                            <li>Prix transparents</li>
                            <li>Contrat avec Prix Maximum Garanti (PMG)</li>
                        </ul>
                    </div>
                </div>

                <!-- Time Column -->
                <div class="col-md-3">
                    <div class="feature-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <h3>Délais</h3>
                        <ul class="feature-list">
                            <li>Engagement sur un délai global dès la phase de conception</li>
                            <li>Pilotage du projet au quotidien</li>
                        </ul>
                    </div>
                </div>

                <!-- Insurance Column -->
                <div class="col-md-3">
                    <div class="feature-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h3>Assurance</h3>
                        <ul class="feature-list">
                            <li>Couverture très performante incluse de base dans nos projets</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge badge-primary mb-3 animate__animated animate__fadeIn">NOTRE APPROCHE</span>
                <h2 class="section-title mb-4 animate__animated animate__fadeIn">De la conception à la réalisation</h2>
            </div>
            <div class="row g-4 position-relative">
                <!-- Timeline Connector -->
                <div class="timeline-connector"></div>
                <!-- Design Process -->
                <div class="col-md-6">
                    <div class="process-card h-100 animate__animated animate__fadeInLeft">
                        <div class="process-header mb-4 d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="fas fa-drafting-compass fa-2x"></i>
                            </div>
                            <h3>LA CONCEPTION</h3>
                        </div>
                        <div class="process-content">
                            <p>Nous pouvons réaliser vos projets sur la base d’un simple descriptif technique. Après la réalisation d’un avant-projet, nous nous engageons sur un planning et un budget pour une réalisation clés en main.</p>
                            <ul class="process-list">
                                <li>Anticipation des démarches administratives et environnementales</li>
                                <li>Gestion des permis de construire</li>
                                <li>Identification des économies d’énergie</li>
                                <li>Solutions innovantes pour la réduction de l’empreinte environnementale</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Realization Process -->
                <div class="col-md-6">
                    <div class="process-card h-100 animate__animated animate__fadeInRight">
                        <div class="process-header mb-4 d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="fas fa-hard-hat fa-2x"></i>
                            </div>
                            <h3>LA RÉALISATION</h3>
                        </div>
                        <div class="process-content">
                            <p>Nous intégrons dans notre organisation une gestion à 360° du chantier. Un Directeur de projets a autorité sur l’ensemble des lots du projet afin de garantir une cohérence globale et une fluidité dans les remontées d’information à la Maîtrise d’Ouvrage.</p>
                            <ul class="process-list">
                                <li>Coordination globale de tous les acteurs</li>
                                <li>Gestion intégrée du planning</li>
                                <li>Priorité à la sécurité et à la santé sur les chantiers</li>
                                <li>Maintien quotidien de la propreté par des sociétés spécialisées</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        /* Variables */
        :root {
            --primary-color: #00AEEF;
            --secondary-color: #2A2E45;
            --accent-color: #D4A017;
            --light-bg: #F8F9FA;
            --dark-text: #2A2E45;
            --light-text: #F8F9FA;
        }

        /* Typography */
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.8;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(42, 46, 69, 0.95), rgba(42, 46, 69, 0.85)), var(--light-bg);
            position: relative;
            overflow: hidden;
        }

        .main-title {
            color: var(--light-text);
            font-weight: 800;
            font-size: 2.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .title-underline {
            width: 150px;
            height: 5px;
            background: var(--primary-color);
            margin: 0 auto;
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .hero-section:hover .title-underline {
            width: 200px;
        }

        .badge-primary {
            background-color: var(--primary-color);
            color: var(--light-text);
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            border-radius: 25px;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Main Content Section */
        .dark-section {
            background-color: var(--secondary-color);
            color: var(--light-text);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--accent-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dark-section:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .light-section {
            background-color: #E8F4F9;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--accent-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .light-section:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 12px;
            color: inherit;
            transition: color 0.3s ease;
        }

        .dark-section .section-title:hover,
        .light-section .section-title:hover {
            color: var(--primary-color);
        }

        /* Benefits List Styling */
        .benefits-list {
            list-style: none;
            padding-left: 0;
        }

        .benefits-list li {
            padding: 15px 0;
            position: relative;
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--dark-text);
            transition: color 0.3s ease;
        }

        .benefits-list li:hover {
            color: var(--primary-color);
        }

        .benefits-list li i {
            color: var(--primary-color);
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .benefits-list li:hover i {
            transform: scale(1.2);
        }

        /* Feature Cards Styling */
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            height: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--accent-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .feature-card:hover .icon-box {
            background: var(--primary-color);
            color: var(--light-text);
            transform: scale(1.1);
        }

        .feature-list {
            list-style: none;
            padding-left: 0;
            text-align: left;
        }

        .feature-list li {
            margin-bottom: 12px;
            padding-left: 25px;
            position: relative;
            font-size: 1rem;
        }

        .feature-list li:before {
            content: "•";
            color: var(--primary-color);
            position: absolute;
            left: 0;
            font-size: 1.5rem;
        }

        /* Process Section */
        .process-section {
            position: relative;
        }

        .timeline-connector {
            position: absolute;
            top: 40%;
            left: 50%;
            width: 2px;
            height: 60%;
            background: var(--primary-color);
            transform: translateY(-50%);
            z-index: 0;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .process-section:hover .timeline-connector {
            opacity: 1;
        }

        .process-card {
            background-color: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
            border: 1px solid var(--accent-color);
        }

        .process-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .process-header {
            position: relative;
        }

        .process-header h3 {
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 1.75rem;
            text-transform: uppercase;
        }

        .process-header .icon-box {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            color: var(--light-text);
            transition: transform 0.3s ease;
        }

        .process-card:hover .process-header .icon-box {
            transform: rotate(360deg);
        }

        .process-list {
            list-style: none;
            padding-left: 0;
            margin-top: 1.5rem;
        }

        .process-list li {
            padding: 12px 0;
            padding-left: 30px;
            position: relative;
            font-size: 1rem;
            line-height: 1.7;
        }

        .process-list li:before {
            content: "→";
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        /* Animations */
        .animate__animated {
            animation-duration: 1.2s;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.25rem;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .timeline-connector {
                display: none;
            }

            .process-card {
                margin-bottom: 2.5rem;
            }

            .icon-box {
                width: 60px;
                height: 60px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Animation on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.dark-section, .light-section, .feature-card, .process-card');
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    if (elementTop < windowHeight * 0.85) {
                        element.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Initial check
        });
    </script>
@endpush
