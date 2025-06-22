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
    <script>
        document.addEventListener('trix-change', function(event) {
            let input = event.target.inputElement;
            if (input && input.id === 'fr_description_input') {
                Livewire.find('{{ $_instance->id ?? '' }}').set('fr_description', input.value);
            }
            if (input && input.id === 'en_description_input') {
                Livewire.find('{{ $_instance->id ?? '' }}').set('en_description', input.value);
            }
        });

        // Désactiver l'upload de fichiers dans Trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush

@push('css')
    @livewireStyles()
@endpush
