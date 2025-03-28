<div>
    <style>
        /* Conteneur principal */
        .plan-form-container {
            background: #ffffff;
            border-radius: 15px;
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
        }

        /* Checkbox personnalisée */




        /* Champ de fichier */

        


        /* Prévisualisation d'image */
        .image-preview {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 150px;
            object-fit: cover;
            border: 2px solid #FF6B35;
            transition: transform 0.3s ease;
        }
        .image-preview:hover {
            transform: scale(1.05);
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
        }
    </style>

    <div class="plan-form-container">
        <h2 class="form-title">@lang('Edit Plan')</h2>

        <form wire:submit.prevent="updatePlan">
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
                        <textarea wire:model="fr_description"
                            class="form-control modern-textarea @error('fr_description') is-invalid @enderror"
                            id="fr_description" placeholder="@lang('Enter the French description')"></textarea>
                        @error('fr_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="en_description" class="font-weight-bold text-dark mb-2">@lang('English Description')</label>
                        <textarea wire:model="en_description"
                            class="form-control modern-textarea @error('en_description') is-invalid @enderror"
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
                <label class="font-weight-bold text-dark mb-2">@lang('Image')</label>
                <div class="custom-file">
                    <input type="file" wire:model="image"
                        class="custom-file-input @error('image') is-invalid @enderror" id="image">
                    <label class="custom-file-label" for="image">@lang('Choose a new image')</label>
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                @if ($image)
                    <div class="mt-3">
                        <img src="{{ $image->temporaryUrl() }}" class="image-preview" alt="New Image Preview">
                    </div>
                @elseif ($existingImage)
                    <div class="mt-3">
                        <img src="{{ Storage::url($existingImage) }}" class="image-preview" alt="Current Image">
                    </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-3">
                    <i class="fas fa-save mr-2"></i>@lang('Update Plan')
                </button>
                <a href="{{ route('admin.plans.index') }}" class="btn btn-cancel">@lang('Cancel')</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.querySelector('.custom-file-input');
            fileInput.addEventListener('change', function () {
                const fileName = this.files[0]?.name || '@lang("Choose a new image")';
                this.nextElementSibling.textContent = fileName;
            });
        });
    </script>
@endpush
