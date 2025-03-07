@extends('layouts.front')

@section('subtitle', __('Contact'))

@push('css')
    @livewireStyles
@endpush

@section('content')

    <div class="page-content">
        <section class="form-info">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="contact-info">
                            <h4>@lang('Contact Information')</h4>
                            <p>@lang('Welcome to our Contact Information page! If you have any inquiries or need assistance, feel free to reach out to us. We are here to help you. Below, you’ll find all the details you need to connect with us.')</p>
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

                    @livewire('front.store-contact')

                </div>
            </div>
        </section>

        <section>
            <div id="google_map"></div>
        </section>
        
    </div>

@endsection
@push('js')
    @livewireScripts
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/contact.js')}}"></script>
@endpush