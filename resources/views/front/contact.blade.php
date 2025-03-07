@extends('layouts.front')

@section('subtitle', __('Contact'))

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

                    <div class="col-md-8">
                        <div class="contact-form">
                            <h4>@lang('Leave us a message')</h4>
                            {{-- @if ($errors()->any())
                                <div class="error text-align-center" id="err-form">There was a problem validating the form please check!</div>
                            @endif --}}
                            <form action="" method="POST" class="comment-form">
                                @csrf
                                @method('POST')
                                <p class="">
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" placeholder="@lang('Your Name')" required>
                                    @error('name')
                                        <span class="error" id="err-name">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="">
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" placeholder="@lang('Your Email')" required>
                                    @error('email')
                                        <span class="error" id="err-email">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="col-8">
                                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror" placeholder="@lang('Your Phone Number')" required>
                                    @error('phone')
                                        <span class="error" id="err-phone">{{ $message }}</span>
                                    @enderror
                                </p>
                                <p class="comment-form-comment">
                                    <textarea id="message" name="message" placeholder="@lang('Your Message')" class="@error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="error" id="err-message">{{ $message }}</span>
                                    @enderror
                                </p>
                                <div class="text-right">
                                    <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit ot-btn btn-color" value="@lang('Send Message')"></p>
                                </div>                        			
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section>
            <div id="google_map"></div>
        </section>
        
    </div>

@endsection
@push('js')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/contact.js')}}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/front/js/custom-contact.js') }}"></script>  --}}
@endpush