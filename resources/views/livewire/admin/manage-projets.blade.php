<div class="container">
    <div class="row justify-content-center">
        <!-- Bouton pour ajouter un projet -->
        <div class="col-12 mb-3 text-right">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-1"></i> @lang('Add New Project')
            </a>
        </div>

        <!-- Zone de filtre -->
        <div class="col-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="mb-0"><i class="fas fa-filter mr-2"></i>@lang('Filter Projects')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" wire:model.live="filterTitle" class="form-control"
                                    placeholder="@lang('Title')">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <select wire:model.live="filterCategory" class="form-control">
                                    <option value="">@lang('All Categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                <select wire:model.live="filterStatus" class="form-control">
                                    <option value="">@lang('All Statuses')</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}">{{ __($status->value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                <select wire:model.live="filterSize" class="form-control">
                                    <option value="">@lang('All Sizes')</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->value }}">{{ __($size->value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div wire:loading class="text-center mt-2">
                        <i class="fas fa-spinner fa-spin"></i> @lang('Loading...')
                    </div>
                </div>
            </div>
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
                                    <th scope="col">@lang('Title (FR)') <i class="fas fa-sort"></i></th>
                                    <th scope="col">@lang('Company') <i class="fas fa-sort"></i></th>
                                    <th scope="col">@lang('Category') <i class="fas fa-sort"></i></th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Images')</th>
                                    <th scope="col">@lang('Start Date') <i class="fas fa-sort"></i></th>
                                    <th scope="col">@lang('End Date') <i class="fas fa-sort"></i></th>
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
                                                class="badge {{ $project->status->value === 'completed' ? 'bg-success' : ($project->status->value === 'in_progress' ? 'bg-warning' : 'bg-secondary') }}">
                                                {{ __($project->status->value) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                <i class="fas fa-image mr-1"></i> {{ $project->images->count() }}
                                            </span>
                                        </td>
                                        <td>{{ $project->formatted_start_date }}</td>
                                        <td>{{ $project->formatted_end_date }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.projects.show', $project) }}"
                                                    class="btn btn-sm btn-info mr-1" title="@lang('View Details')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.projects.edit', $project) }}"
                                                    class="btn btn-sm btn-primary mr-1" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="showDeleteForm({{ $project->id }})"
                                                    class="btn btn-sm btn-danger" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
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

    <!-- Modal pour la suppression -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
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
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="detailsProjectModalLabel">@lang('Project Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedProject)
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
                                        class="badge {{ $selectedProject->status->value === 'completed' ? 'bg-success' : ($selectedProject->status->value === 'in_progress' ? 'bg-warning' : 'bg-secondary') }}">
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
                                        class="badge {{ $selectedProject->size->value === 'large' ? 'bg-primary' : ($selectedProject->size->value === 'medium' ? 'bg-info' : 'bg-secondary') }}">
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
        <span class="close-lightbox">×</span>
        <img class="lightbox-image" id="lightbox-image" src="" alt="@lang('Project Image')">
    </div>
</div>

@push('css')
    <style>
        .table thead th {
            background-color: #2A2E45;
            color: #F8F9FA;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: 2px solid #FF6B35;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

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
        }

        .close-lightbox:hover {
            color: #FF6B35;
        }

        .input-group-text {
            background-color: #2A2E45;
            color: #F8F9FA;
            border: 1px solid #FF6B35;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openDeleteModal', () => {
                $('#deleteProjectModal').modal('show');
            });
            Livewire.on('openDetailsModal', () => {
                $('#detailsProjectModal').modal('show');
            });
            Livewire.on('closeModal', () => {
                $('#deleteProjectModal').modal('hide');
                $('#detailsProjectModal').modal('hide');
            });

            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });

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
    </script>
@endpush
