<div class="container">
    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center">
        <!-- Add Category Form -->
        <div class="col-lg-5 col-md-6 col-xs-12">
            <div class="card border-0 rounded-lg">
                <form wire:submit.prevent="addCategory">
                    <div class="card-header bg-white border-bottom py-3">
                        <h4 class="card-title mb-0">@lang('Add a new Category')</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="fr_name">@lang('French Name')</label>
                            <input type="text" wire:model="fr_name" class="form-control @error('fr_name') is-invalid @enderror" id="fr_name" placeholder="@lang('Enter the French name')">
                            @error('fr_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="en_name">@lang('English Name')</label>
                            <input type="text" wire:model="en_name" class="form-control @error('en_name') is-invalid @enderror" id="en_name" placeholder="@lang('Enter the English name')">
                            @error('en_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="description">@lang('Description')</label>
                            <textarea wire:model.defer="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">@lang('Image')</label>
                            <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" id="image">
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

        <!-- Category List -->
        <div class="col-lg-7 col-md-6 col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>@lang('French Name')</th>
                                    <th>@lang('English Name')</th>
                                    <th>@lang('Image')</th>
                                    <th class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + ($categories->perPage() * ($categories->currentPage() - 1)) }}</td>
                                        <td>{{ $category->fr_name }}</td>
                                        <td>{{ $category->en_name }}</td>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->fr_name }}" style="width: 50px; height: 50px;">
                                            @else
                                                <span>@lang('No image')</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button wire:click="showEditForm({{ $category->id }})" class="btn btn-sm btn-primary mr-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="showDeleteForm({{ $category->id }})" class="btn btn-sm btn-danger">
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
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">@lang('Edit Category')</h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
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

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    <button type="button" wire:click="closeModal()" class="btn btn-secondary">@lang('Cancel')</button>
                    <button wire:click="destroyCategory" class="btn btn-danger">@lang('Delete')</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            // Summernote for main form
            $('#description').summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['view', ['codeview']]
                ],
                callbacks: {
                    onChange: function(contents) {
                        @this.set('description', contents);
                    }
                }
            });

            // Summernote for edit modal
            Livewire.on('openEditModal', () => {
                $('#editDescription').summernote('destroy');
                $('#editDescription').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['codeview']]
                    ],
                    callbacks: {
                        onChange: function(contents) {
                            @this.set('editDescription', contents);
                        },
                        onInit: function() {
                            $('#editDescription').summernote('code', @this.editDescription);
                        }
                    }
                });
            });

            Livewire.on('closeModal', () => {
                $('#editDescription').summernote('destroy');
            });
        });

        // Gestion des modals avec Bootstrap
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openEditModal', () => {
                $('#editModal').modal('show');
            });

            Livewire.on('openDeleteModal', () => {
                $('#deleteModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#editModal').modal('hide');
                $('#deleteModal').modal('hide');
            });
        });
    </script>
@endpush
