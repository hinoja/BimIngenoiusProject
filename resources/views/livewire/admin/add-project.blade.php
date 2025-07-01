<div>
    <!-- CSS pour les améliorations de design -->
    <style>
        .step-indicator {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .modern-textarea {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            resize: vertical;
            padding: 10px;
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #333;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #c0c0c0;
        }

        .btn-back {
            background-color: #add8e6;
            color: #333;
            border: none;
        }

        .btn-back:hover {
            background-color: #87ceeb;
        }

        .img-fluid {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Styles spécifiques pour Trix avec validation */
        .trix-editor-wrapper {
            position: relative;
        }

        .trix-editor-wrapper.is-invalid trix-editor {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .trix-editor-wrapper.is-invalid trix-toolbar {
            border-color: #dc3545;
        }

        trix-editor {
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        trix-editor:focus {

            outline: 0;
        }

        trix-toolbar {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            border: 1px solid #ced4da;
            border-bottom: none;
        }

        /* Indicateur de validation pour les éditeurs */
        .trix-validation-indicator {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 1.2rem;
            pointer-events: none;
            z-index: 10;
        }

        .trix-validation-indicator.valid {
            color: #28a745;
        }

        .trix-validation-indicator.invalid {
            color: #dc3545;
        }

        /* Animation pour les erreurs */
        .invalid-feedback {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Amélioration de l'affichage des erreurs */
        .field-error {
            border-left: 4px solid #dc3545;
            background-color: #f8d7da;
            padding: 10px;
            margin-top: 5px;
            border-radius: 0 5px 5px 0;
        }

        .field-error .error-icon {
            color: #dc3545;
            margin-right: 8px;
        }
    </style>

    <!-- Indicateur d'étape -->
    <div class="step-indicator">
        @lang('Step') {{ $step }} @lang('of') {{ $totalSteps }}:
        @if ($step == 1)
            @lang('Basic Information')
        @elseif($step == 2)
            @lang('Project Details')
        @elseif($step == 3)
            @lang('Project Status and Category')
        @elseif($step == 4)
            @lang('Project Images and Tags')
        @elseif($step == 5)
            @lang('Review and Submit')
        @endif
    </div>

    <form wire:submit.prevent="{{ $step == $totalSteps ? 'addProject' : 'nextStep' }}">
        <!-- Step 1: Basic Information -->
        @if ($step == 1)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_title" class="font-weight-bold text-dark">@lang('French Title')</label>
                        <input type="text" wire:model.live="fr_title"
                            class="form-control @error('fr_title') is-invalid @enderror" id="fr_title"
                            placeholder="@lang('Enter the French title')">
                        @error('fr_title')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_title" class="font-weight-bold text-dark">@lang('English Title')</label>
                        <input type="text" wire:model.live="en_title"
                            class="form-control @error('en_title') is-invalid @enderror" id="en_title"
                            placeholder="@lang('Enter the English title')">
                        @error('en_title')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_description" class="font-weight-bold text-dark">@lang('French Description')</label>
                        <div class="trix-editor-wrapper @error('fr_description') is-invalid @enderror" id="fr_description_wrapper"  >
                            <input minlength="50"  id="fr_description_input"   type="hidden" wire:model.live="fr_description" value="{{ $fr_description }}">
                            <trix-editor input="fr_description_input"
                                         class="trix-content"
                                         data-field="fr_description"
                                         placeholder="@lang('Enter the French description')"></trix-editor>
                            <div class="trix-validation-indicator" id="fr_description_indicator"></div>
                        </div>
                        @error('fr_description')
                            <div class="field-error" id="fr_description_error">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_description" class="font-weight-bold text-dark">@lang('English Description')</label>
                        <div class="trix-editor-wrapper @error('en_description') is-invalid @enderror" id="en_description_wrapper" wire:ignore.self>
                            <input minlength="50" id="en_description_input" type="hidden" wire:model.live="en_description" value="{{ $en_description }}">
                            <trix-editor input="en_description_input"
                                         class="trix-content"
                                         data-field="en_description"
                                         placeholder="@lang('Enter the English description')"></trix-editor>
                            <div class="trix-validation-indicator" id="en_description_indicator"></div>
                        </div>
                        @error('en_description')
                            <div class="field-error" id="en_description_error">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 2: Project Details -->
        @if ($step == 2)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="country" class="font-weight-bold text-dark">@lang('Country')</label>
                        <input type="text" wire:model.live="country"
                            class="form-control @error('country') is-invalid @enderror" id="country"
                            placeholder="@lang('Enter the country')">
                        @error('country')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="city" class="font-weight-bold text-dark">@lang('City')</label>
                        <input type="text" wire:model.live="city"
                            class="form-control @error('city') is-invalid @enderror"
                            id="city" placeholder="@lang('Enter the city')">
                        @error('city')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="address" class="font-weight-bold text-dark">@lang('Address')</label>
                        <input type="text" wire:model.live="address"
                            class="form-control @error('address') is-invalid @enderror" id="address"
                            placeholder="@lang('Enter the address')">
                        @error('address')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 3: Project Attributes -->
        @if ($step == 3)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status" class="font-weight-bold text-dark">@lang('Status')</label>
                        <select wire:model.live="status" class="form-control @error('status') is-invalid @enderror"
                            id="status">
                            <option value="">@lang('Select a status')</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}">{{ __($status->value) }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="size" class="font-weight-bold text-dark">@lang('Size')</label>
                        <select wire:model.live="size" class="form-control @error('size') is-invalid @enderror"
                            id="size">
                            <option value="">@lang('Select a size')</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->value }}">{{ __($size->value) }}</option>
                            @endforeach
                        </select>
                        @error('size')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="start_date" class="font-weight-bold text-dark">@lang('Start Date')</label>
                        <input type="date" wire:model.live="start_date"
                            class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        @error('start_date')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="end_date" class="font-weight-bold text-dark">@lang('End Date')</label>
                        <input type="date" wire:model.live="end_date"
                            class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        @error('end_date')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="category_id" class="font-weight-bold text-dark">@lang('Category')</label>
                <select wire:model.live="category_id" class="form-control @error('category_id') is-invalid @enderror"
                    id="category_id">
                    <option value="">@lang('Select a category')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        <!-- Step 4: Tags -->
        @if ($step == 4)
            <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">@lang('Tags')</label>
                <div class="row">
                    @foreach ($tags as $tag)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" wire:model.live="selectedTags" value="{{ $tag->id }}"
                                    class="form-check-input" id="tag-{{ $tag->id }}">
                                <label class="form-check-label"
                                    for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('selectedTags')
                    <div class="field-error">
                        <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        <!-- Step 5: Images -->
        @if ($step == 5)
            <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">@lang('Images')</label>
                <input type="file" wire:model="images"
                    class="form-control @error('images.*') is-invalid @enderror" multiple accept="image/*">
                @error('images.*')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                    </div>
                @enderror
                @error('images')
                    <div class="field-error">
                        <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            @if (!empty($images))
                <div class="row">
                    @foreach ($images as $index => $image)
                        <div class="col-md-3 mb-3 position-relative">
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 100px; object-fit: cover;">
                            <button type="button" wire:click="removeImage({{ $index }})"
                                class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Boutons de navigation -->
        <div class="d-flex justify-content-between mt-4">
            @if ($step > 1)
                <button type="button" wire:click="previousStep" class="btn btn-back">
                    <i class="fas fa-arrow-left mr-1"></i> @lang('Previous')
                </button>
            @else
                <a href="{{ route('admin.projects.index') }}" class="btn btn-cancel">
                    <i class="fas fa-times mr-1"></i> @lang('Cancel')
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                @if ($step < $totalSteps)
                    @lang('Next') <i class="fas fa-arrow-right ml-1"></i>
                @else
                    <i class="fas fa-save mr-1"></i> @lang('Save Project')
                @endif
            </button>
        </div>
    </form>

    <!-- SweetAlert2 Integration -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('project-created', event => {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: event.detail.message,
                timer: 3000,
                showConfirmButton: false
            });
        });

        // Écouter les erreurs de validation
        window.addEventListener('validation-error', event => {
            Swal.fire({
                icon: 'error',
                title: 'Erreur de validation',
                text: event.detail.message,
                confirmButtonText: 'OK'
            });
        });
    </script>
</div>

@push('js')
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script>
    document.addEventListener('livewire:initialized', function () {
        // Variables pour stocker les éditeurs
        let trixEditors = {};

        // Fonction pour mettre à jour les indicateurs de validation
        function updateValidationIndicator(fieldName, isValid, content = '') {
            const indicator = document.getElementById(fieldName + '_indicator');
            const wrapper = document.getElementById(fieldName + '_wrapper');

            if (indicator) {
                indicator.innerHTML = '';
                if (content.trim() !== '') {
                    if (isValid) {
                        indicator.innerHTML = '<i class="fas fa-check valid"></i>';
                        wrapper.classList.remove('is-invalid');
                    } else {
                        indicator.innerHTML = '<i class="fas fa-exclamation-triangle invalid"></i>';
                        wrapper.classList.add('is-invalid');
                    }
                } else {
                    wrapper.classList.remove('is-invalid');
                }
            }
        }

        // Fonction pour valider le contenu
        function validateContent(content, fieldName) {
            // Exemple de validation basique - ajustez selon vos besoins
            const minLength = 10;
            const isValid = content.trim().length >= minLength;

            updateValidationIndicator(fieldName, isValid, content);
            return isValid;
        }

        // Fonction pour initialiser Trix avec Livewire
        function initializeTrixEditor(editorElement) {
            const inputId = editorElement.getAttribute('input');
            const inputElement = document.getElementById(inputId);
            const fieldName = editorElement.getAttribute('data-field');

            if (!inputElement || !fieldName) return;

            // Stocker la référence de l'éditeur
            trixEditors[fieldName] = editorElement;

            // Synchroniser le contenu initial
            if (inputElement.value) {
                editorElement.editor.loadHTML(inputElement.value);
                validateContent(inputElement.value, fieldName);
            }

            // Écouter les changements et synchroniser avec Livewire
            editorElement.addEventListener('trix-change', function(event) {
                const content = event.target.innerHTML;
                inputElement.value = content;

                // Valider le contenu
                validateContent(content, fieldName);

                // Déclencher un événement input pour notifier Livewire
                inputElement.dispatchEvent(new Event('input', { bubbles: true }));

                // Synchronisation directe avec Livewire
                if (window.Livewire && @this) {
                    @this.set(fieldName, content);
                }
            });

            // Validation en temps réel pendant la saisie
            editorElement.addEventListener('trix-selection-change', function(event) {
                const content = event.target.innerHTML;
                validateContent(content, fieldName);
            });

            // Gestion du focus pour améliorer l'UX
            editorElement.addEventListener('trix-focus', function(event) {
                const wrapper = document.getElementById(fieldName + '_wrapper');
                if (wrapper) {
                    wrapper.style.borderColor = '#80bdff';
                    wrapper.style.boxShadow = '0 0 0 0.2rem rgba(0, 123, 255, 0.25)';
                }
            });

            editorElement.addEventListener('trix-blur', function(event) {
                const wrapper = document.getElementById(fieldName + '_wrapper');
                if (wrapper) {
                    wrapper.style.borderColor = '';
                    wrapper.style.boxShadow = '';
                }

                // Validation finale au blur
                const content = event.target.innerHTML;
                validateContent(content, fieldName);
            });
        }

        // Initialiser tous les éditeurs Trix existants
        document.querySelectorAll('trix-editor').forEach(initializeTrixEditor);

        // Réinitialiser après chaque mise à jour Livewire
        Livewire.hook('morph.updated', ({ el, component }) => {
            // Réinitialiser les éditeurs Trix seulement s'ils n'existent pas déjà
            el.querySelectorAll('trix-editor').forEach(editor => {
                const fieldName = editor.getAttribute('data-field');
                if (!trixEditors[fieldName]) {
                    initializeTrixEditor(editor);
                }
            });
        });

        // Écouter les erreurs de validation après chaque requête
        Livewire.hook('request', ({ fail }) => {
            fail(({ status, content, preventDefault }) => {
                // Afficher les erreurs de validation pour les éditeurs Trix
                setTimeout(() => {
                    // Forcer l'affichage des erreurs pour les champs Trix
                    ['fr_description', 'en_description'].forEach(fieldName => {
                        const wrapper = document.getElementById(fieldName + '_wrapper');
                        const errorDiv = document.getElementById(fieldName + '_error');

                        if (wrapper && errorDiv && errorDiv.textContent.trim() !== '') {
                            wrapper.classList.add('is-invalid');
                            updateValidationIndicator(fieldName, false, '');
                        }
                    });
                }, 100);
            });
        });

        // Observer les changements du DOM pour détecter les erreurs
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    // Vérifier si des erreurs de validation ont été ajoutées
                    ['fr_description', 'en_description'].forEach(fieldName => {
                        const errorDiv = document.getElementById(fieldName + '_error');
                        const wrapper = document.getElementById(fieldName + '_wrapper');

                        if (errorDiv && wrapper) {
                            if (errorDiv.style.display !== 'none' && errorDiv.textContent.trim() !== '') {
                                wrapper.classList.add('is-invalid');
                                updateValidationIndicator(fieldName, false, '');
                            } else {
                                wrapper.classList.remove('is-invalid');
                            }
                        }
                    });
                }
            });
        });

        // Écouter les événements de validation Livewire spécifiquement
        document.addEventListener('livewire:update', function() {
            // Forcer la vérification des erreurs après chaque mise à jour
            setTimeout(() => {
                ['fr_description', 'en_description'].forEach(fieldName => {
                    const errorDiv = document.getElementById(fieldName + '_error');
                    const wrapper = document.getElementById(fieldName + '_wrapper');

                    if (errorDiv && wrapper) {
                        const hasError = errorDiv.textContent.trim() !== '' &&
                                       !errorDiv.classList.contains('d-none') &&
                                       errorDiv.style.display !== 'none';

                        if (hasError) {
                            wrapper.classList.add('is-invalid');
                            updateValidationIndicator(fieldName, false, '');
                            console.log(`Erreur détectée pour ${fieldName}:`, errorDiv.textContent);
                        } else {
                            wrapper.classList.remove('is-invalid');
                            const editor = trixEditors[fieldName];
                            if (editor) {
                                const content = editor.editor.getDocument().toString();
                                validateContent(content, fieldName);
                            }
                        }
                    }
                });
            }, 50);
        });

        // Désactiver l'upload de fichiers dans Trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // Configuration globale de Trix
        document.addEventListener('trix-before-initialize', function(e) {
            // Configurer la barre d'outils Trix
            Trix.config.blockAttributes.default.tagName = "div";
            Trix.config.blockAttributes.default.breakOnReturn = true;
        });

        // Nettoyage lors de la destruction des composants
        document.addEventListener('livewire:navigating', function() {
            // Nettoyer les références des éditeurs
            trixEditors = {};
        });
    });
</script>
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        /* Styles supplémentaires pour Trix */
        trix-toolbar .trix-button-group {
            border-radius: 3px;
        }

        trix-toolbar .trix-button {
            border-radius: 3px;
        }

        /* Amélioration du style des placeholders */
        trix-editor:empty:before {
            color: #6c757d;
            font-style: italic;
        }
    </style>
@endpush
