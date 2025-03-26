@extends('layouts.front')

@section('subtitle', __('Request a Quote'))

@push('css')
    @livewireStyles

    <style>
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
            font-size: 14px;
            background-color: #f8f9fa; /* Même couleur que les champs text */
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        textarea.form-control {
            resize: none; /* Désactive le redimensionnement */
        }

        select.form-control {
            appearance: none; /* Supprime le style natif du navigateur */
            /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4z'/%3E%3C/svg%3E"); */
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 10px 10px;
        }

        input[type="file"].form-control {
            padding: 3px; /* Ajuste le padding pour les champs file */
            background-color: #f8f9fa;
        }

        .labelled {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        small {
            font-weight: 650;
        }
    </style>
@endpush

@section('content')

    <div class="page-content">
        <section class="form-info">
            <div class="container">
                <div class="row" style="margin-top: -30px;">
                    {{-- <div class="col-md-4">
                        <div class="contact-info">
                            <h4>@lang('Contact Information')</h4>
                            <p class="text-justify">@lang('Welcome to our Contact Information page! If you have any inquiries or need assistance, feel free to reach out to us. We are here to help you. Below, you’ll find all the details you need to connect with us.')</p>
                            <ul class="none-style">
                                <li><i class="fa fa-home"></i> 379 5th Ave  New York, NYC 10018</li>
                                <br>
                                <li><i class="fa fa-phone"></i> (+1) 96 716 6879</li>
                                <br>
                                <li><i class="fa fa-fax"></i> (+1) 96 716 6879</li>
                                <br>
                                <li><i class="fa fa-envelope-o"></i> contact@site.com</li>
                                <br>
                                <li><i class="fa fa-clock-o"></i> Mon-Fri 09:00 - 17:00 Mon-Fri</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-1"></div> --}}
                    {{-- <div class="justify-content-center"> --}}
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="intro-text text-center">
                                <h4>@lang('Submit Your Project for a Quote')</h4>
                                <p class="text-center h5" style="line-height: 25px;">
                                    @lang('We are excited to help you bring your project to life! Please fill out the form below with as much detail as possible about your project.')
                                    @lang('Our team will review your submission and get back to you with a personalized quote tailored to your needs.')
                                </p>
                            </div>
                        </div>
                    {{-- </div> --}}
                    <div class="col-md-2"></div>
                    @livewire('front.store-quote')
                    <div class="col-md-2"></div>

                    <div class="col-md-1"></div>

                </div>
            </div>
        </section>
        
    </div>

@endsection

@push('js')
    @livewireScripts
    <script type="text/javascript" src="{{ asset('assets/front/js/contact.js')}}"></script>
@endpush