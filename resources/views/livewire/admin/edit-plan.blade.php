<div class="container py-8">
    <div class="plan-form-container">
        <h2 class="form-title mb-4 text-center">@lang('Edit Plan')</h2>
        <div class="steps-indicator mb-4">
            <div class="progress" style="height: 3px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $step == 1 ? 50 : 100 }}%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="step {{ $step == 1 ? 'active' : '' }}">@lang('Basic Information')</span>
                <span class="step {{ $step == 2 ? 'active' : '' }}">@lang('Images Management')</span>
            </div>
        </div>

        <form wire:submit.prevent="updatePlan">
            @if ($step == 1)
                <!-- Étape 1 : Informations de base -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fr_title" class="font-weight-bold text-dark mb-2">@lang('French Title')</label>
                            <input type="text" wire:model="fr_title"
                                class="form-control @error('fr_title') is-invalid @enderror" id="fr_title"
                                placeholder="@lang('Enter the French title')">
                            @error('fr_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="en_title" class="font-weight-bold text-dark mb-2">@lang('English Title')</label>
                            <input type="text" wire:model="en_title"
                                class="form-control @error('en_title') is-invalid @enderror" id="en_title"
                                placeholder="@lang('Enter the English title')">
                            @error('en_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fr_description" class="font-weight-bold text-dark mb-2">@lang('French Description')</label>
                            <input minlength="50" id="fr_description" type="hidden" wire:model.defer="fr_description">
                            <trix-editor x-data x-init="$refs.trix.editor.loadHTML(@this.get('fr_description') || '')" x-ref="trix" input="fr_description"
                                @trix-change="$wire.set('fr_description', $event.target.value)"
                                class="form-control trix-content @error('fr_description') is-invalid @enderror"></trix-editor>
                            @error('fr_description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="en_description" class="font-weight-bold text-dark mb-2">@lang('English Description')</label>
                            <input minlength="50" id="en_description" type="hidden" wire:model.defer="en_description">
                            <trix-editor x-data x-init="$refs.trix.editor.loadHTML(@this.get('en_description') || '')" x-ref="trix" input="en_description"
                                @trix-change="$wire.set('en_description', $event.target.value)"
                                class="form-control trix-content @error('en_description') is-invalid @enderror"></trix-editor>
                            @error('en_description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" wire:model="is_active">
                        <label class="custom-control-label" for="is_active">@lang('Publish Plan Immediately')</label>
                    </div>
                    @error('is_active')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="button" wire:click="nextStep" class="btn btn-primary mr-3">@lang('Next')</button>
                </div>
            @elseif ($step == 2)
                <!-- Étape 2 : Gestion des images -->
                @if ($existing2DImage && !in_array($existing2DImage['id'], $imagesToDelete))
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark mb-2">@lang('Existing 2D Image')</label>
                        <div class="d-flex flex-wrap">
                            <div class="image-preview-container">
                                <img src="{{ Storage::url($existing2DImage['path']) }}" class="image-preview" alt="Existing 2D Image">
                                <span class="remove-image" wire:click="removeExisting2DImage({{ $existing2DImage['id'] }})">×</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($existing3DImages))
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark mb-2">@lang('Existing 3D Images')</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($existing3DImages as $image)
                                @if (!in_array($image['id'], $imagesToDelete))
                                    <div class="image-preview-container">
                                        <img src="{{ Storage::url($image['path']) }}" class="image-preview" alt="Existing 3D Image">
                                        <span class="remove-image" wire:click="removeExisting3DImage({{ $image['id'] }})">×</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark mb-2">@lang('Update 2D Image')</label>
                    <div class="custom-file">
                        <input type="file" wire:model="image2D" class="custom-file-input @error('image2D') is-invalid @enderror" id="image2D">
                        <label class="custom-file-label" for="image2D">@lang('Choose 2D image')</label>
                        @error('image2D')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($image2D)
                        <div class="image-preview-container mt-3">
                            <img src="{{ $image2D->temporaryUrl() }}" class="image-preview" alt="2D Image Preview">
                            <span class="remove-image" wire:click="removeNew2DImage">×</span>
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark mb-2">@lang('Add 3D Images')</label>
                    <div class="custom-file">
                        <input type="file" wire:model="images" multiple class="custom-file-input @error('images') is-invalid @enderror" id="images">
                        <label class="custom-file-label" for="images">@lang('Choose 3D images (multiple)')</label>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!empty($images))
                        <div class="mt-3 d-flex flex-wrap">
                            @foreach ($images as $index => $image)
                                <div class="image-preview-container">
                                    <img src="{{ $image->temporaryUrl() }}" class="image-preview" alt="Preview {{ $index + 1 }}">
                                    <span class="remove-image" wire:click="removeImage({{ $index }})">×</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="text-center">
                    <button type="button" wire:click="previousStep" class="btn btn-cancel mr-3">@lang('Previous')</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="updatePlan">
                            <i class="fas fa-spinner fa-spin mr-2"></i>@lang('Updating...')
                        </span>
                        <span wire:loading.remove wire:target="updatePlan">
                            <i class="fas fa-save mr-2"></i>@lang('Update Plan')
                        </span>
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        .plan-form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .form-title {
            color: #2A2E45;
            font-weight: 700;
            font-size: 2rem;
        }

        .steps-indicator .progress-bar {
            background-color: #FF6B35;
        }

        .step {
            padding: 8px 16px;
            border-radius: 20px;
            background: #f0f0f0;
            color: #666;
        }

        .step.active {
            background: #FF6B35;
            color: white;
        }

        .form-control:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.3);
        }

        .trix-content {
            height: auto !important;
        }

        trix-editor.form-control {
            height: auto;
            min-height: 200px;
            padding: .375rem .75rem;
        }

        trix-editor.is-invalid {
            border-color: #dc3545;
        }

        .image-preview-container {
            position: relative;
            margin: 10px;
        }

        .image-preview {
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #FF6B35;
        }

        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #FF6B35;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e65a2e;
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #2A2E45;
        }

        @media (max-width: 768px) {
            .image-preview {
                max-height: 100px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush