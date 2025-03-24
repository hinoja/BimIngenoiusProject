@extends('layouts.back')

@section('subtitle', __('Add User'))

@section('content')
    <x-admin.section-header :title="__('Add New User')" :previousTitle="__('Users list')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-user-plus mr-2"></i>@lang('New User Form')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('Name')</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" placeholder="micheal" value="{{ old('name') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('Email')</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="email" placeholder="xyz@mail.com"   name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('Role')</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('Password')</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">@lang('Confirm Password')</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password" name="password_confirmation"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fas fa-save mr-2"></i>@lang('Create User')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
