<div>
    <div class="d-flex justify-content-end mb-3">
        <button wire:click="showCreateForm()" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> @lang('Add Category')
        </button>
    </div>
    <!-- Search Section -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="@lang('Search by name or description...')">
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive ">
                <table class="table table-hover table-fixed table-striped  mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>@lang('Name')</th>
                            <th class="text-center">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + $categories->perPage() * ($categories->currentPage() - 1) }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $category->name }}</span>
                                        <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <button wire:click="showDetails({{ $category->id }})"
                                        class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="showEditForm({{ $category->id }})"
                                        class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="showDeleteForm({{ $category->id }})"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">@lang('No categories found.')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                {{ $categories->links() }}
            </div>
        </div>
    </div>



    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">@lang('Edit Category')</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateCategory">
                    <div class="modal-body">
                        <!-- Nom français (édition) -->
                        <div class="form-group mb-3">
                            <label for="editFrName" class="form-label required">
                                <i class="fas fa-flag me-1 text-primary"></i>
                                @lang('forms.editFrName')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="editFrName" wire:model="editFrName"
                                class="form-control @error('editFrName') is-invalid @enderror"
                                placeholder="@lang('Entrez le nom en français')" />
                            @error('editFrName')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nom anglais (édition) -->
                        <div class="form-group mb-3">
                            <label for="editEnName" class="form-label required">
                                <i class="fas fa-flag me-1 text-success"></i>
                                @lang('forms.editEnName')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="editEnName" wire:model="editEnName"
                                class="form-control @error('editEnName') is-invalid @enderror"
                                placeholder="@lang('Entrez le nom en anglais')" />
                            @error('editEnName')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description française (édition) -->
                        <div class="form-group mb-3" x-data="{
                            content: @entangle('editFrDescription'),
                            instance: null,
                            hasError: @error('editFrDescription') true @else false @enderror,
                            init() {
                                this.$nextTick(() => {
                                    this.instance = new Trix.Editor(this.$refs.trix);
                                    if (this.content) {
                                        this.instance.editor.loadHTML(this.content);
                                    }
                                    this.$watch('content', (value) => {
                                        if (value && this.instance.editor.composition.toString() !== value) {
                                            this.instance.editor.loadHTML(value);
                                        }
                                    });
                                    // Surveiller les erreurs de validation
                                    this.$watch('hasError', (value) => {
                                        const editor = this.$refs.trix;
                                        if (value) {
                                            editor.classList.add('is-invalid');
                                        } else {
                                            editor.classList.remove('is-invalid');
                                        }
                                    });
                                });
                            }
                        }"
                            @trix-change="content = $event.target.value; hasError = false;">
                            <label for="editFrDescription" class="form-label">
                                <i class="fas fa-edit me-1 text-primary"></i>
                                @lang('forms.editFrDescription') (FR)
                            </label>
                            <div class="trix-wrapper">
                                <input id="editFrDescription" type="hidden" name="editFrDescription"
                                    :value="content">
                                <trix-editor input="editFrDescription" x-ref="trix"
                                    class="form-control trix-content @error('editFrDescription') is-invalid @enderror"
                                    placeholder="@lang('Entrez la description en français')"></trix-editor>
                            </div>
                            @error('editFrDescription')
                                <div class="invalid-feedback d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Description anglaise (édition) -->
                        <div class="form-group mb-3" x-data="{
                            content: @entangle('editEnDescription'),
                            instance: null,
                            hasError: @error('editEnDescription') true @else false @enderror,
                            init() {
                                this.$nextTick(() => {
                                    this.instance = new Trix.Editor(this.$refs.trix);
                                    if (this.content) {
                                        this.instance.editor.loadHTML(this.content);
                                    }
                                    this.$watch('content', (value) => {
                                        if (value && this.instance.editor.composition.toString() !== value) {
                                            this.instance.editor.loadHTML(value);
                                        }
                                    });
                                    // Surveiller les erreurs de validation
                                    this.$watch('hasError', (value) => {
                                        const editor = this.$refs.trix;
                                        if (value) {
                                            editor.classList.add('is-invalid');
                                        } else {
                                            editor.classList.remove('is-invalid');
                                        }
                                    });
                                });
                            }
                        }"
                            @trix-change="content = $event.target.value; hasError = false;">
                            <label for="editEnDescription" class="form-label">
                                <i class="fas fa-edit me-1 text-success"></i>
                                @lang('forms.editEnDescription') (EN)
                            </label>
                            <div class="trix-wrapper">
                                <input id="editEnDescription" type="hidden" name="editEnDescription"
                                    :value="content">
                                <trix-editor input="editEnDescription" x-ref="trix"
                                    class="form-control trix-content @error('editEnDescription') is-invalid @enderror"
                                    placeholder="@lang('Entrez la description en anglais')"></trix-editor>
                            </div>
                            @error('editEnDescription')
                                <div class="invalid-feedback d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Image (édition) -->
                        <div class="form-group mb-3">
                            <label for="editImage" class="form-label">
                                <i class="fas fa-image me-1 text-info"></i>
                                @lang('forms.editImage')
                            </label>
                            <input type="file" id="editImage" wire:model="editImage"
                                class="form-control @error('editImage') is-invalid @enderror" accept="image/*" />
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                @lang('Formats acceptés: JPG, PNG, GIF. Taille max: 2MB')
                            </div>
                            @error('editImage')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Image actuelle -->
                        @if ($selectedCategory && $selectedCategory->image)
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    <i class="fas fa-image me-1 text-secondary"></i>
                                    @lang('Current Image')
                                </label>
                                <div class="current-image-preview">
                                    <img src="{{ $selectedCategory->image }}"
                                        style="width: 120px; height: 120px; object-fit: cover;" alt="Current image"
                                        class="img-thumbnail border-2">
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            @lang('Sélectionnez une nouvelle image pour remplacer celle-ci')
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            @lang('Cancel')
                        </button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="updateCategory">
                            <span wire:loading.remove wire:target="updateCategory">
                                <i class="fas fa-save me-1"></i>
                                @lang('Save')
                            </span>
                            <span wire:loading wire:target="updateCategory">
                                <i class="fas fa-spinner fa-spin me-1"></i>
                                @lang('Processing...')
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">@lang('Delete Category')</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('Are you sure you want to delete this category?')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        wire:click="closeModal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="destroyCategory()"
                        wire:loading.attr="disabled" wire:target="destroyCategory">
                        <span wire:loading wire:target="destroyCategory">
                            <i class="fas fa-spinner fa-spin me-1"></i> @lang('Deleting...')
                        </span>
                        <span wire:loading.remove wire:target="destroyCategory">
                            <i class="fas fa-trash me-1"></i> @lang('Delete')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div wire:ignore.self class="modal fade" id="detailsModal" tabindex="-1" role="dialog"
        aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">@lang('Category Details')</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedCategory)
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>@lang('French Name'):</strong> {{ $selectedCategory->fr_name }}</p>
                                <p><strong>@lang('English Name'):</strong> {{ $selectedCategory->en_name }}</p>
                                <p><strong>@lang('Slug'):</strong> {{ $selectedCategory->slug }}</p>
                            </div>
                            <div class="col-md-6">
                                @if ($selectedCategory->image)
                                    <img src="{{ $selectedCategory->image }}"
                                        style="width: 150px; height: 150px; object-fit: cover;"
                                        alt="{{ $selectedCategory->name }}" class="img-fluid">
                                @else
                                    <p>@lang('No image available')</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>@lang('Description')</h6>
                                <div class="wysiwyg-box">
                                    <div>{!! $selectedCategory->description ?? 'N/A' !!}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        wire:click="closeModal()">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        /* Styles pour les labels obligatoires */
        .form-label.required {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-label .text-danger {
            font-size: 1.1em;
        }

        /* Amélioration des messages d'erreur */

        /* Styles spécifiques pour les éditeurs Trix */
        .trix-wrapper {
            position: relative;
        }

        .trix-content.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        .trix-content.is-invalid+.invalid-feedback {
            display: block !important;
        }

        /* Animation pour les erreurs */
        .invalid-feedback {
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styles pour le conteneur WYSIWYG */
        .wysiwyg-box {
            background-color: #f4f8fb;
            padding: 1.5rem;
            border-left: 4px solid #007bff;
            border-radius: 6px;
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.02);
            font-family: "Georgia", serif;
            font-size: 0.97rem;
            line-height: 1.75;
            color: #343a40;
            margin-top: 1rem;
        }

        .wysiwyg-box p {
            margin-bottom: 1rem;
        }

        .wysiwyg-box h1,
        .wysiwyg-box h2,
        .wysiwyg-box h3 {
            color: #0056b3;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .wysiwyg-box ul,
        .wysiwyg-box ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .wysiwyg-box blockquote {
            border-left: 3px solid #007bff;
            padding-left: 1rem;
            color: #555;
            font-style: italic;
            background-color: #e9f2fb;
            margin: 1rem 0;
        }

        .wysiwyg-box img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 1rem 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        /* Styles pour les en-têtes de modal */
        .modal-header {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-footer {
            border-top: 2px solid #FF6B35;
        }

        /* Styles pour l'aperçu de l'image actuelle */
        .current-image-preview {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }

        .current-image-preview img {
            border: 2px solid #007bff;
        }

        /* Amélioration du texte d'aide */
        .form-text {
            font-size: 0.875em;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Focus states améliorés */
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .trix-editor:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Styles pour les icônes dans les labels */
        .form-label i {
            opacity: 0.8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .invalid-feedback {
                font-size: 0.8em;
                padding: 0.4rem 0.6rem;
            }
        }

        /* Loading states */
        .btn[wire\:loading\.attr="disabled"] {
            position: relative;
        }

        /* Validation success states */
        .form-control.is-valid {
            border-color: #198754;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='m2.3 6.73.8-.77-.8-.77-.8.77zm1.3-2.77L5.04 3 4.3 2.28l-.8.77zm1.08-1.08L6.15 1.4l.8.77-.8.77z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .trix-content.is-valid {
            border-color: #198754 !important;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25) !important;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openEditModal', () => {
                $('#editModal').modal('show');
            });

            Livewire.on('openDeleteModal', () => {
                $('#deleteModal').modal('show');
            });

            Livewire.on('openDetailsModal', () => {
                $('#detailsModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#editModal').modal('hide');
                $('#deleteModal').modal('hide');
                $('#detailsModal').modal('hide');
            });
        });
    </script>
@endpush
