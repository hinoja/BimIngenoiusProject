@extends('layouts.front')

@section('subtitle', __('Our Skills and Expertise'))

@push('css')
    <style>
        .top-image {
            overflow: hidden;
            position: relative;
            padding: 0;
        }
        .top-image .img-fluid {
            width: 100%;
            max-width: 1100px;
            height: 460px;
            object-fit: cover;
            margin: 0 auto;
            display: block;
            transition: transform 3.5s cubic-bezier(.23,1.02,.32,1), box-shadow 0.5s;
            will-change: transform;
        }
        .top-image.in-view .img-fluid,
        .top-image:hover .img-fluid {
            transform: scale(1.08);
            box-shadow: 0 16px 48px rgba(0,0,0,0.18);
        }

        /* Custom list item style */
        .bim-skills-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 10px;
        }
        .bim-skill-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            font-size: 1.08em;
            margin-top: 10px;
        }
        .bim-skill-icon {
            flex-shrink: 0;
            width: 1.5em;
            text-align: center;
        }
        .bim-skill-text {
            flex: 1;
        }
    </style>
@endpush

@section('content')

    <div class="container" style="margin-top: 25px;">
        <section class="top-image">
            <img src="{{ asset('assets/front/images/home-slider2/slide2.jpg') }}" alt="{{ config('app.name') }}" class="img-fluid">
        </section>

        <section class="global-desc" style="margin-top: 55px; margin-bottom: 25px;">
            <div class="text-center">
                <h3>@lang('Our Skills and Expertise')</h3>
                <hr style="width: 100px; height: 2px; background-color: #807c7c; margin: 0 auto;">
                <div class="text-justify" style="margin-top: 15px;">
                    <p>@lang('As an international engineering and construction group, we specialise in the design and management of complex buildings. We mainly work on a') <a href="{{ route('front.turnkey') }}" style="color: #b3b158; font-weight: bold;">@lang('turnkey')</a> @lang('basis on construction, renovation and extension projects, particularly in the data centre, industrial and energy sectors.')</p>
                    <p>@lang("Our teams have recognised technical expertise, which is essential for taking into account all of our clients' operational requirements and constraints, particularly to ensure the operational continuity of the sites on which we work.")</p>
                </div>
            </div>
        </section>
    </div>

    {{-- <section class="shadow-section">
        <div class="container">
            <div class="box-shadow"></div>
        </div>
    </section> --}}

    <section class="features-about">
        <div class="parallax parallax-hourse">
            <div class="container">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="features">
                            <div class="top-img text-center"><img src="{{ asset('assets/front/images/features2.png') }}" alt=""></div>
                            <h4 class="text-center">@lang('A Project Management')</h4>
                            <h6 class="text-center">@lang('Effective')</h6>
                            <p class="text-justify">@lang('Our in-depth technical expertise is complemented by a bespoke project management approach, enabling us to carry out each project in a structured and controlled manner. We prioritise thorough understanding of requirements, rigorous organisation and planning, value engineering, BIM (Building Information Modeling) use, coordination and risk analysis, to optimise each project and guarantee safety.')</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features">
                            <div class="top-img text-center"><img src="{{ asset('assets/front/images/features3.png') }}" alt=""></div>
                            <h4 class="text-center">@lang('Energy Efficiency')</h4>
                            <h6 class="text-center">@lang('A priority')</h6>
                            <p class="text-justify">@lang('We have always placed great importance on integrating highly energy-efficient solutions. Thanks to our in-depth expertise and advanced thermal simulation tools, we optimise our designs to minimise energy consumption. Our commitment to energy performance is evident from the outset of every project and continues until its completion.')</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features">
                            <div class="top-img text-center"><img src="{{ asset('assets/front/images/features1.png') }}" alt=""></div>
                            <h4 class="text-center">@lang('An assurance of Commitment ')</h4>
                            <h6 class="text-center">@lang('Always')</h6>
                            <p class="text-justify">@lang('We are committed to supporting our customers until their projects are completed, beyond the performance of the technical solutions we offer. This commitment is reflected in our performance guarantees, which are measured upon acceptance of the works. This notion of responsibility is particularly relevant in the context of turnkey projects, for which we oversee the entire design and implementation process and offer guarantees on technical aspects, pricing and deadlines.')</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 55px; margin-bottom: 25px;">
        <section class="global-desc">
            <div class="text-center">
                <h3>@lang('BIM: A SYSTEMATIC AND INTEGRATED PART OF OUR PROJECT APPROACH')</h3>
                <hr style="width: 100px; height: 2px; background-color: #807c7c; margin: 0 auto;">
                <div class="text-justify" style="margin-top: 15px;">
                    <p>@lang("In order to implement our BIM-integrated project processes, we have set up a BIM-dedicated network infrastructure and trained our staff in the use of building information production tools. We have also developed our BIM management and synthesis skills, enabling us to understand BIM projects in their entirety and propose collaboration and information control solutions tailored to each project's needs.")</p>
                    <p>@lang("The growth of our turnkey projects has reinforced the importance we place on digital mock-ups. We have appointed a BIM Manager to lead our technical teams in making the most of this technology, which facilitates collaboration and optimises the performance of projects we propose to our customers.")</p>
                </div>
            </div>
        </section>

        <section class="bim-desc" style="margin-top: 25px;">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/front/images/img-box3.jpg') }}" alt="">
                </div>
                <div class="col-md-6">
                    <h4>@lang('BIM for engineering')</h4>
                    <div class="text-justify">
                        <p>
                            @lang("At every stage of our process, the results are integrated into our digital models : calculs énergétiques, dimensionnement du chauffage, de la climatisation et de la ventilation, implantation des équipements, gestion des alarmes et de la sécurité, etc.")
                        </p>
                        <p>
                            @lang("The 3D models we present to our clients represent only a small part of what BIM offers. This tool enables us to manage and track the flow of information throughout the entire project lifecycle, from design to operation.")
                        </p>
                        <p>
                            @lang("BIM greatly enhances communication between all internal and external stakeholders. It accelerates and secures data transmission, allowing us to go into the finest details of each site with reliability and efficiency.")
                        </p>
                    </div>
                    <h4 style="margin-top: 25px;">@lang('Our skills')</h4>
                    <div class="bim-skills-list" style="margin-top: 18px;">
                        <div class="bim-skill-item">
                            <i class="fa fa-cube bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('Project scoping and BIM strategy definition')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-tasks bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('BIM Management')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-cubes bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('All trades modelling')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-project-diagram bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('BIM coordination and synthesis')</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="toolsw" style="margin-top: 55px;">
            <div class="row">
                <div class="col-md-6">
                    <h4>@lang('Tools and Software')</h4>
                    <div class="text-justify">
                        <p>
                            @lang("We have all the tools needed to produce detailed 3D models. Our modellers' workstations are equipped with high-powered processors and professional graphics cards, enabling them to:")
                        </p>
                    </div>
                    <div class="bim-skills-list" style="font-size: 1.20rem;">
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('REVIT digital models')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('Realistic 3D rendering and virtual reality with ENSCAPE')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('NAVISWORKS synthesis models')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('Processing and assembling point clouds from 3D scans with RECAP PRO')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('DYNAMO script execution for automatic processing of model data')</span>
                        </div>
                        <div class="bim-skill-item">
                            <i class="fa fa-circle bim-skill-icon" aria-hidden="true"></i>
                            <span class="bim-skill-text">@lang('Multi-site collaboration on a secure private network via Revit Servers')</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('assets/front/images/img-box1.jpg') }}" alt="" style="height: 400px; object-fit: cover;">
                </div>
            </div>
        </section>
    </div>

    <section class="action-image features-about">
        <div class="container">
            <div class="dark" style="margin: 50px auto;">
                <h3 class="text-center">@lang('The most successful companies have systems that are centred on Lean Management')</h3>
                <div class="row text-justify" style="line-height: 30px; font-weight: 600;">
                    <div class="col-md-6">
                        @lang("The Lean Management approach focuses on eliminating non-value-added steps and promoting a culture of continuous improvement within companies. This management system has two main goals: to increase value for customers and to improve company performance. Our teams include engineers trained in 'GREEN BELT LEAN MANAGEMENT', enabling them to act as 'animators' on work sites or in simple workshops for the continuous improvement of flows, processes or storage in accordance with the NFX 06 091 standard.")
                    </div>
                    <div class="col-md-6">
                        @lang("Our objective is to provide comprehensive support to our customers. The LEAN approach enables us to collaborate with our clients' process teams to optimise and enhance their operations (staff, machinery, storage, etc.). Our engineering expertise combined with LEAN management methods enables us to guarantee our customers significant savings on building costs, production costs, and operating costs.")
                    </div>
                </div>
            </div>
        </div>
    </section>

    
        @include('includes.front.action-about')

@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-about.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/smk-accordion.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var section = document.querySelector('.top-image');
            if (!section) return;

            // Intersection Observer pour effet au scroll
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            section.classList.add('in-view');
                        } else {
                            section.classList.remove('in-view');
                        }
                    });
                }, { threshold: 0.4 });
                observer.observe(section);
            } else {
                // Fallback : zoom au chargement si IntersectionObserver non supporté
                section.classList.add('in-view');
            }
        });
        </script>
@endpush