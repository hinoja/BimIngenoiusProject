@extends('layouts.front')

@section('subtitle', __('Sign in'))

@section('content')

<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">@lang('Sign in')</h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="{{ route('front.home') }}" title="Construction" rel="home" class="trail-begin">@lang('Home')</a>
                        <span class="sep">/</span>
                        <span class="trail-end">@lang('Sign in')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <section class="wprt-section">
                        <div class="container">
                            <div class="row">
                                {{-- <div class="col-md-12">
                                    <h2 class="text-center margin-bottom-20">GET IN TOUCH WITH US</h2>
                                    <div class="wprt-lines style-2 custom-1">
                                        <div class="line-1"></div>
                                    </div>

                                    <div class="wprt-spacer" data-desktop="36" data-mobi="30" data-smobi="30"></div>

                                    <p class="wprt-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet iaculis elit. Nam semper ut arcu non placerat. Praesent nibh massa varius.</p>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="30" data-smobi="30"></div>
                                </div><!-- /.col-md-12 --> --}}

                                <div class="wprt-spacer" data-desktop="40" data-mobi="30" data-smobi="30"></div>

                                <div class="col-md-8">
                                    <form class="wprt-contact-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="inner">
                                            <div class="input-wrap">
                                                <input type="email" value="{{ old('email') }}" tabindex="1" placeholder="Email *" name="email" id="email" required>
                                                @error('email')
                                                    <label for="message" class="error" style="display: block;">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="input-wrap">
                                                <input type="text" tabindex="2" placeholder="@lang('Password') *" name="password" id="password" required>
                                                @error('password')
                                                    <label for="message" class="error" style="display: block;">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="input-wrap">
                                                <div class="right-side">
                                                    <input type="checkbox" tabindex="3" name="remember" id="remember-me">
                                                    <label class="custom-control-label" for="remember-me">@lang('Remember Me')</label>
                                                </div>
                                            </div>
                                            <div class="send-wrap">
                                                <input type="submit" value="@lang('Sign in')" id="submit" name="submit" class="submit">
                                            </div>
                                        </div>
                                    </form><!-- /.wprt-contact-form -->
                                </div><!-- /.col-md-8 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="100" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
