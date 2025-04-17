@extends('layouts.back')

@section('subtitle', __('Create News'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header"
                        style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h4>@lang('Create New News')</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body px-6 py-8 bg-gray-100">
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-8">
                            @csrf

                            <!-- Section: Titles -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-heading"></i> @lang('Titles')
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control modern-input @error('fr_title') is-invalid @enderror"
                                            id="fr_title" name="fr_title" value="{{ old('fr_title') }}" maxlength="255">
                                        <label for="fr_title" class="form-label">@lang('French Title')</label>
                                        <span class="char-counter">{{ strlen(old('fr_title', '')) }}/255</span>
                                        @error('fr_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control modern-input @error('en_title') is-invalid @enderror"
                                            id="en_title" name="en_title" value="{{ old('en_title') }}" maxlength="255">
                                        <label for="en_title" class="form-label">@lang('English Title')</label>
                                        <span class="char-counter">{{ strlen(old('en_title', '')) }}/255</span>
                                        @error('en_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Contents -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-file-alt"></i> @lang('Contents')
                                </div>
                                <div class="space-y-6">
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="fr_content"
                                            class="block text-ff6b35 font-semibold mb-2">@lang('French Content')</label>
                                        <textarea class="form-control modern-input summernote @error('fr_content') is-invalid @enderror" id="fr_content"
                                            name="fr_content" rows="6">{{ old('fr_content') }}</textarea>
                                        @error('fr_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="en_content"
                                            class="block text-ff6b35 font-semibold mb-2">@lang('English Content')</label>
                                        <textarea class="form-control modern-input summernote @error('en_content') is-invalid @enderror" id="en_content"
                                            name="en_content" rows="6">{{ old('en_content') }}</textarea>
                                        @error('en_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Featured Image -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-image"></i> @lang('Featured Image')
                                </div>
                                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                    <label class="form-label text-ff6b35 mb-3 block font-semibold">@lang('Choose an image')</label>
                                    <div class="custom-file">
                                        <input type="file" name="image"
                                            class="custom-file-input @error('image') is-invalid @enderror" id="image"
                                            accept="image/*">
                                        <label class="custom-file-label" for="image">@lang('Choose an image')</label>
                                        @error('image')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="image-preview-container" class="mt-3 hidden">
                                        <img id="image-preview" class="image-preview" alt="Image Preview">
                                        <span class="remove-image" onclick="removeImage()">×</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Tags -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-tags"></i> @lang('Tags')
                                </div>
                                <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                    <select id="tags" name="tags[]" class="form-control select2" multiple>
                                        @foreach ($availableTags as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <span class="error-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Section: Publication -->
                            <div class="section-card">
                                <div class="section-header">
                                    <i class="fas fa-paper-plane"></i> @lang('Publication')
                                </div>
                                <div class="form-group modern-check bg-white rounded-xl p-4 shadow-sm flex items-center">
                                    <input type="checkbox" class="form-check-input" id="published_at" name="published_at"
                                        {{ old('published_at') ? 'checked' : '' }}>
                                    <label class="form-check-label text-ff6b35 ml-3 font-semibold" for="published_at">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        /* Styles pour les sections */
        .section-card {
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2A2E45;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 10px;
            color: #FF6B35;
        }

        /* Styles pour les inputs et labels */
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .modern-input {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .modern-input:focus {
            border-color: #FF6B35;
            outline: none;
        }

        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            background-color: #ffffff;
            padding: 0 5px;
            font-size: 0.9rem;
            color: #2A2E45;
        }

        .char-counter {
            font-size: 0.8rem;
            color: #6c757d;
            position: absolute;
            right: 15px;
            bottom: -20px;
        }

        .error-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }

        /* Styles pour les boutons */
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background-color: #00AEEF;
            border-color: #00AEEF;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #008bbf;
            transform: scale(1.05);
        }

        .btn-cancel {
            background-color: #F8F9FA;
            border: 1px solid #e5e7eb;
            color: #2A2E45;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
            transform: scale(1.05);
        }

        /* Styles pour l'image preview */
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #dc3545;
            color: #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
        }

        /* Styles pour Select2 et Summernote */
        .select2-container--classic .select2-selection--multiple {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
        }

        .summernote {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery verticale-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialiser Select2
            $('.select2').select2({
                theme: 'classic',
                placeholder: '@lang('Select tags')',
                maximumSelectionLength: 4
            });

            // Initialiser Summernote
            $('.summernote').summernote({
                height: 200,
                placeholder: '@lang('Start typing...')',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Prévisualisation de l'image
            $('#image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result);
                        $('#image-preview-container').removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                    $('.custom-file-label').text(file.name);
                }
            });

            // Compteur de caractères pour les titres
            ['fr_title', 'en_title'].forEach(function(id) {
                $(`#${id}`).on('input', function() {
                    $(this).siblings('.char-counter').text(`${this.value.length}/255`);
                });
            });
        });

        function removeImage() {
            $('#image').val('');
            $('#image-preview-container').addClass('hidden');
            $('.custom-file-label').text('@lang('Choose an image')');
        }
    </script>
@endpush
