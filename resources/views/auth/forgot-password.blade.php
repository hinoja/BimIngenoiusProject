@extends('layouts.auth')

@section('subtitle', __('Forgot Password'))

@section('content')
    <div class="card-header"><h4>@lang('Forgot Password')</h4></div>

    <div class="card-body">
        <p class="text-dark font-weight-bold">@lang('Fill your email address in this form and we will send you a link to reset your password.')</p>
        @if (session('status'))
            <p class="text-success font-weight-bold">@lang('We have emailed your password reset link!')</p>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">@lang('Email')</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ ! session('status') ? __('Send the link') : __('Resend the link') }}
                </button>
            </div>
        </form>
        <div class="float-right">
            <a href="{{ route('login') }}" class="text-small">@lang('Back to login')</a>
        </div>
    </div>

@endsection