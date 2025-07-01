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
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
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
                                        <label for="fr_title"
                                            class="form-label absolute left-3 -top-2.5 bg-white px-1 text-sm font-medium text-gray-600 peer-focus:text-primary transition-all duration-200">@lang('French Title')</label>
                                        <span
                                            class="char-counter absolute right-3 top-3 text-sm text-gray-600">{{ strlen(old('fr_title', '')) }}/255</span>
                                        @error('fr_title')
                                            <span class="error-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group relative">
                                        <input type="text"
                                            class="form-control modern-input peer @error('en_title') is-invalid @enderror"
                                            id="en_title" name="en_title" value="{{ old('en_title') }}" maxlength="255"
                                            placeholder=" " aria-describedby="en_title_help en_title_error">
                                        <label for="en_title"
                                            class="form-label absolute left-3 -top-2.5 bg-white px-1 text-sm font-medium text-gray-600 peer-focus:text-primary transition-all duration-200">@lang('English Title')</label>
                                        <span
                                            class="char-counter absolute right-3 top-3 text-sm text-gray-600">{{ strlen(old('en_title', '')) }}/255</span>
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
                                        <label for="fr_content"
                                            class="block text-primary font-semibold mb-2">@lang('French Content')</label>
                                        <textarea name="fr_content" id="fr_content" class="ckeditor-textarea @error('fr_content') is-invalid @enderror"
                                            aria-describedby="fr_content_help">{{ old('fr_content') }}</textarea>
                                        @error('fr_content')
                                            <span class="error-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group bg-white rounded-xl p-4 shadow-sm">
                                        <label for="en_content"
                                            class="block text-primary font-semibold mb-2">@lang('English Content')</label>
                                        <textarea name="en_content" id="en_content" class="ckeditor-textarea @error('en_content') is-invalid @enderror"
                                            aria-describedby="en_content_help">{{ old('en_content') }}</textarea>
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
                                    <label
                                        class="form-label text-primary mb-3 block font-semibold">@lang('Choose an image')</label>

                                    <!-- Container pour l'upload -->
                                    <div class="upload-container">
                                        <div class="custom-file-upload">
                                            <input type="file" name="image"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="image" accept="image/*" aria-describedby="image_help image_error">
                                            <label class="custom-file-label @error('image') error-border @enderror"
                                                for="image">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span class="upload-text">@lang('Choose an image')</span>
                                            </label>
                                        </div>

                                        <!-- Message d'aide -->
                                        <small class="text-gray-500 mt-2 block" id="image_help">
                                            @lang('Accepted formats: JPG, PNG, GIF. Maximum size: 5MB')
                                        </small>
                                    </div>

                                    <!-- Message d'erreur placé en dehors du conteneur d'upload -->
                                    @error('image')
                                        <div class="error-feedback mt-3" role="alert" id="image_error">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <!-- Prévisualisation -->
                                    <div id="image-preview-container" class="mt-4 hidden relative">
                                        <img id="image-preview" class="image-preview" alt="Image Preview">
                                        <button type="button" class="remove-image-btn" onclick="removeImage()">
                                            <i class="fas fa-times"></i>
                                        </button>
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
                                <div class="form-group modern-check bg-white rounded-xl p-4 shadow-sm">
                                    <label class="toggle-switch" for="published_at">
                                        <input type="checkbox" class="toggle-input" id="published_at"
                                            name="published_at" {{ old('published_at') ? 'checked' : '' }}
                                            aria-label="Publish immediately">
                                        <span class="toggle-slider"></span>
                                        <span class="toggle-label">@lang('Publish Immediately')</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>@lang('Cancel')</span>
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle"></i>
                                    <span>@lang('Create News')</span>
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
    <link href="https://cdn.tailwindcss.com/3.4.1" rel="stylesheet" media="print"
        onload="this.media='all'; this.onload=null;">
    <style>


        .card {
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: var(--dark);
            color: var(--light);
            border-bottom: 2px solid var(--primary);
            border-top-left-radius: 16px;
            border-top-right-radius: 10px;
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
            margin-bottom: 1rem;
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

        /* Upload d'image amélioré */
        .custom-file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-file-input {
            position: absolute;
            left: -9999px;
            opacity: 0;
        }

        .custom-file-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px dashed var(--gray-light);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--gray);
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
        }

        .custom-file-label:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .custom-file-label i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .image-preview-container {
            position: relative;
            max-width: 200px;
        }

        .image-preview {
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            max-height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        .remove-image-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--error) 0%, #b91c1c 100%);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .remove-image-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(220, 53, 69, 0.4);
        }

        /* Toggle Switch moderne */
        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            user-select: none;
        }

        .toggle-input {
            position: absolute;
            opacity: 0;
        }

        .toggle-slider {
            position: relative;
            width: 60px;
            height: 30px;
            background: var(--gray-light);
            border-radius: 15px;
            transition: background 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-input:checked+.toggle-slider {
            background: var(--primary);
        }

        .toggle-input:checked+.toggle-slider::before {
            transform: translateX(30px);
        }

        .toggle-label {
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        /* Boutons modernes */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-light);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            /* padding: 0.875rem 1.75rem;
                                font-size: 1rem; */
            font-weight: 600;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-width: 140px;
            justify-content: center;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: scale(1.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 6px 12px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(255, 107, 53, 0.4);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        }

        .btn-draft {
            background: linear-gradient(135deg, var(--draft) 0%, #4f46e5 100%);
            color: white;
            box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-draft:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, #818cf8 0%, var(--draft) 100%);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark);
            border: 1px solid var(--gray-light);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            border-color: var(--gray);
        }

        /* CKEditor Styles */
        .ckeditor-textarea {
            display: none;
        }

        .ck-editor {
            border: 1px solid var(--gray-light);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease;
            overflow: hidden;
        }

        .ck-editor.ck-focused {
            border-color: var(--primary);
            box-shadow: 0 0 12px rgba(255, 107, 53, 0.15);
        }

        .ck-editor__main {
            min-height: 250px;
        }

        .ck-content {
            min-height: 250px;
            max-height: 500px;
            overflow-y: auto;
            padding: 1rem;
            font-size: 1rem;
            line-height: 1.6;
        }

        .ck-toolbar {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid var(--gray-light);
            padding: 0.75rem;
        }

        .ck-toolbar .ck-button {
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .ck-toolbar .ck-button:hover {
            background: var(--primary);
            color: white;
        }

        .ck-editor.is-invalid .ck-editor__main {
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
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(255, 107, 53, 0.2);
        }

        .ts-control .item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
        }

        .ts-dropdown {
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            max-height: 240px;
            overflow-y: auto;
            z-index: 1000;
        }

        .text-primary {
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }

            .image-preview-container {
                max-width: 100%;
            }

            .image-preview {
                max-height: 120px;
            }

            .toggle-switch {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
        }

        /* Animation de chargement */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
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
    </style>
@endpush

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Configuration pour l'upload d'images
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.upload.image') }}', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'));
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    if (!response || xhr.status !== 200) {
                        return reject(response && response.message ? response.message : genericErrorText);
                    }

                    if (response.url) {
                        resolve({
                            default: response.url
                        });
                    } else {
                        reject(genericErrorText);
                    }
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        // Initialisation des éditeurs CKEditor
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration CKEditor avec upload d'images
            const editorConfig = {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'undo',
                        'redo',
                        '|',
                        'link',
                        'blockQuote',
                        'insertTable',
                        'imageUpload',
                        'mediaEmbed',
                        '|',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        'highlight',
                        '|',
                        'alignment',
                        '|',
                        'sourceEditing'
                    ]
                },
                language: 'fr',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                image: {
                    toolbar: [
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side',
                        '|',
                        'toggleImageCaption',
                        'imageTextAlternative'
                    ]
                },
                licenseKey: '',
            };

            // Initialiser CKEditor pour le contenu français
            ClassicEditor
                .create(document.querySelector('#fr_content'), editorConfig)
                .then(editor => {
                    window.frContentEditor = editor;

                    // Gestion de la validation d'erreur
                    const textarea = document.querySelector('#fr_content');
                    if (textarea.classList.contains('is-invalid')) {
                        editor.ui.element.classList.add('is-invalid');
                    }

                    // Synchroniser le contenu avec le textarea
                    editor.model.document.on('change:data', () => {
                        textarea.value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de l\'initialisation de l\'éditeur français:', error);
                });

            // Initialiser CKEditor pour le contenu anglais
            ClassicEditor
                .create(document.querySelector('#en_content'), {
                    ...editorConfig,
                    language: 'en'
                })
                .then(editor => {
                    window.enContentEditor = editor;

                    // Gestion de la validation d'erreur
                    const textarea = document.querySelector('#en_content');
                    if (textarea.classList.contains('is-invalid')) {
                        editor.ui.element.classList.add('is-invalid');
                    }

                    // Synchroniser le contenu avec le textarea
                    editor.model.document.on('change:data', () => {
                        textarea.value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de l\'initialisation de l\'éditeur anglais:', error);
                });

            // Initialisation de TomSelect
            new TomSelect('#tags', {
                maxItems: 10,
                placeholder: '@lang('Select or type to search tags')',
                searchField: ['text'],
                render: {
                    option: function(data, escape) {
                        return `<div class="px-3 py-2 hover:bg-gray-50 transition-colors">${escape(data.text)}</div>`;
                    },
                    item: function(data, escape) {
                        return `<div class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium">${escape(data.text)}</div>`;
                    }
                }
            });
        });

        // Gestion améliorée de la prévisualisation d'image
        function removeImage() {
            const input = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview-container');
            const label = document.querySelector('.custom-file-label .upload-text');

            input.value = '';
            previewContainer.classList.add('hidden');
            label.textContent = '@lang('Choose an image')';

            // Animation de suppression
            previewContainer.style.transform = 'scale(0.8)';
            previewContainer.style.opacity = '0';
            setTimeout(() => {
                previewContainer.style.transform = '';
                previewContainer.style.opacity = '';
            }, 300);
        }

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const label = document.querySelector('.custom-file-label .upload-text');

            if (file) {
                const preview = document.getElementById('image-preview');
                const previewContainer = document.getElementById('image-preview-container');

                // Validation du fichier
                if (!file.type.startsWith('image/')) {
                    alert('@lang('Please select a valid image file')');
                    this.value = '';
                    return;
                }

                if (file.size > 5 * 1024 * 1024) { // 5MB
                    alert('@lang('Image size should be less than 5MB')');
                    this.value = '';
                    return;
                }

                // Mise à jour du label
                label.textContent = file.name;

                // Prévisualisation avec animation
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');

                    // Animation d'apparition
                    previewContainer.style.transform = 'scale(0.8)';
                    previewContainer.style.opacity = '0';
                    setTimeout(() => {
                        previewContainer.style.transform = 'scale(1)';
                        previewContainer.style.opacity = '1';
                        previewContainer.style.transition = 'all 0.3s ease';
                    }, 10);
                };
                reader.readAsDataURL(file);
            } else {
                label.textContent = '@lang('Choose an image')';
            }
        });

        // Fonction pour sauvegarder en brouillon
        function saveDraft() {
            const form = document.querySelector('form');
            const draftButton = document.querySelector('.btn-draft');
            const publishCheckbox = document.getElementById('published_at');

            // Désactiver la publication immédiate pour le brouillon
            publishCheckbox.checked = false;

            // Animation de chargement
            draftButton.classList.add('loading');
            draftButton.disabled = true;

            // Synchroniser le contenu CKEditor
            if (window.frContentEditor) {
                document.querySelector('#fr_content').value = window.frContentEditor.getData();
            }
            if (window.enContentEditor) {
                document.querySelector('#en_content').value = window.enContentEditor.getData();
            }

            // Créer un champ caché pour indiquer qu'il s'agit d'un brouillon
            const draftInput = document.createElement('input');
            draftInput.type = 'hidden';
            draftInput.name = 'save_as_draft';
            draftInput.value = '1';
            form.appendChild(draftInput);

            // Soumettre le formulaire
            form.submit();
        }

        // Validation avant soumission du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitButton = e.submitter;

            // Animation de chargement pour le bouton cliqué
            if (submitButton) {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
            }

            // Synchroniser le contenu CKEditor avec les textareas avant soumission
            if (window.frContentEditor) {
                document.querySelector('#fr_content').value = window.frContentEditor.getData();
            }
            if (window.enContentEditor) {
                document.querySelector('#en_content').value = window.enContentEditor.getData();
            }

            // Validation côté client
            const frTitle = document.getElementById('fr_title').value.trim();
            const enTitle = document.getElementById('en_title').value.trim();
            const frContent = window.frContentEditor ? window.frContentEditor.getData().trim() : '';
            const enContent = window.enContentEditor ? window.enContentEditor.getData().trim() : '';

            if (!frTitle || !enTitle) {
                e.preventDefault();
                alert('@lang('Please fill in both French and English titles')');
                if (submitButton) {
                    submitButton.classList.remove('loading');
                    submitButton.disabled = false;
                }
                return;
            }

            if (!frContent || !enContent) {
                e.preventDefault();
                alert('@lang('Please fill in both French and English content')');
                if (submitButton) {
                    submitButton.classList.remove('loading');
                    submitButton.disabled = false;
                }
                return;
            }
        });

        // Compteurs de caractères en temps réel
        function updateCharCounter(inputId, counterId) {
            const input = document.getElementById(inputId);
            const counter = document.querySelector(`#${inputId} + label + .char-counter`);

            if (input && counter) {
                input.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    const maxLength = this.getAttribute('maxlength') || 255;
                    counter.textContent = `${currentLength}/${maxLength}`;

                    // Changer la couleur si proche de la limite
                    if (currentLength > maxLength * 0.9) {
                        counter.style.color = 'var(--error)';
                    } else if (currentLength > maxLength * 0.75) {
                        counter.style.color = 'var(--warning)';
                    } else {
                        counter.style.color = 'var(--gray)';
                    }
                });
            }
        }

        // Initialiser les compteurs
        updateCharCounter('fr_title');
        updateCharCounter('en_title');

        // Amélioration de l'expérience utilisateur avec des transitions
        document.querySelectorAll('.modern-input, .custom-file-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = '';
            });
        });

        // Sauvegarde automatique (optionnelle)
        let autoSaveTimeout;

        function autoSave() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                // Ici vous pouvez implémenter la sauvegarde automatique
                console.log('Auto-save triggered');
            }, 30000); // Sauvegarde toutes les 30 secondes
        }

        // Déclencher l'auto-save sur les changements
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('input', autoSave);
        });
    </script>
@endpush
