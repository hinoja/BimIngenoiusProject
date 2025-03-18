@extends('layouts.auth')

@section('subtitle', __('Login'))

@section('content')
    <div class="card-header text-center"><h3>@lang('Login')</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}" >
                <label for="email" class="control-label">@lang('Email')</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                <label for="password" class="control-label">@lang('Password')</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">@lang('Remember Me')</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">@lang('Log in')</button>
            </div>
        </form>

        <div class="float-right">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-small">@lang('Forgot your password?')</a>
            @endif
        </div>
        <div class="float-left">
            <a href="{{ route('front.home') }}" class="text-small">@lang('Back to home')</a>
        </div>
    </div>

@endsection
