@extends('layouts.back')

@section('subtitle', __('Create Newsletter'))

@section('content')
    <x-admin.section-header :title="__('Create Newsletter')" :previousTitle="__('Newsletters')" :previousRouteName="route('admin.newsletters.index')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.newsletter-form')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
@endpush

@push('css')
    @livewireStyles()
@endpush