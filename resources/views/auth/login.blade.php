@extends('layouts.front')

@section('subtitle', __('Login'))

@section('content')

    <div class="page-content">
        <section class="form-info">
            <div class="container">
                <div class="row">
                    <div class="">
                        <div class="contact-form">
                            <h4>@lang('Please enter your login details')</h4>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                                    <label for="email">@lang('Email')</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('Email')" required>
                                    @error('email')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                                    <label for="password">@lang('Password')</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('Password')" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="remember"> @lang('Remember Me')
                                  </label>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="ot-btn btn-color btn-sradius">@lang('Login')</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>        
    </div>

@endsection
