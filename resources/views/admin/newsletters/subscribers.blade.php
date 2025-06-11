@extends('layouts.back')

@section('subtitle', __('Newsletter Subscribers'))

@section('content')
    <x-admin.section-header :title="__('Newsletter Subscribers')" :previousTitle="__('Newsletters')" :previousRouteName="route('admin.newsletters.index')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-subscribers')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', (modalId) => {
                let modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            });
            
            Livewire.on('closeModal', (modalId) => {
                let modalElement = document.getElementById(modalId);
                let modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            });
        });
    </script>
@endpush

@push('css')
    @livewireStyles()
@endpush