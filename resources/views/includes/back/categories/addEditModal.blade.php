<div wire:ignore.self class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="AddCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddCategoryLabel">
                    @if ($selectedCategory)
                        @lang('Edit Category')
                    @else
                        @lang('Add Category')
                    @endif
                </h5>
                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="{{ $selectedCategory ? 'updateCategory' : 'addCategoryModal' }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">@lang('Category name')</label>
                        <input type="text" wire:model="editName" class="form-control"
                            placeholder="{{ __('Name') }}" />
                        @error('editName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" wire:ignore>
                        <label class="control-label">@lang('Description')</label>
                        <textarea wire:model.defer="editDescription" id="editDescription" class="form-control"></textarea>
                        @error('editDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">@lang('Image')</label>
                        <input type="file" wire:model="editImage" class="form-control" id="editImage" />
                        @error('editImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div wire:loading wire:target="editImage" class="text-muted mt-2">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Uploading image...')
                        </div>
                        @if ($editImagePreview)
                            <div class="mt-2">
                                <img src="{{ $editImagePreview }}" alt="Image Preview" class="img-fluid rounded" style="max-width: 200px; max-height: 200px;">
                            </div>
                            @if ($selectedCategory && $selectedCategory->image)
                                <div class="form-check mt-2">
                                    <input type="checkbox" wire:model="deleteImage" class="form-check-input" id="deleteImage">
                                    <label class="form-check-label" for="deleteImage">@lang('Delete image')</label>
                                </div>
                                <button type="button" wire:click="deleteImage" class="btn btn-sm btn-danger mt-2">
                                    <i class="fas fa-trash mr-1"></i> @lang('Remove Image')
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal()" class="btn btn-secondary shadow-sm"
                        data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-primary shadow-sm">
                        @if ($selectedCategory)
                            @lang('Edit')
                        @else
                            @lang('Save')
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
