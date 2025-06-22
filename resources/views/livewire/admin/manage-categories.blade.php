<div>
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
                                        class="btn btn-sm btn-info mr-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="showEditForm({{ $category->id }})"
                                        class="btn btn-sm btn-primary mr-1">
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


    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">@lang('Delete Category')</h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('Are you sure you want to delete this category?')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="destroyCategory()"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="destroyProject">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Deleting...')
                        </span>
                        <span wire:loading.remove wire:target="destroyProject">
                            <i class="fas fa-trash mr-1"></i> @lang('Delete')
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
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($selectedCategory)
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>@lang('French Name'):</strong> {{ $selectedCategory->fr_name }}</p>
                                <p><strong>@lang('English Name'):</strong> {{ $selectedCategory->en_name }}</p>
                                <p><strong>@lang('Slug'):</strong> {{ $selectedCategory->slug }}</p>
                            </div>
                            <div class="col-md-6">
                                @if($selectedCategory->image)
                                    <img src="{{ Storage::url($selectedCategory->image) }}" alt="{{ $selectedCategory->name }}" class="img-fluid">
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
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">@lang('Close')</button>
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
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateCategory">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('French Name')</label>
                            <input type="text" wire:model="editFrName" class="form-control" placeholder="@lang('French Name')" />
                            @error('editFrName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>@lang('English Name')</label>
                            <input type="text" wire:model="editEnName" class="form-control" placeholder="@lang('English Name')" />
                            @error('editEnName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label>@lang('Description')</label>
                            <textarea wire:model.defer="editDescription" id="editDescription" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>@lang('Image')</label>
                            <input type="file" wire:model="editImage" class="form-control" />
                            @error('editImage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
     <style>
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
      <script>
        // Gestion des modals avec Bootstrap

        document.addEventListener('livewire:init', () => {
            Livewire.on('openDetailsModal', () => {
                $('#detailsModal').modal('show');
            });

            Livewire.on('openEditModal', () => {
                $('#editModal').modal('show');
            });

            Livewire.on('openDeleteModal', () => {
                $('#deleteModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#detailsModal').modal('hide');
                $('#editModal').modal('hide');
                $('#deleteModal').modal('hide');
            });
        });
    </script>
@endpush




