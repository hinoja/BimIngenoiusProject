@extends('layouts.back')

@section('subtitle', __('Tags list'))

@section('content')
    <x-admin.section-header :title="__('Tags list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        @livewire('admin.manage-tag')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('css')
    @livewireStyles()
@endpush


