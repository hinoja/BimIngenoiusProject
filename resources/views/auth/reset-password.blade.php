@extends('layouts.auth')

@section('subtitle', __('Reset Password'))

@section('content')

    <div class="card-header"><h4>@lang('Reset Password')</h4></div>
    <div class="card-body">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">
            {{-- Email --}}
            <div class="form-group">
                <label for="email">@lang('Email')</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}" tabindex="1" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Password --}}
            <div class="form-group">
                <label for="password" class="control-label">@lang('Password')</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation" class="control-label">@lang('Confirm Password')</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">@lang('Reset Password')</button>
            </div>

            <div class="float-left">
                <a href="{{ route('front.home') }}" class="text-small">@lang('Back to home')</a>
            </div>
        </form>
    </div>

@endsection