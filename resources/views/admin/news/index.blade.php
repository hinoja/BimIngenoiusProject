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
    <script type="text/javascript">
        // Close news modals
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                $('#deleteNewsModal').modal('hide');
                $('#detailsNewsModal').modal('hide');
                $('#publishNewsModal').modal('hide');
            });
        });

        // Open news modals
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openDeleteModal', () => {
                $('#deleteNewsModal').modal('show');
            });

            Livewire.on('openDetailsModal', () => {
                $('#detailsNewsModal').modal('show');
            });

            Livewire.on('openPublishModal', () => {
                $('#publishNewsModal').modal('show');
            });
        });
    </script>
@endpush

@push('css')
    @livewireStyles()
@endpush
