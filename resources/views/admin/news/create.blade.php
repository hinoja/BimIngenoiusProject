@extends('layouts.back')

@section('subtitle', __('Create News'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-lg rounded-2xl">
                    <div class="card-header bg-dark text-light border-b-2 border-primary">
                        <h4>@lang('Create New News')</h4>
                    </div>

                    <div class="card-body px-6 py-8 bg-gray-100">
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- Section: Titles -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-heading text-primary"></i> @lang('Titles')
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group relative">
                                        <input type="text"
                                               class="form-control modern-input peer @error('fr_title') is-invalid @enderror"
                                               id="fr_title" name="fr_title" value="{{ old('fr_title') }}" maxlength="255"
                                               placeholder=" " aria-describedby="fr_title_help fr_title_error">
                                        <label for="fr_title" class="form-label absolute left-3 -top-2.5 bg-white px-1 text-sm font-medium text-gray-600 peer-focus:text-primary transition-all duration-200">@lang('French Title')</label>
                                        <span class="char-counter absolute right-3 top-3 text-sm text-gray-600">{{ strlen(old('fr_title', '')) }}/255</span>
                                        @error('fr_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group relative">
                                        <input type="text"
                                               class="form-control modern-input peer @error('en_title') is-invalid @enderror"
                                               id="en_title" name="en_title" value="{{ old('en_title') }}" maxlength="255"
                                               placeholder=" " aria-describedby="en_title_help en_title_error">
                                        <label for="en_title" class="form-label absolute left-3 -top-2.5 bg-white px-1 text-sm font-medium text-gray-600 peer-focus:text-primary transition-all duration-200">@lang('English Title')</label>
                                        <span class="char-counter absolute right-3 top-3 text-sm text-gray-600">{{ strlen(old('en_title', '')) }}/255</span>
                                        @error('en_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Contents -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-file-alt text-primary"></i> @lang('Contents')
                                </div>
                                <div class="space-y-6">
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="fr_content" class="block text-primary font-semibold mb-2">@lang('French Content')</label>
                                        <input id="fr_content_input" type="hidden" name="fr_content" value="{{ old('fr_content') }}">
                                        <trix-editor input="fr_content_input" class="@error('fr_content') is-invalid @enderror" aria-describedby="fr_content_help"></trix-editor>
                                        @error('fr_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="en_content" class="block text-primary font-semibold mb-2">@lang('English Content')</label>
                                        <input id="en_content_input" type="hidden" name="en_content" value="{{ old('en_content') }}">
                                        <trix-editor input="en_content_input" class="@error('en_content') is-invalid @enderror" aria-describedby="en_content_help"></trix-editor>
                                        @error('en_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Featured Image -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-image text-primary"></i> @lang('Featured Image')
                                </div>
                                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                    <label class="form-label text-primary mb-3 block font-semibold">@lang('Choose an image')</label>
                                    <div class="custom-file relative">
                                        <input type="file" name="image"
                                               class="custom-file-input @error('image') is-invalid @enderror" id="image"
                                               accept="image/*" aria-describedby="image_help">
                                        <label class="custom-file-label" for="image">@lang('Choose an image')</label>
                                        @error('image')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="image-preview-container" class="mt-3 hidden relative">
                                        <img id="image-preview" class="image-preview" alt="Image Preview">
                                        <span class="remove-image" onclick="removeImage()">×</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Tags -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-tags text-primary"></i> @lang('Tags')
                                </div>
                                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                    <select id="tags" name="tags[]" class="tom-select modern-input w-full" multiple
                                            aria-describedby="tags_help">
                                        <option value="" disabled>@lang('Select or type to search tags')</option>
                                        @foreach ($availableTags as $id => $name)
                                            <option value="{{ $id }}"
                                                    {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-gray-500 mt-1 block" id="tags_help">@lang('Select up to 10 tags')</small>
                                    @error('tags')
                                        <span class="error-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Section: Publication -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-paper-plane text-primary"></i> @lang('Publication')
                                </div>
                                <div class="form-group modern-check bg-white rounded-xl p-4 shadow-sm flex items-center">
                                    <input type="checkbox" class="form-check-input" id="published_at" name="published_at"
                                           {{ old('published_at') ? 'checked' : '' }} aria-label="Publish immediately">
                                    <label class="form-check-label text-primary ml-3 font-semibold" for="published_at">
                                        @lang('Publish Immediately')
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel flex items-center gap-2">
                                    <i class="fas fa-times"></i> @lang('Cancel')
                                </a>
                                <button type="submit" class="btn btn-primary flex items-center gap-2">
                                    <i class="fas fa-save"></i> @lang('Save News')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <link href="https://cdn.tailwindcss.com/3.4.1" rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
    <style>
        :root {
            --primary: #FF6B35;
            --dark: #2A2E45;
            --light: #F8F9FA;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
            --primary-hover: #e65a1e;
            --error: #dc3545;
            --error-light: #fee2e2;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: var(--dark);
            color: var(--light);
            border-bottom: 2px solid var(--primary);
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .card-body {
            background: var(--light);
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .section-card {
            border: 1px solid var(--gray-light);
            border-radius: 12px;
            background: #fff;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .section-header {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .modern-input {
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background: #fff;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .modern-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.2);
            outline: none;
        }

        .form-label {
            color: var(--gray);
            font-weight: 500;
            transform-origin: left;
        }

        .char-counter {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .error-feedback {
            display: block;
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            background: var(--error-light);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .custom-file {
            position: relative;
        }

        .custom-file-input {
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-file-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.2);
            outline: none;
        }

        .custom-file-label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 0.75rem 1rem;
            color: var(--gray);
            background: #fff;
            border-radius: 10px;
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            pointer-events: none;
        }

        .image-preview-container {
            position: relative;
            max-width: 200px;
        }

        .image-preview {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 120px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--error);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.9rem;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .remove-image:hover {
            transform: scale(1.1);
            background-color: #c82333;
        }

        /* Trix Editor Styles */
        trix-editor {
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease;
        }

        trix-editor:focus {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.2);
        }

        trix-toolbar {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background: var(--light);
            padding: 0.5rem;
        }

        trix-editor.is-invalid {
            border-color: var(--error) !important;
        }

        /* TomSelect Styles */
        .ts-control {
            min-height: 48px;
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.5rem 1rem;
            background: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .ts-control:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.2);
        }

        .ts-control .item {
            background: var(--primary);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s ease;
        }

        .ts-control .item:hover {
            background: var(--primary-hover);
        }

        .ts-dropdown {
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-height: 240px;
            overflow-y: auto;
            z-index: 1000;
        }

        .modern-check .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid var(--dark);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modern-check .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 4px 8px rgba(255, 107, 53, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(230, 90, 30, 0.3);
        }

        .btn-cancel {
            background-color: var(--gray-light);
            border: none;
            color: var(--dark);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-cancel:hover {
            background-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .text-primary {
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .image-preview-container {
                max-width: 100%;
            }

            .image-preview {
                max-height: 100px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Initialisation des éditeurs Trix
        document.addEventListener('trix-initialize', function() {
            const trixEditors = document.querySelectorAll('trix-editor');
            trixEditors.forEach(editor => {
                const inputId = editor.getAttribute('input');
                const inputElement = document.getElementById(inputId);
                if (inputElement && inputElement.value) {
                    editor.editor.loadHTML(inputElement.value);
                }
            });
        });

        // Gestion des pièces jointes (désactiver)
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // Synchronisation du contenu Trix vers le champ caché
        document.addEventListener('trix-change', function(event) {
            const editor = event.target;
            const inputId = editor.getAttribute('input');
            const hiddenInput = document.getElementById(inputId);
            if (hiddenInput) {
                hiddenInput.value = editor.value;
            }
        });

        // Initialisation de TomSelect
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#tags', {
                maxItems: 10,
                placeholder: '@lang("Select or type to search tags")',
                searchField: ['text'],
                render: {
                    option: function(data, escape) {
                        return `<div>${escape(data.text)}</div>`;
                    },
                    item: function(data, escape) {
                        return `<div class="py-1 px-2 rounded-full bg-primary text-white">${escape(data.text)}</div>`;
                    }
                }
            });
        });

        // Gestion de la prévisualisation d'image
        function removeImage() {
            const input = document.getElementById('image');
            input.value = '';
            const previewContainer = document.getElementById('image-preview-container');
            previewContainer.classList.add('hidden');
        }

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('image-preview');
                const previewContainer = document.getElementById('image-preview-container');
                preview.src = URL.createObjectURL(file);
                previewContainer.classList.remove('hidden');
            }
        });
    </script>
@endpush
