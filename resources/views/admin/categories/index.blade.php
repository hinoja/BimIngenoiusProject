@extends('layouts.back')

@section('subtitle', __('Categories list'))

@section('content')
    <x-admin.section-header :title="__('Categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Add Category Form -->
                    <div class="col-lg-5 col-md-6 col-xs-12">
                        <div class="card border-0 rounded-lg">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="card-header bg-white border-bottom py-3">
                                    <h4 class="card-title mb-0">@lang('Add a new Category')</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="form-group">
                                        <label for="fr_name">@lang('French Name')</label>
                                        <input type="text" name="fr_name"
                                            class="form-control @error('fr_name') is-invalid @enderror" id="fr_name"
                                            placeholder="@lang('Enter the French name')" value="{{ old('fr_name') }}">
                                        @error('fr_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="en_name">@lang('English Name')</label>
                                        <input type="text" name="en_name" value="{{ old('en_name') }}"
                                            class="form-control @error('en_name') is-invalid @enderror" id="en_name"
                                            placeholder="@lang('Enter the English name')">
                                        @error('en_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fr_description">@lang('Enter the French description')</label>
                                        <input id="fr_description_input" value="{{ old('fr_description') }}" type="hidden"
                                            name="fr_description">
                                        <trix-editor input="fr_description_input" required></trix-editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="en_description">@lang('Enter the English description')</label>
                                        <input id="en_description_input" value="{{ old('en_description') }}" type="hidden"
                                            name="en_description">
                                        <trix-editor input="en_description_input" required></trix-editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">@lang('Image')</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top py-3">
                                    <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                        <span wire:loading.remove>@lang('Add')</span>
                                        <span wire:loading>@lang('Processing...')</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6 col-12">
                        @livewire('admin.manage-categories')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    @livewireStyles()
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }

        trix-editor {
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 0.25rem;
            border-color: #ced4da;
        }

        trix-toolbar {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Initialisation des éditeurs Trix
        document.addEventListener('trix-initialize', function() {
            // Personnalisation des éditeurs Trix si nécessaire
            const trixEditors = document.querySelectorAll('trix-editor');
            trixEditors.forEach(editor => {
                // Vous pouvez ajouter des personnalisations ici
            });
        });

        // Gestion des pièces jointes (désactiver si nécessaire)
        document.addEventListener('trix-file-accept', function(e) {
            // Décommentez pour désactiver les pièces jointes
            e.preventDefault();
        });
    </script>
@endpush
