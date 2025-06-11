@extends('layouts.back')

@section('subtitle', __('Edit Newsletter'))

@section('content')
    <x-admin.section-header :title="__('Edit Newsletter')" :previousTitle="__('Newsletters')" :previousRouteName="route('admin.newsletters.index')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.newsletter-form', ['newsletterId' => $newsletter->id])
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
@endpush

@push('css')
    @livewireStyles()
@endpush