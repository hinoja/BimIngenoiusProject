<div>
    <!-- CSS pour les améliorations de design -->
    <style>
        .step-indicator {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .modern-textarea {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            resize: vertical;
            padding: 10px;
        }

        .btn-cancel {
            background-color: #d3d3d3;
            color: #333;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #c0c0c0;
        }

        .btn-back {
            background-color: #add8e6;
            color: #333;
            border: none;
        }

        .btn-back:hover {
            background-color: #87ceeb;
        }

        .img-fluid {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .tag-selector {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .tag-item {
            display: inline-block;
            margin: 5px;
            padding: 5px 10px;
            background-color: #e9ecef;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tag-item:hover {
            background-color: #dee2e6;
        }

        .tag-item.selected {
            background-color: #007bff;
            color: white;
        }

        trix-editor {
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            margin-top: 5px;
        }

        trix-toolbar {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            border: 1px solid #ced4da;
            border-bottom: none;
        }

        /* Style pour les erreurs Trix */
        .trix-error {
            border-color: #dc3545;
        }

        .trix-error trix-toolbar {
            border-color: #dc3545;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        .delete-button {
            top: 5px;
            right: 5px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
    </style>

    <!-- Indicateur d'étape -->
    <div class="step-indicator">
        @lang('Step') {{ $step }} @lang('of') {{ $totalSteps }}:
        @if ($step == 1)
            @lang('Basic Information')
        @elseif($step == 2)
            @lang('Project Details')
        @elseif($step == 3)
            @lang('Project Status and Category')
        @elseif($step == 4)
            @lang('Project Images and Tags')
        @endif
    </div>

    <form wire:submit.prevent="{{ $step == $totalSteps ? 'updateProject' : 'nextStep' }}">
        <!-- Step 1: Basic Information -->
        @if ($step == 1)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_title" class="font-weight-bold text-dark">@lang('French Title') <span
                                class="text-danger">*</span></label>
                        <input type="text" wire:model="fr_title"
                            class="form-control @error('fr_title') is-invalid @enderror" id="fr_title"
                            placeholder="@lang('Enter the French title')" required>
                        @error('fr_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_title" class="font-weight-bold text-dark">@lang('English Title') <span
                                class="text-danger">*</span></label>
                        <input type="text" wire:model="en_title"
                            class="form-control @error('en_title') is-invalid @enderror" id="en_title"
                            placeholder="@lang('Enter the English title')" required>
                        @error('en_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_description" class="font-weight-bold text-dark">@lang('French Description') <span
                                class="text-danger">*</span></label>
                        <div wire:ignore x-data="{
                            init() {
                                this.$nextTick(() => {
                                    if (this.$refs.trix && this.$refs.trix.editor) {
                                        this.$refs.trix.editor.loadHTML(@this.get('fr_description') || '');
                                    }
                                });
                            }
                        }">
                            <input id="fr_description_input" type="hidden" name="fr_description">
                            <trix-editor x-ref="trix" input="fr_description_input"
                                @trix-change="$wire.set('fr_description', $event.target.value)"
                                class="trix-content @error('fr_description') trix-error @enderror"></trix-editor>
                        </div>
                        @error('fr_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_description" class="font-weight-bold text-dark">@lang('English Description') <span
                                class="text-danger">*</span></label>
                        <div wire:ignore x-data="{
                            init() {
                                this.$nextTick(() => {
                                    if (this.$refs.trix && this.$refs.trix.editor) {
                                        this.$refs.trix.editor.loadHTML(@this.get('en_description') || '');
                                    }
                                });
                            }
                        }">
                            <input id="en_description_input" type="hidden" name="en_description">
                            <trix-editor x-ref="trix" input="en_description_input"
                                @trix-change="$wire.set('en_description', $event.target.value)"
                                class="trix-content @error('en_description') trix-error @enderror"></trix-editor>
                        </div>
                        @error('en_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 2: Project Details -->
        @if ($step == 2)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="country" class="font-weight-bold text-dark">@lang('Country') <span
                                class="text-danger">*</span></label>
                        <input type="text" wire:model="country"
                            class="form-control @error('country') is-invalid @enderror" id="country"
                            placeholder="@lang('Enter the country')" required>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="city" class="font-weight-bold text-dark">@lang('City') <span
                                class="text-danger">*</span></label>
                        <input type="text" wire:model="city" class="form-control @error('city') is-invalid @enderror"
                            id="city" placeholder="@lang('Enter the city')" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="plan_id" class="font-weight-bold text-dark">
                            @lang('Associated Project Plan')
                        </label>
                        <select wire:model="plan_id" class="form-control @error('plan_id') is-invalid @enderror"
                            id="plan_id">
                            <option value="">@lang('Select the existing plan related to this project')</option>
                            @if (isset($plans) && count($plans) > 0)
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ __($plan->title) }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('plan_id')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="address" class="font-weight-bold text-dark">@lang('Address')</label>
                        <input type="text" wire:model="address"
                            class="form-control @error('address') is-invalid @enderror" id="address"
                            placeholder="@lang('Enter the address')">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 3: Project Status and Category -->
        @if ($step == 3)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status" class="font-weight-bold text-dark">@lang('Status') <span
                                class="text-danger">*</span></label>
                        <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                            id="status" required>
                            <option value="">@lang('Select a status')</option>
                            @if (isset($statuses) && count($statuses) > 0)
                                @foreach ($statuses as $statusOption)
                                    <option value="{{ $statusOption->value }}">{{ __($statusOption->name) }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="size" class="font-weight-bold text-dark">@lang('Size')</label>
                        <select wire:model="size" class="form-control @error('size') is-invalid @enderror"
                            id="size">
                            <option value="">@lang('Select a size')</option>
                            @if (isset($sizes) && count($sizes) > 0)
                                @foreach ($sizes as $sizeOption)
                                    <option value="{{ $sizeOption->value }}">{{ __($sizeOption->name) }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('size')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="start_date" class="font-weight-bold text-dark">@lang('Start Date')</label>
                        <input type="date" wire:model="start_date"
                            class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="end_date" class="font-weight-bold text-dark">@lang('End Date')</label>
                        <input type="date" wire:model="end_date"
                            class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="category_id" class="font-weight-bold text-dark">@lang('Category') <span
                                class="text-danger">*</span></label>
                        <select wire:model="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                            required>
                            <option value="">@lang('Select a category')</option>
                            @if (isset($categories) && count($categories) > 0)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if (isset($status) && defined('App\Enums\StatusEnums::Idea') && $status === \App\Enums\StatusEnums::Idea->value)
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="plan_id_idea" class="font-weight-bold text-dark">@lang('Plan')</label>
                            <select wire:model="plan_id" class="form-control @error('plan_id') is-invalid @enderror"
                                id="plan_id_idea">
                                <option value="">@lang('Select a plan')</option>
                                @if (isset($plans) && count($plans) > 0)
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name ?? $plan->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('plan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Step 4: Project Images and Tags -->
        @if ($step == 4)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="images" class="font-weight-bold text-dark">@lang('Project Images')</label>
                        <input type="file" wire:model="images"
                            class="form-control @error('images') is-invalid @enderror" id="images" multiple
                            accept="image/*">
                        <small class="form-text text-muted">@lang('You can select multiple images. Maximum size: 2MB per image.')</small>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Preview of new images -->
            @if (isset($images) && count($images) > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="font-weight-bold">@lang('New Images Preview')</h5>
                        <div class="row">
                            @foreach ($images as $index => $image)
                                <div class="col-md-3 mb-3">
                                    <div class="position-relative">
                                        @if (method_exists($image, 'temporaryUrl'))
                                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid image-preview"
                                                alt="Preview">
                                        @else
                                            <div class="alert alert-warning">@lang('Image preview not available')</div>
                                        @endif
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute delete-button"
                                            wire:click="removeImage({{ $index }})" title="@lang('Remove image')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Existing images -->
            @if (isset($existingImages) && count($existingImages) > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="font-weight-bold">@lang('Existing Images')</h5>
                        <div class="row">
                            @foreach ($existingImages as $image)
                                <div class="col-md-3 mb-3">
                                    <div class="position-relative">
                                        @if (isset($image['name']))
                                            <img src="{{ Storage::url($image['name']) }}"
                                                class="img-fluid image-preview"
                                                alt="{{ $image['original_name'] ?? basename($image['name']) }}">
                                        @endif
                                        @if (isset($image['id']))
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute delete-button"
                                                wire:click="deleteExistingImage({{ $image['id'] }})"
                                                title="@lang('Delete image')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tags selection -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">@lang('Project Tags')</label>
                        <div class="tag-selector">
                            @if (isset($tags) && count($tags) > 0)
                                @foreach ($tags as $tag)
                                    <div class="tag-item {{ in_array($tag->id, $selectedTags ?? []) ? 'selected' : '' }}"
                                        wire:click="toggleTag({{ $tag->id }})"
                                        data-tag-id="{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">@lang('No tags available')</p>
                            @endif
                        </div>
                        @error('selectedTags')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Navigation buttons -->
        <div class="d-flex justify-content-between mt-4">
            <div>
                @if ($step > 1)
                    <button type="button" class="btn btn-back" wire:click="previousStep">
                        <i class="fas fa-arrow-left mr-1"></i> @lang('Previous')
                    </button>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-cancel mr-2">
                    <i class="fas fa-times mr-1"></i> @lang('Cancel')
                </a>
                @if ($step < $totalSteps)
                    <button type="submit" class="btn btn-primary">
                        @lang('Next') <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                @else
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> @lang('Update Project')
                    </button>
                @endif
            </div>
        </div>
    </form>

    <!-- Messages de session -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

@push('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        // Désactiver le téléchargement de fichiers dans Trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // Gérer les erreurs de chargement d'images
        document.addEventListener('livewire:load', function() {
            // Gérer les erreurs d'images
            document.querySelectorAll('img').forEach(function(img) {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'alert alert-warning';
                    errorDiv.textContent = 'Image non disponible';
                    this.parentNode.insertBefore(errorDiv, this);
                });
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
@endpush
