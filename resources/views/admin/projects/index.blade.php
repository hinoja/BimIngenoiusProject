@extends('layouts.back')

@section('subtitle', __('Projects list'))

@section('content')

    <x-admin.section-header :title="__('Projects list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">

            @livewire('admin.manage-projets')
        </div>
    </div>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireScripts()
@endpush

@push('css')
    @livewireStyles()
@endpush
