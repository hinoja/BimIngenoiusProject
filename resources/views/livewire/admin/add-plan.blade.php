<div>
    <style>
        /* Conteneur principal */
        .plan-form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
            border: 2px solid #FF6B35;
            animation: slideIn 0.5s ease-in-out;
        }

        /* Champs de formulaire */
        .form-control:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.3);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.9rem;
            color: #dc3545;
        }

        .modern-textarea {
            resize: vertical;
            min-height: 120px;
            transition: border-color 0.3s ease;
        }

        /* Checkbox personnalisée */
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #FF6B35;
            border-color: #FF6B35;
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 4px;
        }

        /* Prévisualisation d'image */
        .image-preview-container {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .image-preview {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 150px;
            object-fit: cover;
            border: 2px solid #FF6B35;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
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
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .remove-image:hover {
            transform: scale(1.1);
            background-color: #c82333;
        }

        /* Boutons */
        .btn {
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #FF6B35;
            border: none;
            color: #F8F9FA;
        }

        .btn-primary:hover {
            background-color: #e65a2e;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #2A2E45;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #c0c0c0;
            color: #2A2E45;
        }

        /* Animation d'entrée */
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

        /* Responsive */
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

    <div class="plan-form-container">
        <h2 class="form-title mb-4 text-center">@lang('Add New Plan')</h2>

        <form wire:submit.prevent="addPlan">
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
                        <textarea wire:model="fr_description" class="form-control modern-textarea @error('fr_description') is-invalid @enderror"
                            id="fr_description" placeholder="@lang('Enter the French description')"></textarea>
                        @error('fr_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="en_description" class="font-weight-bold text-dark mb-2">@lang('English Description')</label>
                        <textarea wire:model="en_description" class="form-control modern-textarea @error('en_description') is-invalid @enderror"
                            id="en_description" placeholder="@lang('Enter the English description')"></textarea>
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

            <div class="form-group mb-4">
                <label class="font-weight-bold text-dark mb-2">@lang('Images')</label>
                <div class="custom-file">
                    <input type="file" wire:model="images" multiple
                        class="custom-file-input @error('images.*') is-invalid @enderror" id="images">
                    <label class="custom-file-label" for="images">@lang('Choose images (multiple)')</label>
                    @error('images.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                @if (!empty($images))
                    <div class="mt-3 d-flex flex-wrap">
                        @foreach ($images as $index => $image)
                            <div class="image-preview-container">
                                <img src="{{ $image->temporaryUrl() }}" class="image-preview"
                                    alt="Preview {{ $index + 1 }}">
                                <span class="remove-image" wire:click="removeImage({{ $index }})">&times;</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-3" wire:loading.attr="disabled">
                    <span wire:loading wire:target="addPlan">
                        <i class="fas fa-spinner fa-spin mr-2"></i>@lang('Creating...')
                    </span>
                    <span wire:loading.remove wire:target="addPlan">
                        <i class="fas fa-plus-circle mr-2"></i>@lang('Create Plan')
                    </span>
                </button>
                <a href="{{ route('admin.plans.index') }}" class="btn btn-cancel">@lang('Cancel')</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.querySelector('.custom-file-input');
            fileInput.addEventListener('change', function() {
                const fileCount = this.files.length;
                const label = fileCount > 0 ? `${fileCount} @lang('files selected')` : '@lang('Choose images (multiple)')';
                this.nextElementSibling.textContent = label;
            });
        });
    </script>
@endpush
