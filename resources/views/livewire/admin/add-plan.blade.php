<div class="container py-8">
    <div class="plan-form-container">
        <h2 class="form-title mb-4 text-center">@lang('Add New Plan')</h2>
        <div class="steps-indicator mb-4">
            <div class="progress" style="height: 3px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $step * 100 }}%">
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="step {{ $step == 1 ? 'active' : '' }}">
                    @lang('Basic Information')
                </span>
                <span class="step {{ $step > 1 ? 'active' : '' }}">
                    @lang('Images Upload')
                </span>
            </div>
        </div>
        <form wire:submit.prevent="addPlan">
            @if ($step == 1)
                <!-- Step 1: Textual Data -->
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
                            <label for="fr_description"
                                class="font-weight-bold text-dark mb-2">@lang('French Description')</label>
                            <textarea wire:model="fr_description" class="form-control modern-textarea summernote" id="fr_description"
                                placeholder="@lang('Enter the French description')"></textarea>
                            @error('fr_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="en_description"
                                class="font-weight-bold text-dark mb-2">@lang('English Description')</label>
                            <textarea wire:model="en_description" class="form-control modern-textarea summernote" id="en_description"
                                placeholder="@lang('Enter the English description')"></textarea>
                            @error('en_description')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                    <button type="button" wire:click="nextStep"
                        class="btn btn-primary mr-3">@lang('Next')</button>
                </div>
            @elseif ($step == 2)
                <!-- Step 2: Image Uploads -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark mb-2">@lang('2D Image')</label>
                    <div class="custom-file">
                        <input type="file" wire:model="image2D"
                            class="custom-file-input @error('image2D') is-invalid @enderror" id="image2D">
                        <label class="custom-file-label" for="image2D">@lang('Choose 2D image')</label>
                        @error('image2D')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($image2D)
                        <div class="image-preview-container mt-3">
                            <img src="{{ $image2D->temporaryUrl() }}" class="image-preview" alt="2D Image Preview">
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark mb-2">@lang('3D Images')</label>
                    <div class="custom-file">
                        <input type="file" wire:model="images" multiple
                            class="custom-file-input @error('images.*') is-invalid @enderror" id="images">
                        <label class="custom-file-label" for="images">@lang('Choose 3D images (multiple)')</label>
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!empty($images))
                        <div class="mt-3 d-flex flex-wrap">
                            @foreach ($images as $index => $image)
                                <div class="image-preview-container">
                                    <img src="{{ $image->temporaryUrl() }}" class="image-preview"
                                        alt="Preview {{ $index + 1 }}">
                                    <span class="remove-image" wire:click="removeImage({{ $index }})">×</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="text-center">
                    <button type="button" wire:click="previousStep"
                        class="btn btn-cancel mr-3">@lang('Previous')</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="addPlan">
                            <i class="fas fa-spinner fa-spin mr-2"></i>@lang('Creating...')
                        </span>
                        <span wire:loading.remove wire:target="addPlan">
                            <i class="fas fa-plus-circle mr-2"></i>@lang('Create Plan')
                        </span>
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .step-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        .img-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin: 5px;
        }

        .steps-indicator {
            margin-bottom: 2rem;
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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .plan-form-container {
                padding: 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .image-preview {
                max-height: 100px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
