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

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Afficher les messages flash avec SweetAlert2
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{{ session('error') }}",
                });
            @endif
        });
    </script>
    @livewireScripts()
@endpush

@push('css')
    @livewireStyles()
@endpush


