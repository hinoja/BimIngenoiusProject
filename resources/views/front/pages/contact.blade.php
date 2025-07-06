@extends('layouts.front')

@section('subtitle', __('Contact'))
@section('description', __('We are here to help you. Please do not hesitate to contact us if you have any questions or require assistance.'))

@push('css')
    @livewireStyles
    <style>
        /* Variables CSS pour la cohérence */
        :root {
            --primary-color: #b3b158;
            --secondary-color: #764ba2;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Form Info Section */
        .form-info {
            padding: 4rem 0;
            background: var(--bg-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .form-info .container {
            max-width: 1200px;
        }

        /* Contact Info */
        .contact-info {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            padding: 2rem;
            animation: fadeInUp 0.6s ease-out forwards;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .contact-info h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .contact-info h4::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background: var(--primary-color);
            margin-top: 0.5rem;
        }

        .contact-info p {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .contact-info .none-style {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info .none-style li {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: calc(0.1s * var(--index));
        }

        .contact-info .none-style li i {
            font-size: 1.5rem;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .contact-info .none-style li:hover {
            color: var(--primary-color);
        }

        .contact-info .none-style li:hover i {
            transform: translateX(4px);
        }

        /* Contact Form */
        .contact-form {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            padding: 2rem;
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: 0.2s;
            height: 100%;
        }

        .contact-form h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .contact-form h4::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background: var(--primary-color);
            margin-top: 0.5rem;
        }

        .contact-form .form-group {
            margin-bottom: 1.5rem;
        }

        .contact-form .form-control {
            font-size: 1rem;
            color: var(--text-dark);
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .contact-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(179, 177, 88, 0.2);
            outline: none;
        }

        .contact-form .form-control::placeholder {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .contact-form textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .contact-form .invalid-feedback {
            font-size: 0.85rem;
            color: #dc3545;
            margin-top: 0.25rem;
            font-weight: 600;
        }

        .contact-form .alert-success {
            background: #d4edda;
            color: #155724;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.5s ease-out;
            font-size: 0.95rem;
        }

        .contact-form .ot-btn {
            background: var(--primary-color);
            color: var(--bg-white);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .contact-form .ot-btn:hover {
            background: var(--secondary-color);
            transform: scale(1.05);
        }

        .contact-form .ot-btn:disabled {
            background: #e2e8f0;
            cursor: not-allowed;
        }

        .contact-form .spinner-border {
            width: 1.2rem;
            height: 1.2rem;
            border-width: 2px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .form-info {
                padding: 3rem 0;
            }

            .contact-info,
            .contact-form {
                margin-bottom: 2rem;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .form-info .container {
                padding: 0 1rem;
            }

            .contact-info,
            .contact-form {
                padding: 1.5rem;
            }

            .contact-info h4,
            .contact-form h4 {
                font-size: 1.5rem;
            }

            .contact-info p {
                font-size: 0.95rem;
            }

            .contact-info .none-style li {
                font-size: 0.95rem;
                margin-bottom: 1.2rem;
            }

            .contact-info .none-style li i {
                font-size: 1.3rem;
            }

            .contact-form .form-control {
                font-size: 0.95rem;
                padding: 0.65rem 0.9rem;
            }

            .contact-form .form-control::placeholder {
                font-size: 0.9rem;
            }

            .contact-form .ot-btn {
                font-size: 0.95rem;
                padding: 0.65rem 1.2rem;
            }

            .contact-form .alert-success {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .form-info {
                padding: 2rem 0;
            }

            .contact-info h4,
            .contact-form h4 {
                font-size: 1.25rem;
            }

            .contact-info p {
                font-size: 0.9rem;
            }

            .contact-info .none-style li {
                font-size: 0.9rem;
                gap: 0.75rem;
            }

            .contact-info .none-style li i {
                font-size: 1.2rem;
            }

            .contact-form .form-control {
                font-size: 0.9rem;
            }

            .contact-form .form-control::placeholder {
                font-size: 0.85rem;
            }

            .contact-form .ot-btn {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <section class="form-info">
            <div class="container">
                <div class="row align-items-stretch">
                    <div class="col-md-5 col-lg-4">
                        <div class="contact-info">
                            <h4>@lang('Contact Information')</h4>
                            <p class="text-justify">@lang('Welcome to our Contact Information page! If you have any inquiries or need assistance, feel free to reach out to us. We are here to help you. Below, you’ll find all the details you need to connect with us.')</p>
                            <ul class="none-style">
                                <li style="--index: 1"><i class="fa fa-home"></i> 379 5th Ave New York, NYC 10018</li>
                                <li style="--index: 2"><i class="fa fa-phone"></i> (+1) 96 716 6879</li>
                                <li style="--index: 3"><i class="fa fa-fax"></i> (+1) 96 716 6879</li>
                                <li style="--index: 4"><i class="fas fa-envelope"></i> contact@site.com</li>
                                <li style="--index: 5"><i class="fa fa-clock-o"></i> Mon-Fri 09:00 - 17:00</li>
                            </ul>
                        </div>
                    </div>
                   @livewire('front.store-contact')
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    @livewireScripts
    <script type="text/javascript" src="{{ asset('assets/front/js/contact.js') }}"></script>
@endpush

