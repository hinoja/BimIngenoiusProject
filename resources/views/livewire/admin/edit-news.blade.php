<div>
    <form wire:submit.prevent="update" class="space-y-4">
        <!-- Affichage des messages d'erreur -->
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Titre en français -->
        <div class="form-group">
            <label for="fr_title">{{ __('French Title') }}</label>
            <input type="text" class="form-control @error('fr_title') is-invalid @enderror"
                   id="fr_title" wire:model="fr_title">
            @error('fr_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Titre en anglais -->
        <div class="form-group">
            <label for="en_title">{{ __('English Title') }}</label>
            <input type="text" class="form-control @error('en_title') is-invalid @enderror"
                   id="en_title" wire:model="en_title">
            @error('en_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Contenu en français -->
        <div class="form-group">
            <label for="fr_content">{{ __('French Content') }}</label>
            <textarea class="form-control summernote @error('fr_content') is-invalid @enderror"
                      id="fr_content" wire:model="fr_content"></textarea>
            @error('fr_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Contenu en anglais -->
        <div class="form-group">
            <label for="en_content">{{ __('English Content') }}</label>
            <textarea class="form-control summernote @error('en_content') is-invalid @enderror"
                      id="en_content" wire:model="en_content"></textarea>
            @error('en_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Image actuelle -->
        @if($currentImage)
            <div class="form-group">
                <label>{{ __('Current Image') }}</label>
                <div class="image-preview-container">
                    <img src="{{ Storage::url($currentImage) }}" class="img-fluid" style="max-height: 200px;">
                    <button type="button" class="btn btn-sm btn-danger" wire:click="deleteCurrentImage">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Nouvelle image -->
        <div class="form-group">
            <label for="newImage">{{ __('New Featured Image') }}</label>
            <input type="file" class="form-control @error('newImage') is-invalid @enderror"
                   id="newImage" wire:model="newImage" accept="image/*">
            @error('newImage') <div class="invalid-feedback">{{ $message }}</div> @enderror

            @if ($newImage)
                <div class="mt-2">
                    <img src="{{ $newImage->temporaryUrl() }}" class="img-fluid" style="max-height: 200px;">
                    <button type="button" class="btn btn-sm btn-danger" wire:click="removeImage">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Tags -->
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <select class="form-control @error('tags') is-invalid @enderror"
                    id="tags" wire:model="tags" multiple>
                @foreach($availableTags as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Publication -->
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="publish_now" wire:model="publish_now">
            <label class="form-check-label" for="publish_now">{{ __('Publish Now') }}</label>
        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading wire:target="update">{{ __('Updating...') }}</span>
                <span wire:loading.remove wire:target="update">{{ __('Update News') }}</span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    document.addEventListener('livewire:initialized', function() {
        initSummernote();

        Livewire.on('initSummernote', function() {
            initSummernote();
        });

        Livewire.on('contentUpdated', function(data) {
            $('#' + data.editor).summernote('code', data.content);
        });
    });

    function initSummernote() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ],
            callbacks: {
                onChange: function(contents) {
                    @this.set($(this).attr('id'), contents);
                }
            }
        });

        // Initialiser le contenu de l'éditeur
        $('#fr_content').summernote('code', @this.fr_content);
        $('#en_content').summernote('code', @this.en_content);
    }
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .image-preview-container {
        position: relative;
        display: inline-block;
    }

    .image-preview-container button {
        position: absolute;
        top: 5px;
        right: 5px;
    }
</style>
@endpush


