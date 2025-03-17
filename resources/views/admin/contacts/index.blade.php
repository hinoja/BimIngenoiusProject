@extends('layouts.back')

@section('subtitle', __('Contacts list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <x-livewire-alert::scripts /> --}}

    <x-admin.section-header :title="__('Contacts list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-messages')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    <script type="text/javascript">
        // close message  modal
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                // code
                $('#MessageModal').modal('hide');
                $('#InputRepyForm').modal('hide');
            });
        });


        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', () => {
                // code
                $('#MessageModal').modal('show');

            });
        });
    </script>
@endpush
@push('css')
    @livewireStyles()
@endpush
