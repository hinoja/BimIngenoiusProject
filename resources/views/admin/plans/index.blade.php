@extends('layouts.back')

@section('subtitle', __('Plans list'))

@section('content')
    <x-admin.section-header :title="__('Plans list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-plans')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    <script>
        Livewire.on('closeModal', () => {
            $('#deletePlanModal').modal('hide');
            $('#detailsPlanModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });
    </script>
@endpush

@push('css')
    @livewireStyles()
@endpush
