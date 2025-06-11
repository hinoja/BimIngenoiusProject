@extends('layouts.back')

@section('subtitle', __('Newsletters'))

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-admin.section-header :title="__('Newsletters')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-newsletters')
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Gérer les alertes
        Livewire.on('alert', (data) => {
            // Utiliser SweetAlert2 ou une autre bibliothèque d'alerte
            Swal.fire({
                icon: data.type,
                title: data.type === 'success' ? 'Succès!' : (data.type === 'error' ? 'Erreur!' : 'Attention!'),
                text: data.message,
                confirmButtonText: 'OK'
            });
        });

        // Fermer le modal
        Livewire.on('hideModal', (modalId) => {
            const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
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

