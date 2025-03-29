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
                    <span aria-hidden="true">×</span>
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
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal()" class="btn btn-secondary"
                        data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-primary">
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
