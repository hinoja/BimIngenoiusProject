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
                                    <!-- French Name -->
                                    <div class="form-group">
                                        <label for="fr_name">@lang('French Name') <span class="text-danger">*</span></label>
                                        <input type="text" name="fr_name"
                                            class="form-control @error('fr_name') is-invalid @enderror" id="fr_name"
                                            placeholder="@lang('Enter the French name')" value="{{ old('fr_name') }}" required>
                                        @error('fr_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- English Name -->
                                    <div class="form-group">
                                        <label for="en_name">@lang('English Name') <span class="text-danger">*</span></label>
                                        <input type="text" name="en_name" value="{{ old('en_name') }}"
                                            class="form-control @error('en_name') is-invalid @enderror" id="en_name"
                                            placeholder="@lang('Enter the English name')" required>
                                        @error('en_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- French Description -->
                                    <div class="form-group">
                                        <label for="fr_description_input">@lang('French Description') <span
                                                class="text-danger">*</span></label>
                                        <div class="trix-container @error('fr_description') trix-error @enderror">
                                            <input id="fr_description_input" value="{{ old('fr_description') }}"
                                                type="hidden" name="fr_description" required>
                                            <trix-editor input="fr_description_input" placeholder="@lang('Enter the French description')"
                                                class="@error('fr_description') is-invalid @enderror"
                                                data-field="fr_description"></trix-editor>
                                        </div>
                                        @error('fr_description')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                        <div class="trix-validation-error" id="fr_description_error" style="display: none;">
                                            <small class="text-danger">@lang('French description is required')</small>
                                        </div>
                                    </div>

                                    <!-- English Description -->
                                    <div class="form-group">
                                        <label for="en_description_input">@lang('English Description') <span
                                                class="text-danger">*</span></label>
                                        <div class="trix-container @error('en_description') trix-error @enderror">
                                            <input id="en_description_input" value="{{ old('en_description') }}"
                                                type="hidden" name="en_description" required>
                                            <trix-editor input="en_description_input" placeholder="@lang('Enter the English description')"
                                                class="@error('en_description') is-invalid @enderror"
                                                data-field="en_description"></trix-editor>
                                        </div>
                                        @error('en_description')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                        <div class="trix-validation-error" id="en_description_error" style="display: none;">
                                            <small class="text-danger">@lang('English description is required')</small>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="form-group">
                                        <label for="image">@lang('Image')</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="image"
                                            accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="image-preview-container">
                                            <img id="image-preview" class="image-preview" alt="Image preview">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top py-3">
                                    <button type="submit" class="btn btn-primary btn-block" id="submit-btn">
                                        <span class="submit-text">@lang('Add Category')</span>
                                        <span class="submit-loading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> @lang('Processing...')
                                        </span>
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
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            padding: 5px;
        }

        .trix-container {
            position: relative;
        }

        .trix-container.trix-error trix-editor {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .trix-container.trix-error trix-toolbar {}

        trix-editor {
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        trix-editor:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        trix-editor.is-invalid {
            padding-right: calc(1.5em + 0.75rem);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        trix-toolbar {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            border: 1px solid #ced4da;
            border-bottom: none;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .invalid-feedback {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .invalid-feedback.d-block {
            display: block !important;
        }

        .trix-validation-error {
            margin-top: 0.25rem;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .submit-loading .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Améliorer l'apparence des erreurs de validation */
        .alert-validation {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.querySelector('.submit-text');
            const submitLoading = document.querySelector('.submit-loading');
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            // Gestion de la prévisualisation d'image
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            });

            // Validation des éditeurs Trix
            function validateTrixEditor(editorId, errorId) {
                const editor = document.querySelector(`trix-editor[input="${editorId}"]`);
                const hiddenInput = document.getElementById(editorId);
                const errorDiv = document.getElementById(errorId);
                const container = editor.closest('.trix-container');

                if (!hiddenInput.value.trim()) {
                    container.classList.add('trix-error');
                    editor.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    return false;
                } else {
                    container.classList.remove('trix-error');
                    editor.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    return true;
                }
            }

            // Validation en temps réel pour les éditeurs Trix
            document.addEventListener('trix-change', function(event) {
                const editor = event.target;
                const inputId = editor.getAttribute('input');
                const field = editor.dataset.field;

                if (field) {
                    const errorId = `${field}_error`;
                    validateTrixEditor(inputId, errorId);
                }
            });

            // Validation au focus out
            document.addEventListener('trix-blur', function(event) {
                const editor = event.target;
                const inputId = editor.getAttribute('input');
                const field = editor.dataset.field;

                if (field) {
                    const errorId = `${field}_error`;
                    validateTrixEditor(inputId, errorId);
                }
            });

            // Validation lors de la soumission du formulaire
            form.addEventListener('submit', function(event) {
                let isValid = true;

                // Validation des champs Trix
                const trixValidations = [{
                        input: 'fr_description_input',
                        error: 'fr_description_error'
                    },
                    {
                        input: 'en_description_input',
                        error: 'en_description_error'
                    }
                ];

                trixValidations.forEach(validation => {
                    if (!validateTrixEditor(validation.input, validation.error)) {
                        isValid = false;
                    }
                });

                // Validation des champs requis normaux
                const requiredFields = ['fr_name', 'en_name'];
                requiredFields.forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    event.preventDefault();

                    // Afficher une alerte générale
                    const existingAlert = document.querySelector('.alert-validation');
                    if (existingAlert) {
                        existingAlert.remove();
                    }

                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-validation';
                    alertDiv.innerHTML = '<strong>@lang('Validation Error!')</strong> @lang('Please fill in all required fields correctly.')';

                    form.insertBefore(alertDiv, form.firstChild);

                    // Faire défiler vers le premier champ avec erreur
                    const firstError = document.querySelector('.is-invalid, .trix-error');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    return false;
                }

                // Afficher l'état de chargement
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoading.style.display = 'inline';
            });

            // Supprimer les erreurs lors de la saisie
            document.querySelectorAll('input[required]').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Supprimer l'alerte de validation si elle existe
            document.addEventListener('input', function() {
                const alert = document.querySelector('.alert-validation');
                if (alert) {
                    alert.remove();
                }
            });
        });
    </script>
@endpush
