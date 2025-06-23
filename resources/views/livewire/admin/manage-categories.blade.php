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
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>


    <!-- Create Modal -->
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog"
        aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">@lang('Add a new Category')</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="addCategory">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fr_name" class="font-weight-bold text-dark mb-2">@lang('forms.fr_name')</label>
                            <input type="text" id="fr_name" wire:model="fr_name"
                                class="form-control @error('fr_name') is-invalid @enderror" placeholder="@lang('forms.fr_name')" />
                            @error('fr_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="en_name" class="font-weight-bold text-dark mb-2">@lang('forms.en_name')</label>
                            <input type="text" id="en_name" wire:model="en_name"
                                class="form-control @error('en_name') is-invalid @enderror" placeholder="@lang('forms.en_name')" />
                            @error('en_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2" x-data="{
                            content: @entangle('description'),
                            instance: null,
                            init() {
                                this.$nextTick(() => {
                                    this.instance = new Trix.Editor(this.$refs.trix);

                                    // Charger le contenu initial
                                    if (this.content) {
                                        this.instance.editor.loadHTML(this.content);
                                    }

                                    // Écouter les changements du contenu depuis Livewire
                                    this.$watch('content', (value) => {
                                        if (value && this.instance.editor.composition.toString() !== value) {
                                            this.instance.editor.loadHTML(value);
                                        }
                                    });
                                });
                            }
                        }" @trix-change="content = $event.target.value">
                            <label for="description" class="font-weight-bold text-dark mb-2">@lang('forms.description')</label>
                            <input id="description" type="hidden" name="description" :value="content">
                            <trix-editor input="description" x-ref="trix"
                                class="form-control trix-content @error('description') is-invalid @enderror"></trix-editor>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="image" class="font-weight-bold text-dark mb-2">@lang('forms.image')</label>
                            <input type="file" id="image" wire:model="image" class="form-control @error('image') is-invalid @enderror" />
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()"
                            class="btn btn-secondary">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="addCategory">
                            <span wire:loading.remove wire:target="addCategory">@lang('Save')</span>
                            <span wire:loading wire:target="addCategory">@lang('Processing...')</span>
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
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">@lang('Cancel')</button>
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
                                <div>{!! $selectedCategory->description !!}</div>
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
                        <div class="form-group">
                            <label for="editFrName" class="font-weight-bold text-dark mb-2">@lang('forms.editFrName')</label>
                            <input type="text" id="editFrName" wire:model="editFrName"
                                class="form-control @error('editFrName') is-invalid @enderror"
                                placeholder="@lang('forms.editFrName')" />
                            @error('editFrName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="editEnName" class="font-weight-bold text-dark mb-2">@lang('forms.editEnName')</label>
                            <input type="text" id="editEnName" wire:model="editEnName"
                                class="form-control @error('editEnName') is-invalid @enderror"
                                placeholder="@lang('forms.editEnName')" />
                            @error('editEnName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2" x-data="{
                            content: @entangle('editDescription'),
                            instance: null,
                            init() {
                                this.$nextTick(() => {
                                    this.instance = new Trix.Editor(this.$refs.trix);

                                    // Charger le contenu initial
                                    if (this.content) {
                                        this.instance.editor.loadHTML(this.content);
                                    }

                                    // Écouter les changements du contenu depuis Livewire
                                    this.$watch('content', (value) => {
                                        if (value && this.instance.editor.composition.toString() !== value) {
                                            this.instance.editor.loadHTML(value);
                                        }
                                    });
                                });
                            }
                        }" @trix-change="content = $event.target.value" wire:ignore>
                            <label for="editDescription" class="font-weight-bold text-dark mb-2">@lang('forms.editDescription')</label>
                            <input id="editDescription" type="hidden" name="editDescription" :value="content">
                            <trix-editor input="editDescription" x-ref="trix"
                                class="form-control trix-content @error('editDescription') is-invalid @enderror"></trix-editor>
                            @error('editDescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="editImage" class="font-weight-bold text-dark mb-2">@lang('forms.editImage')</label>
                            <input type="file" id="editImage" wire:model="editImage" class="form-control @error('editImage') is-invalid @enderror" />
                            @error('editImage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($selectedCategory && $selectedCategory->image)
                            <div class="form-group mt-2">
                                <label>@lang('Current Image')</label>
                                <div>
                                    <img src="{{ $selectedCategory->image }}"
                                         style="width: 100px; height: 100px; object-fit: cover;"
                                         alt="Current image" class="img-thumbnail">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()"
                            class="btn btn-secondary">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="updateCategory">
                            <span wire:loading.remove wire:target="updateCategory">@lang('Save')</span>
                            <span wire:loading wire:target="updateCategory">@lang('Processing...')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        .trix-content.is-invalid {
            border-color: #dc3545;
        }

        .modal-header {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-footer {
            border-top: 2px solid #FF6B35;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('openModal', () => {
                new bootstrap.Modal(document.getElementById('createModal')).show();
            });

            Livewire.on('openDetailsModal', () => {
                new bootstrap.Modal(document.getElementById('detailsModal')).show();
            });

            Livewire.on('openEditModal', () => {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();
            });

            Livewire.on('openDeleteModal', () => {
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });

            Livewire.on('closeModal', () => {
                // Fermer toutes les modales
                document.querySelectorAll('.modal').forEach(modal => {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });
        });
    </script>
@endpush
