
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
    </style>

    <h2 class="mb-4">@lang('Add New Project')</h2>
    <div class="step-indicator mb-3">
        <span class="step-number">Étape {{ $step }} de {{ $totalSteps }}</span>
    </div>

    <form wire:submit.prevent="{{ $step == $totalSteps ? 'addProject' : 'nextStep' }}">
        <!-- Step 1: Basic Information -->
        @if ($step == 1)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_title" class="font-weight-bold text-dark">@lang('French Title')</label>
                        <input type="text" wire:model="fr_title" class="form-control @error('fr_title') is-invalid @enderror" id="fr_title" placeholder="@lang('Enter the French title')">
                        @error('fr_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_title" class="font-weight-bold text-dark">@lang('English Title')</label>
                        <input type="text" wire:model="en_title" class="form-control @error('en_title') is-invalid @enderror" id="en_title" placeholder="@lang('Enter the English title')">
                        @error('en_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="fr_description" class="font-weight-bold text-dark">@lang('French Description')</label>
                        <textarea wire:model="fr_description" class="form-control modern-textarea @error('fr_description') is-invalid @enderror" id="fr_description" rows="6" placeholder="@lang('Enter the French description')"></textarea>
                        @error('fr_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="en_description" class="font-weight-bold text-dark">@lang('English Description')</label>
                        <textarea wire:model="en_description" class="form-control modern-textarea @error('en_description') is-invalid @enderror" id="en_description" rows="6" placeholder="@lang('Enter the English description')"></textarea>
                        @error('en_description')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                        <label for="country" class="font-weight-bold text-dark">@lang('Country')</label>
                        <input type="text" wire:model="country" class="form-control @error('country') is-invalid @enderror" id="country" placeholder="@lang('Enter the country')">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="city" class="font-weight-bold text-dark">@lang('City')</label>
                        <input type="text" wire:model="city" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="@lang('Enter the city')">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="address" class="font-weight-bold text-dark">@lang('Address')</label>
                        <input type="text" wire:model="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="@lang('Enter the address')">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <!-- Step 3: Project Attributes -->
        @if ($step == 3)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status" class="font-weight-bold text-dark">@lang('Status')</label>
                        <select wire:model="status" class="form-control @error('status') is-invalid @enderror" id="status">
                            <option value="">@lang('Select a status')</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}">{{ __($status->value) }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="size" class="font-weight-bold text-dark">@lang('Size')</label>
                        <select wire:model="size" class="form-control @error('size') is-invalid @enderror" id="size">
                            <option value="">@lang('Select a size')</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->value }}">{{ __($size->value) }}</option>
                            @endforeach
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
                        <input type="date" wire:model="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="end_date" class="font-weight-bold text-dark">@lang('End Date')</label>
                        <input type="date" wire:model="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="category_id" class="font-weight-bold text-dark">@lang('Category')</label>
                <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    <option value="">@lang('Select a category')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <!-- Step 4: Tags -->
        @if ($step == 4)
            <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">@lang('Tags')</label>
                <div class="row">
                    @foreach ($tags as $tag)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}" class="form-check-input" id="tag-{{ $tag->id }}">
                                <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Step 5: Images -->
        @if ($step == 5)
            <div class="form-group mb-3">
                <label class="font-weight-bold text-dark">@lang('Images')</label>
                <input type="file" wire:model="images" class="form-control @error('images.*') is-invalid @enderror" multiple>
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if (!empty($images))
                <div class="row">
                    @foreach ($images as $index => $image)
                        <div class="col-md-3 mb-3 position-relative">
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded shadow-sm" style="max-height: 100px; object-fit: cover;">
                            <button type="button" wire:click="removeImage({{ $index }})" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Navigation Buttons -->
        <div class="text-right mt-4">
            @if ($step > 1)
                <button type="button" wire:click="previousStep" class="btn btn-back mr-2">@lang('Back')</button>
            @endif
            @if ($step < $totalSteps)
                <button type="submit" class="btn btn-primary">@lang('Next')</button>
            @else
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> @lang('Create')</button>
            @endif
            <a href="{{ route('admin.projects.index') }}" class="btn btn-cancel ml-2">@lang('Cancel')</a>
        </div>
    </form>

    <!-- SweetAlert2 Integration -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('project-created', event => {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: event.detail.message,
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
</div>
