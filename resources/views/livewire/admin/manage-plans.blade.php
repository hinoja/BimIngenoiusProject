<div class="container">
    <div class="row justify-content-center">
        <!-- Bouton pour ajouter un plan -->
        <div class="col-12 mb-3 text-right">
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-1"></i> @lang('Add New Plan')
            </a>
        </div>

        <!-- Zone de filtre -->
        <div class="col-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="mb-0"><i class="fas fa-filter mr-2"></i>@lang('Filter Plans')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" wire:model.live="filterTitle" class="form-control"
                                    placeholder="@lang('Title')">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                <select wire:model.live="filterStatus" class="form-control">
                                    <option value="">@lang('All Statuses')</option>
                                    <option value="1">@lang('Active')</option>
                                    <option value="2">@lang('Inactive')</option>
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

        <!-- Liste des plans -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">@lang('Title (FR)') <i class="fas fa-sort"></i></th>
                                    <th scope="col">@lang('Title (EN)') <i class="fas fa-sort"></i></th>
                                     <th scope="col">@lang('Auteur')</th>
                                    <th scope="col">@lang('Image')</th>
                                     <th scope="col">@lang('Published At') <i class="fas fa-sort"></i></th>
                                      <th scope="col" class="text-center">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $plan->fr_title }}</td>
                                        <td>{{ $plan->en_title }}</td>
                                        <td>{{ $plan->user ? $plan->user->name : 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                <i class="fas fa-image mr-1"></i> {{ $plan->image ? 1 : 0 }}
                                            </span>
                                        </td>

                                        <td>{{ $plan->published_at ? \Carbon\Carbon::parse($plan->published_at)->format('d M Y') : 'N/A' }}</td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.plans.show', $plan) }}"
                                                    class="btn btn-sm btn-info mr-1" title="@lang('View Details')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.plans.edit', $plan) }}"
                                                    class="btn btn-sm btn-primary mr-1" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="showPublishForm('{{ $plan->id }}')"
                                                    class="btn btn-sm {{ $plan->is_active ? 'btn-warning' : 'btn-success' }} me-2"
                                                    title="{{ $plan->is_active ? __('Unpublish') : __('Publish') }}">
                                                <i class="fas {{ $plan->is_active ? 'fa-eye-slash' : 'fa-paper-plane' }}"></i>
                                                <span class="ms-1"> </span>
                                            </button>
                                                <button wire:click="showDeleteForm({{ $plan->id }})"
                                                    class="btn btn-sm btn-danger" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            @lang('No plans found.')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        {{ $plans->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour la suppression -->
    <div class="modal fade" id="deletePlanModal" tabindex="-1" aria-labelledby="deletePlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="deletePlanModalLabel">@lang('Delete Plan')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('Are you sure you want to delete the plan') <strong>{{ $fr_title }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="destroyPlan"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="destroyPlan">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Deleting...')
                        </span>
                        <span wire:loading.remove wire:target="destroyPlan">
                            <i class="fas fa-trash mr-1"></i> @lang('Delete')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour la publication/dépublication -->
    <div class="modal fade" id="publishPlanModal" tabindex="-1" aria-labelledby="publishPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="publishPlanModalLabel">
                        @if ($isActive)
                            @lang('Unpublish Plan')
                        @else
                            @lang('Publish Plan')
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($isActive)
                        @lang('Are you sure you want to unpublish the plan') <strong>{{ $fr_title }}</strong>?
                    @else
                        @lang('Are you sure you want to publish the plan') <strong>{{ $fr_title }}</strong>?
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn {{ $isActive ? 'btn-warning' : 'btn-success' }}"
                        wire:click="confirmPublish" wire:loading.attr="disabled">
                        <span wire:loading wire:target="confirmPublish">
                            <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Processing...')
                        </span>
                        <span wire:loading.remove wire:target="confirmPublish">
                            <i class="fas {{ $isActive ? 'fa-eye-slash' : 'fa-eye' }} mr-1"></i>
                            {{ $isActive ? __('Unpublish') : __('Publish') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour les détails -->
    <div class="modal fade" id="detailsPlanModal" tabindex="-1" aria-labelledby="detailsPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="detailsPlanModalLabel">@lang('Plan Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedPlan)
                        @if ($selectedPlan->image)
                            <div class="mb-4">
                                <h6 class="text-muted">@lang('Image')</h6>
                                <div class="carousel slide" id="planImageCarousel" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/' . $selectedPlan->image) }}"
                                                class="d-block w-100 rounded image-lightbox"
                                                style="max-height: 400px; object-fit: cover;"
                                                alt="@lang('Plan Image')"
                                                data-fullscreen="{{ asset('storage/' . $selectedPlan->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mb-4">
                                <h6 class="text-muted">@lang('Image')</h6>
                                <p class="text-muted">@lang('No image available for this plan.')</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted"><i class="fas fa-flag mr-1"></i> @lang('French Title')</h6>
                                <p class="font-weight-bold">{{ $selectedPlan->fr_title }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('English Title')</h6>
                                <p class="font-weight-bold">{{ $selectedPlan->en_title }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Slug')</h6>
                                <p>{{ $selectedPlan->slug }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('User')</h6>
                                <p>{{ $selectedPlan->user ? $selectedPlan->user->name : 'N/A' }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Status')</h6>
                                <p>
                                    <span class="badge {{ $selectedPlan->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $selectedPlan->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Published At')</h6>
                                <p>{{ $selectedPlan->published_at ? \Carbon\Carbon::parse($selectedPlan->published_at)->format('d M Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Created At')</h6>
                                <p>{{ $selectedPlan->created_at }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Updated At')</h6>
                                <p>{{ $selectedPlan->updated_at }}</p>
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
        <img class="lightbox-image" id="lightbox-image" src="" alt="@lang('Plan Image')">
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
                $('#deletePlanModal').modal('show');
            });
            Livewire.on('openDetailsModal', () => {
                $('#detailsPlanModal').modal('show');
            });
            Livewire.on('openPublishModal', () => {
                $('#publishPlanModal').modal('show');
            });
            Livewire.on('closeModal', () => {
                $('#deletePlanModal').modal('hide');
                $('#detailsPlanModal').modal('hide');
                $('#publishPlanModal').modal('hide');
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
