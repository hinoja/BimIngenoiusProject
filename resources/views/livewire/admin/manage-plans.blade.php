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
                <div class="card-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
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
                                    <option value="1">@lang('Published')</option>
                                    <option value="0">@lang('Unpublished')</option>
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
                                    <th scope="col" class="text-center" style="width: 50px;">#</th>
                                    <th scope="col" style="min-width: 180px;">@lang('Title')</th>
                                    <th scope="col" style="min-width: 120px;">@lang('Author')</th>
                                    <th scope="col" class="text-center" style="width: 100px;">@lang('Media')</th>
                                    <th scope="col" style="min-width: 100px;">@lang('Published At')</th>
                                    <th scope="col" class="text-center" style="width: 150px;">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration + ($plans->currentPage() - 1) * $plans->perPage() }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">{{ $plan->title }}</span>
                                                <small class="text-muted">{{ Str::limit($plan->description, 50) }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $plan->user?->name ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <span class="badge bg-info" data-bs-toggle="tooltip" title="@lang('Images')">
                                                    <i class="fas fa-image"></i> {{ $plan->images->count() }}
                                                </span>
                                            </div>
                                        </td>
                                        <td> @if (!$plan->published_at)
                                            <span class="badge bg-secondary">@lang('pending')</span>
                                        @else
                                            <span class="badge bg-success">
                                                {{ $plan->published_at }}
                                            </span>
                                        @endif</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.plans.show', $plan) }}" class="btn btn-sm btn-info" title="@lang('View Details')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-sm btn-primary" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a> --}}
                                                <button wire:click="showPublishForm({{ $plan->id }})"
                                                    class="btn btn-sm {{ $plan->published_at ? 'btn-warning' : 'btn-success' }}"
                                                    title="{{ $plan->published_at ? __('Unpublish') : __('Publish') }}">
                                                    <i class="fas {{ $plan->published_at ? 'fa-eye-slash' : 'fa-paper-plane' }}"></i>
                                                </button>
                                                <button wire:click="showDeleteForm({{ $plan->id }})" class="btn btn-sm btn-danger" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            @lang('No plans found.')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        @lang('Showing') {{ $plans->firstItem() }} @lang('to') {{ $plans->lastItem() }}
                        @lang('of') {{ $plans->total() }} @lang('entries')
                    </div>
                    <div>
                        {{ $plans->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour la suppression -->
        <div class="modal fade" id="deletePlanModal" tabindex="-1" aria-labelledby="deletePlanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h5 class="modal-title" id="deletePlanModalLabel">@lang('Delete Plan')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete the plan') <strong>{{ $fr_title }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                        <button type="button" class="btn btn-danger" wire:click="destroyPlan" wire:loading.attr="disabled">
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
        <div class="modal fade" id="publishPlanModal" tabindex="-1" aria-labelledby="publishPlanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h5 class="modal-title" id="publishPlanModalLabel">
                            @if($plan->find($publishId)?->published_at)
                                @lang('Unpublish Plan')
                            @else
                                @lang('Publish Plan')
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($plan->find($publishId)?->published_at)
                            @lang('Are you sure you want to unpublish the plan') <strong>{{ $fr_title }}</strong>?
                        @else
                            @lang('Are you sure you want to publish the plan') <strong>{{ $fr_title }}</strong>?
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                        <button type="button"
                                class="btn {{ $plan->find($publishId)?->published_at ? 'btn-warning' : 'btn-success' }}"
                                wire:click="togglePublish"
                                wire:loading.attr="disabled">
                            <span wire:loading wire:target="togglePublish">
                                <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Processing...')
                            </span>
                            <span wire:loading.remove wire:target="togglePublish">
                                @if($plan->find($publishId)?->published_at)
                                    <i class="fas fa-ban mr-1"></i> @lang('Unpublish')
                                @else
                                    <i class="fas fa-check-circle mr-1"></i> @lang('Publish')
                                @endif
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour les détails -->
        <div class="modal fade" id="detailsPlanModal" tabindex="-1" aria-labelledby="detailsPlanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h5 class="modal-title" id="detailsPlanModalLabel">@lang('Plan Details')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($selectedPlan)
                            @if ($selectedPlan->images->isNotEmpty())
                                <div class="mb-4">
                                    <h6 class="text-muted">@lang('Images')</h6>
                                    <div id="planImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($selectedPlan->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->name) }}"
                                                        class="d-block w-100 rounded image-lightbox"
                                                        style="max-height: 400px; object-fit: cover;"
                                                        alt="@lang('Plan Image')"
                                                        data-fullscreen="{{ asset('storage/' . $image->name) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="carousel-indicators">
                                            @foreach ($selectedPlan->images as $index => $image)
                                                <button type="button" data-bs-target="#planImagesCarousel"
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
                                            data-bs-target="#planImagesCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">@lang('Previous')</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#planImagesCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">@lang('Next')</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="mb-4">
                                    <h6 class="text-muted">@lang('Images')</h6>
                                    <p class="text-muted">@lang('No images available for this plan.')</p>
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
                                    <h6 class="text-muted">@lang('French Description')</h6>
                                    <p>{{ $selectedPlan->fr_description }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">@lang('English Description')</h6>
                                    <p>{{ $selectedPlan->en_description }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">@lang('Slug')</h6>
                                    <p>{{ $selectedPlan->slug }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">@lang('Author')</h6>
                                    <p>{{ $selectedPlan->user?->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">@lang('Status')</h6>
                                    <p>
                                        <span class="badge {{ $selectedPlan->published_at ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $selectedPlan->published_at ? __('Published') : __('Unpublished') }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">@lang('Published At')</h6>
                                    <p>{{ $selectedPlan->published_at ?? 'N/A' }}</p>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
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
</div>

@push('css')
    <style>
        .table {
            font-size: 0.925rem;
        }

        .table thead th {
            position: sticky;
            top: 0;
            background-color: #2A2E45;
            color: #F8F9FA;
            font-weight: 600;
            text-transform: none;
            vertical-align: middle;
            border-bottom: 2px solid #FF6B35;
            white-space: nowrap;
            padding: 12px 8px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(42, 46, 69, 0.05);
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.5em;
            font-size: 0.75em;
            display: inline-flex;
            align-items: center;
            gap: 0.25em;
        }

        .btn-group .btn {
            transition: all 0.2s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-item.active .page-link {
            background-color: #2A2E45;
            border-color: #2A2E45;
        }

        .page-link {
            color: #2A2E45;
        }

        .tooltip-inner {
            font-size: 0.8rem;
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
                $('[data-bs-toggle="tooltip"]').tooltip();
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
