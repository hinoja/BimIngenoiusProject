<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('subtitle') - {{ config('app.name') }}</title>
  
  <link href="{{ asset('assets/favicon.png') }}" rel="icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/auth/bootstrap.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
</head>

<body>
  
  <div id="app">
    <section class="section">
      <div class="container mt-1">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand mb-3">
                    <img src="{{ asset('assets/front/images/logos/logo.png')}}" alt="{{ config('app.name') }}" width="150" class="">
                </div>
                <div class="card card-danger">
                    @yield('content')
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html>