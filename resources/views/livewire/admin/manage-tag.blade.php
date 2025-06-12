<div>
    <div class="row">
        <!-- Add Tag Form -->
        <div class="col-lg-5 col-md-6 col-xs-12">
            <div class="card border-0 rounded-lg">
                <form wire:submit.prevent="addTag">
                    <div class="card-header bg-white border-bottom py-3">
                        <h4 class="card-title mb-0">@lang('Add a new Tag')</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="fr_name">@lang('French Tag Name')</label>
                            <input type="text" wire:model.defer="fr_name"
                                class="form-control @error('fr_name') is-invalid @enderror" id="fr_name"
                                placeholder="@lang('Enter the French Tag name')">
                            @error('fr_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="en_name">@lang('English Tag Name')</label>
                            <input type="text" wire:model.defer="en_name"
                                class="form-control @error('en_name') is-invalid @enderror" id="en_name"
                                placeholder="@lang('Enter the English Tag name')">
                            @error('en_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top py-3">
                        <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled"
                            wire:target="addTag">
                            <span wire:loading.remove wire:target="addTag">@lang('Add')</span>
                            <span wire:loading wire:target="addTag">@lang('Processing...')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-7 col-md-6 col-12">
            <!-- Search Section -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" wire:model.live="searchTerm" class="form-control"
                            placeholder="@lang('Search by tag name...')">
                    </div>
                </div>
            </div>

            <!-- Tags List -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>@lang('Name')</th>
                                    <th class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration + $tags->perPage() * ($tags->currentPage() - 1) }}
                                        </td>
                                        <td>{{ $tag->name }}</td>
                                        <td class="text-center">
                                            <button wire:click="showEditForm({{ $tag->id }})"
                                                class="btn btn-sm btn-primary mr-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="showDeleteForm({{ $tag->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">@lang('No tags found.')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        {{ $tags->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">@lang('Edit Tag')</h5>
                    <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateTag">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editFrName">@lang('French Tag Name')</label>
                            <input type="text" wire:model="editFrName"
                                class="form-control @error('editFrName') is-invalid @enderror" id="editFrName">
                            @error('editFrName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="editEnName">@lang('English Tag Name')</label>
                            <input type="text" wire:model="editEnName"
                                class="form-control @error('editEnName') is-invalid @enderror" id="editEnName">
                            @error('editEnName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="closeModal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="updateTag">@lang('Update')</span>
                            <span wire:loading wire:target="updateTag">@lang('Processing...')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">@lang('Delete Tag')</h5>
                    <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to delete this tag? This action cannot be undone.')</p>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="closeModal()">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteTag">
                        <span wire:loading.remove wire:target="deleteTag">@lang('Delete')</span>
                        <span wire:loading wire:target="deleteTag">@lang('Processing...')</span>
                    </button>
                </div> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="closeModal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteTag"    wire:loading.attr="disabled">
                        <span wire:loading wire:target="deleteTag">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Deleting...')
                        </span>
                        <span wire:loading.remove wire:target="deleteTag">
                            <i class="fas fa-trash mr-1"></i> @lang('Delete')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openEditModal', () => {
                $('#editModal').modal('show');
            });

            Livewire.on('openDeleteModal', () => {
                $('#deleteModal').modal('show');

            });

            Livewire.on('closeModal', () => {
                ['editModal', 'deleteModal'].forEach(modalId => {

                    $('#editModal').modal('hide');
                    $('#deleteModal').modal('hide');

                });
            });
        });
    </script>
@endpush
