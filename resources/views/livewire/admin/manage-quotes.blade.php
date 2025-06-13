<div>
    <div class="row">
        <!-- Filtres et recherche -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                    placeholder="@lang('Search quotes...')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i
                                        class="fas fa-filter"></i></span>
                                <select wire:model.live="filterCategory" class="form-select">
                                    <option value="">@lang('All Categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-list"></i></span>
                                <select wire:model.live="perPage" class="form-select">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button wire:click="resetFilters" class="btn btn-secondary w-100">
                                <i class="fas fa-undo-alt mr-1"></i> @lang('Reset')
                            </button>
                        </div>
                    </div>
                    <div wire:loading class="text-center mt-2">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">@lang('Loading...')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des devis -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped  mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 50px;">#</th>
                                    <th scope="col" wire:click="sortBy('title')"
                                        style="cursor: pointer; min-width: 180px;">
                                        @lang('Title')
                                        @if ($sortField === 'title')
                                            <i
                                                class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @endif
                                    </th>
                                    <th scope="col" style="min-width: 150px;">@lang('Customer')</th>
                                    <th scope="col" style="min-width: 120px;">@lang('Category')</th>
                                    <th scope="col" wire:click="sortBy('budget')"
                                        style="cursor: pointer; min-width: 120px;">
                                        @lang('Budget')
                                        @if ($sortField === 'budget')
                                            <i
                                                class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @endif
                                    </th>
                                    <!-- Suppression de la colonne status -->
                                    <th scope="col" class="text-center" style="width: 150px;">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quotes as $quote)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration + ($quotes->currentPage() - 1) * $quotes->perPage() }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">{{ $quote->title }}</span>
                                                <small
                                                    class="text-muted">{{ Str::limit(strip_tags($quote->details), 50) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ $quote->customer->name }}</span>
                                                <small class="text-muted">{{ $quote->customer->email }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $quote->category->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="fw-bold">{{ number_format($quote->budget, 2) }}</span>
                                            <small>{{ $quote->currency }}</small>
                                        </td>
                                        <!-- Suppression de la colonne status -->
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="showDetails({{ $quote->id }})"
                                                    class="btn btn-sm btn-info mx-2" title="@lang('View Details')">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                              
                                                <!-- Suppression du bouton de changement de statut -->
                                                <button wire:click="showDeleteForm({{ $quote->id }})"
                                                    class="btn btn-sm btn-danger" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <div class="d-flex flex-column align-items-center py-5">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <h5>@lang('No quotes found')</h5>
                                                <p>@lang('Try adjusting your search or filter to find what you are looking for.')</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @lang('Showing') {{ $quotes->firstItem() ?? 0 }} @lang('to')
                            {{ $quotes->lastItem() ?? 0 }} @lang('of') {{ $quotes->total() }}
                            @lang('entries')
                        </div>
                        <div>
                            {{ $quotes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div class="modal fade" id="deleteQuoteModal" tabindex="-1" aria-labelledby="deleteQuoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">@lang('Delete Quote')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedQuote)
                        <p>@lang('Are you sure you want to delete this quote?')</p>
                        <p><strong>{{ $selectedQuote->title }}</strong></p>
                        <p class="text-danger">@lang('This action cannot be undone.')</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button wire:click="deleteQuote" class="btn btn-danger">@lang('Delete')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de détails -->
    <div class="modal fade" id="detailsQuoteModal" tabindex="-1" aria-labelledby="detailsQuoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailsQuoteModalLabel">@lang('Quote Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedQuote)
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Quote Information')</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <th>@lang('Title')</th>
                                        <td>{{ $selectedQuote->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Category')</th>
                                        <td>{{ $selectedQuote->category->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Budget')</th>
                                        <td>{{ number_format($selectedQuote->budget, 2) }}
                                            {{ $selectedQuote->currency }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Project City')</th>
                                        <td>{{ $selectedQuote->project_city }}</td>
                                    </tr>
                                    <!-- Suppression de l'affichage du statut -->
                                    <tr>
                                        <th>@lang('Created')</th>
                                        <td>{{ $selectedQuote->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">@lang('Customer Information')</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <td>{{ $selectedQuote->customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Email')</th>
                                        <td>{{ $selectedQuote->customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Phone')</th>
                                        <td>{{ $selectedQuote->customer->phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Company')</th>
                                        <td>{{ $selectedQuote->customer->company ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Address')</th>
                                        <td>{{ $selectedQuote->customer->address ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('City')</th>
                                        <td>{{ $selectedQuote->customer->city ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Country')</th>
                                        <td>{{ $selectedQuote->customer->country ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Postal Code')</th>
                                        <td>{{ $selectedQuote->customer->postal_code ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6 class="text-muted">@lang('Quote Details')</h6>
                                <div class="p-3 bg-light rounded">
                                    {!! $selectedQuote->details !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">@lang('Close')</button>
                    @if ($selectedQuote)
                        <a href="{{ route('admin.quotes.edit', $selectedQuote) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> @lang('Edit')
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Suppression du modal de changement de statut -->

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('openModal', (modalId) => {
                    let modal = new bootstrap.Modal(document.getElementById(modalId));
                    modal.show();
                });

                Livewire.on('closeModal', (modalId) => {
                    let modalElement = document.getElementById(modalId);
                    let modal = bootstrap.Modal.getInstance(modalElement);
                    modal.hide();
                });

                Livewire.on('alert', (data) => {
                    Swal.fire({
                        icon: data.type,
                        title: data.type === 'success' ? 'Success!' : 'Error!',
                        text: data.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
            });
        </script>
    @endpush
</div>

@push('css')
    <style>
        /* Tableau amélioré */
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
            padding: 0.35em 0.65em;
            border-radius: 0.25rem;
        }

        /* Styles pour les modals */
        .modal-header {
            padding: 1rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:initialized', function() {
            // Gestion des modals
            Livewire.on('openModal', modalId => {
                var modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            });

            Livewire.on('closeModal', modalId => {
                var modalElement = document.getElementById(modalId);
                var modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            });

            // Gestion des alertes
            Livewire.on('alert', data => {
                // Si vous utilisez une bibliothèque comme SweetAlert2 ou Toastr
                // Sinon, vous pouvez implémenter votre propre système d'alerte
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: data.type,
                        title: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    alert(data.message);
                }
            });
        });
    </script>
@endpush
