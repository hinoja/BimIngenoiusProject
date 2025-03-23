
 <div wire:ignore.self class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategory">@lang('Delete Category') <strong>{{ $name }}</strong></h5>
                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger font-weight-bold">@lang('Are you sure you want to delete this category?')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>
                <button type="button" wire:click="destroyCategory()" class="btn btn-danger">@lang('Confirmer')</button>
            </div>
        </div>
    </div>

</div>
