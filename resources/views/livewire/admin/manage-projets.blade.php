<div class="container">
    <div class="row justify-content-center">
        <!-- Bouton pour ajouter un projet -->
        <div class="col-12 mb-3 text-right">
            <button wire:click="showCreateForm" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-1"></i> @lang('Add New Project')
            </button>
        </div>

        <!-- Liste des projets -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">@lang('Title (FR)')</th>
                                    <th scope="col">@lang('Company')</th>
                                    <th scope="col">@lang('Category')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Images')</th>
                                    <th scope="col">@lang('Start Date')</th>
                                    <th scope="col">@lang('End Date')</th>
                                    <th scope="col" class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $project->fr_title }}</td>
                                        <td>{{ $project->company }}</td>
                                        <td>{{ $project->category->name }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $project->status->value === 'completed' ? 'badge-success' : ($project->status->value === 'in_progress' ? 'badge-warning' : 'badge-secondary') }}">
                                                {{ __($project->status->value) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                <i class="fas fa-image mr-1"></i> {{ $project->images->count() }}
                                            </span>
                                        </td>
                                        <td>{{ $project->formatted_start_date }}</td>
                                        <td>{{ $project->formatted_end_date }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="showDetails({{ $project->id }})" type="button"
                                                    class="btn btn-sm btn-info mr-1" data-toggle="tooltip"
                                                    title="@lang('View Details')" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="showDetails({{ $project->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                    <span wire:loading.remove
                                                        wire:target="showDetails({{ $project->id }})">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </button>
                                                <button wire:click="showEditForm({{ $project->id }})" type="button"
                                                    class="btn btn-sm btn-primary mr-1" data-toggle="tooltip"
                                                    title="@lang('Edit')" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="showEditForm({{ $project->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                    <span wire:loading.remove
                                                        wire:target="showEditForm({{ $project->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <button wire:click="showDeleteForm({{ $project->id }})" type="button"
                                                    class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                    title="@lang('Delete')" wire:loading.attr="disabled">
                                                    <span wire:loading
                                                        wire:target="showDeleteForm({{ $project->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                    <span wire:loading.remove
                                                        wire:target="showDeleteForm({{ $project->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            @lang('No projects found.')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        {{ $projects->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour l'ajout/édition -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">
                        @if ($isEditing)
                            @lang('Edit Project')
                        @else
                            @lang('Add Project')
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'updateProject' : 'addProject' }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_fr_title"
                                        class="font-weight-bold text-dark">@lang('French Title')</label>
                                    <input type="text" wire:model="fr_title"
                                        class="form-control @error('fr_title') is-invalid @enderror" id="modal_fr_title"
                                        placeholder="@lang('Enter the French title')">
                                    @error('fr_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_en_title"
                                        class="font-weight-bold text-dark">@lang('English Title')</label>
                                    <input type="text" wire:model="en_title"
                                        class="form-control @error('en_title') is-invalid @enderror" id="modal_en_title"
                                        placeholder="@lang('Enter the English title')">
                                    @error('en_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_fr_description"
                                        class="font-weight-bold text-dark">@lang('French Description')</label>
                                    <textarea wire:model="fr_description" class="form-control @error('fr_description') is-invalid @enderror"
                                        id="modal_fr_description" rows="3" placeholder="@lang('Enter the French description')"></textarea>
                                    @error('fr_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_en_description"
                                        class="font-weight-bold text-dark">@lang('English Description')</label>
                                    <textarea wire:model="en_description" class="form-control @error('en_description') is-invalid @enderror"
                                        id="modal_en_description" rows="3" placeholder="@lang('Enter the English description')"></textarea>
                                    @error('en_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_company"
                                        class="font-weight-bold text-dark">@lang('Company')</label>
                                    <input type="text" wire:model="company"
                                        class="form-control @error('company') is-invalid @enderror" id="modal_company"
                                        placeholder="@lang('Enter the company name')">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_country"
                                        class="font-weight-bold text-dark">@lang('Country')</label>
                                    <input type="text" wire:model="country"
                                        class="form-control @error('country') is-invalid @enderror" id="modal_country"
                                        placeholder="@lang('Enter the country')">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_city"
                                        class="font-weight-bold text-dark">@lang('City')</label>
                                    <input type="text" wire:model="city"
                                        class="form-control @error('city') is-invalid @enderror" id="modal_city"
                                        placeholder="@lang('Enter the city')">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_address"
                                        class="font-weight-bold text-dark">@lang('Address')</label>
                                    <input type="text" wire:model="address"
                                        class="form-control @error('address') is-invalid @enderror" id="modal_address"
                                        placeholder="@lang('Enter the address')">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_status"
                                        class="font-weight-bold text-dark">@lang('Status')</label>
                                    <select wire:model="status"
                                        class="form-control @error('status') is-invalid @enderror" id="modal_status">
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
                                    <label for="modal_size"
                                        class="font-weight-bold text-dark">@lang('Size')</label>
                                    <select wire:model="size" class="form-control @error('size') is-invalid @enderror"
                                        id="modal_size">
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
                                    <label for="modal_start_date"
                                        class="font-weight-bold text-dark">@lang('Start Date')</label>
                                    <input type="date" wire:model="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        id="modal_start_date">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="modal_end_date"
                                        class="font-weight-bold text-dark">@lang('End Date')</label>
                                    <input type="date" wire:model="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        id="modal_end_date">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="modal_category_id"
                                class="font-weight-bold text-dark">@lang('Category')</label>
                            <select wire:model="category_id"
                                class="form-control @error('category_id') is-invalid @enderror"
                                id="modal_category_id">
                                <option value="">@lang('Select a category')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gestion des images -->
                         <div class="form-group mb-3">
    <label class="font-weight-bold text-dark">@lang('Images')</label>

    <div x-data="{ isUploading: false }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false">

        <div class="custom-file">
            <input type="file" wire:model="images"
                   class="custom-file-input @error('images.*') is-invalid @enderror"
                   id="images" multiple
                   accept="image/*">
            <label class="custom-file-label" for="images">
                @lang('Choose images...')
            </label>
        </div>

        <!-- Indicateur de chargement -->
        <div x-show="isUploading" class="mt-2">
            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            <span class="ml-2 text-primary">@lang('Uploading...')</span>
        </div>

        <!-- Prévisualisation -->
        @if ($images)
            <div class="mt-3">
                <div class="row">
                    @foreach ($images as $index => $image)
                        <div class="col-md-3 mb-3 position-relative">
                            <img src="{{ $image->temporaryUrl() }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 100px; object-fit: cover;">
                            <button type="button"
                                    wire:click="removeImage({{ $index }})"
                                    class="btn btn-danger btn-sm position-absolute"
                                    style="top: 5px; right: 5px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @error('images.*')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            @if ($isEditing)
                                <span wire:loading wire:target="updateProject">
                                    <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Updating...')
                                </span>
                                <span wire:loading.remove wire:target="updateProject">
                                    <i class="fas fa-save mr-1"></i> @lang('Update')
                                </span>
                            @else
                                <span wire:loading wire:target="addProject">
                                    <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Adding...')
                                </span>
                                <span wire:loading.remove wire:target="addProject">
                                    <i class="fas fa-plus-circle mr-1"></i> @lang('Add')
                                </span>
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour la suppression -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProjectModalLabel">@lang('Delete Project')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('Are you sure you want to delete the project') <strong>{{ $fr_title }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="destroyProject"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="destroyProject">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Deleting...')
                        </span>
                        <span wire:loading.remove wire:target="destroyProject">
                            <i class="fas fa-trash mr-1"></i> @lang('Delete')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour les détails -->
    <div class="modal fade" id="detailsProjectModal" tabindex="-1" aria-labelledby="detailsProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsProjectModalLabel">@lang('Project Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedProject)
                        <!-- Carrousel pour les images -->
                        @if ($selectedProject->images->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="text-muted">@lang('Images')</h6>
                                <div id="projectImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($selectedProject->images as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image->name) }}"
                                                    class="d-block w-100 rounded image-lightbox"
                                                    style="max-height: 400px; object-fit: cover;"
                                                    alt="@lang('Project Image')"
                                                    data-fullscreen="{{ asset('storage/' . $image->name) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="carousel-indicators">
                                        @foreach ($selectedProject->images as $index => $image)
                                            <button type="button" data-bs-target="#projectImagesCarousel"
                                                data-bs-slide-to="{{ $index }}"
                                                class="{{ $index === 0 ? 'active' : '' }}"
                                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-label="@lang('Slide') {{ $index + 1 }}">
                                                <img src="{{ asset('storage/' . $image->name) }}"
                                                    class="d-block w-100 rounded"
                                                    style="max-height: 50px; object-fit: cover;">
                                            </button>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#projectImagesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">@lang('Previous')</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#projectImagesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">@lang('Next')</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="mb-4">
                                <h6 class="text-muted">@lang('Images')</h6>
                                <p class="text-muted">@lang('No images available for this project.')</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted"><i class="fas fa-flag mr-1"></i> @lang('French Title')</h6>
                                <p class="font-weight-bold">{{ $selectedProject->fr_title }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('English Title')</h6>
                                <p class="font-weight-bold">{{ $selectedProject->en_title }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('French Description')</h6>
                                <p>{{ $selectedProject->fr_description }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('English Description')</h6>
                                <p>{{ $selectedProject->en_description }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Company')</h6>
                                <p>{{ $selectedProject->company }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Category')</h6>
                                <p>{{ $selectedProject->category->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Country')</h6>
                                <p>{{ $selectedProject->country }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('City')</h6>
                                <p>{{ $selectedProject->city }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Address')</h6>
                                <p>{{ $selectedProject->address }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Status')</h6>
                                <p>
                                    <span
                                        class="badge {{ $selectedProject->status->value === 'completed' ? 'badge-success' : ($selectedProject->status->value === 'in_progress' ? 'badge-warning' : 'badge-secondary') }}">
                                        {{ __($selectedProject->status->value) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Size')</h6>
                                <p>
                                    <span
                                        class="badge {{ $selectedProject->size->value === 'large' ? 'badge-primary' : ($selectedProject->size->value === 'medium' ? 'badge-info' : 'badge-secondary') }}">
                                        {{ __($selectedProject->size->value) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Duration')</h6>
                                <p>{{ $selectedProject->duration }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Start Date')</h6>
                                <p>{{ $selectedProject->formatted_start_date }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('End Date')</h6>
                                <p>{{ $selectedProject->formatted_end_date }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox pour afficher les images en plein écran -->
    <div class="lightbox" id="lightbox">
        <span class="close-lightbox">&times;</span>
        <img class="lightbox-image" id="lightbox-image" src="" alt="@lang('Project Image')">
    </div>
</div>

@push('css')
    <style>
        /* Amélioration du tableau */
        .table thead th {
            background-color: #2A2E45;
            color: #F8F9FA;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: 2px solid #FF6B35;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .btn-group .btn {
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
        }

        /* Style des modals */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-footer {
            border-top: 2px solid #FF6B35;
        }

        .modal-body h6 {
            font-size: 0.9rem;
            color: #6C757D;
            margin-bottom: 0.5rem;
        }

        .modal-body p {
            font-size: 1rem;
            color: #2A2E45;
            margin-bottom: 1rem;
        }

        .modal-body hr {
            border-top: 1px solid #FF6B35;
            opacity: 0.3;
        }

        /* Style pour les images */
        .image-preview {
            position: relative;
            display: inline-block;
        }

        .image-preview img {
            transition: all 0.3s ease;
        }

        .image-preview img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .image-preview .btn-danger {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: rgba(0, 0, 0, 0.5);
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 50%;
        }

        .carousel-indicators {
            bottom: -50px;
        }

        .carousel-indicators button {
            width: 60px;
            height: 60px;
            margin: 0 5px;
            border: 2px solid #FF6B35;
            border-radius: 5px;
            overflow: hidden;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .carousel-indicators button.active {
            opacity: 1;
            border-color: #2A2E45;
        }

        /* Style pour la lightbox */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .lightbox-image {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .close-lightbox {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #F8F9FA;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close-lightbox:hover,
        .close-lightbox:focus {
            color: #FF6B35;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', () => {
                $('#projectModal').modal('show');
            });

            Livewire.on('openEditModal', () => {
                $('#projectModal').modal('show');
            });

            Livewire.on('openDeleteModal', () => {
                $('#deleteProjectModal').modal('show');
            });

            Livewire.on('openDetailsModal', () => {
                $('#detailsProjectModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#projectModal').modal('hide');
                $('#deleteProjectModal').modal('hide');
                $('#detailsProjectModal').modal('hide');
            });

            // Initialiser les tooltips
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });

            // Gestion de la lightbox
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const closeLightbox = document.querySelector('.close-lightbox');

            document.querySelectorAll('.image-lightbox').forEach(image => {
                image.addEventListener('click', () => {
                    lightbox.style.display = 'block';
                    lightboxImage.src = image.getAttribute('data-fullscreen');
                });
            });

            closeLightbox.addEventListener('click', () => {
                lightbox.style.display = 'none';
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.display = 'none';
                }
            });
        });

        // Mettre à jour le label du champ de fichier
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.querySelector('#images');
            if (fileInput) {
                fileInput.addEventListener('change', (e) => {
                    const label = e.target.nextElementSibling;
                    const files = e.target.files;
                    if (files.length > 0) {
                        label.textContent = files.length > 1 ? `${files.length} @lang('files selected')` : files[
                            0].name;
                    } else {
                        label.textContent = '@lang('Choose images...')';
                    }
                });
            }
        });
    </script>
@endpush
