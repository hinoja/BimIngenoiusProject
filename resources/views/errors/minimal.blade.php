@extends('layouts.front')

@section('subtitle') @yield('title') @endsection

@php($isErrorPage = true)

@section('content')
    <section class="page-404">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="content-404">
                        <h2>@yield('code')</h2>
                        <p>@lang('Sorry,') @yield('message')</p>
                        <a class="ot-btn btn-border btn-radius" href="{{ route('front.home') }}">@lang('Back to home')</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="image-404">
                        <img src="{{ asset('assets/front/images/404.png') }}" alt="@lang('Error')">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection