@extends('layouts.back')

@section('subtitle', __('News List'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-admin.section-header :title="__('News List')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-news')
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

    @livewireScripts()
 
@endpush

@push('css')
    @livewireStyles()
@endpush
