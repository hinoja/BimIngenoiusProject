<div class="container-fluid px-4 py-6">
    <!-- Filtres et recherche -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>@lang('Filter Quotes')</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            placeholder="@lang('Search quotes...')" aria-label="@lang('Search quotes')">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-filter"></i></span>
                        <select wire:model.live="filterCategory" class="form-select" aria-label="@lang('Filter by category')">
                            <option value="">@lang('All Categories')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->{app()->getLocale() . '_name'} }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-list"></i></span>
                        <select wire:model.live="perPage" class="form-select" aria-label="@lang('Items per page')">
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button wire:click="resetFilters" class="btn btn-secondary w-100">
                        <i class="fas fa-undo-alt me-1"></i> @lang('Reset')
                    </button>
                </div>
            </div>
            <div wire:loading class="text-center mt-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">@lang('Loading...')</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des devis -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <tr>
                            <th scope="col" class="text-center" style="width: 50px;">#</th>
                            <th scope="col" wire:click="sortBy('title')" style="cursor: pointer; min-width: 180px;">
                                @lang('Title')
                                @if ($sortField === 'title')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </th>
                            <th scope="col" style="min-width: 150px;">@lang('Customer')</th>
                            <th scope="col" style="min-width: 120px;">@lang('Category')</th>
                            <th scope="col" wire:click="sortBy('budget')" style="cursor: pointer; min-width: 120px;">
                                @lang('Budget')
                                @if ($sortField === 'budget')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="text-center" style="width: 200px;">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quotes as $quote)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + ($quotes->currentPage() - 1) * $quotes->perPage() }}</td>
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
                                <td>{{ $quote->category->{app()->getLocale() . '_name'} ?? 'N/A' }}</td>
                                <td>
                                    <span class="fw-bold">{{ number_format($quote->budget, 2) }}</span>
                                    <small>{{ $quote->currency }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button wire:click="showDetails({{ $quote->id }})"
                                            class="btn btn-sm btn-info mx-1" title="@lang('View Details')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button wire:click="showResponseForm({{ $quote->id }})"
                                            class="btn btn-sm btn-success mx-1" title="@lang('Respond')">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                        <button wire:click="showDeleteForm({{ $quote->id }})"
                                            class="btn btn-sm btn-danger mx-1" title="@lang('Delete')">
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
                    {{ $quotes->lastItem() ?? 0 }} @lang('of') {{ $quotes->total() }} @lang('entries')
                </div>
                <div>
                    {{ $quotes->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div class="modal fade" id="deleteQuoteModal" tabindex="-1" aria-labelledby="deleteQuoteModalLabel"
        aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">@lang('Delete Quote')</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedQuote)
                        <p>@lang('Are you sure you want to delete this quote?')</p>
                        <p><strong>{{ $selectedQuote->title }}</strong></p>
                        <p class="text-danger">@lang('This action cannot be undone.')</p>
                    @endif
                </div>
                <div class="modal-footer" style="border-top: 2px solid #FF6B35;">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        <i class="fas fa-times me-1"></i> @lang('Cancel')
                    </button>
                    <button type="button" class="btn btn-danger" wire:click="deleteQuote">
                        <i class="fas fa-trash me-1"></i> @lang('Delete')
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de détails -->
    <div class="modal fade" id="detailsQuoteModal" tabindex="-1" aria-labelledby="detailsQuoteModalLabel"
        aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="detailsQuoteModalLabel">@lang('Quote Details')</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if ($selectedQuote)
                        <div class="row g-4">
                            <!-- Section Informations du devis -->
                            <div class="col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-light border-bottom border-primary">
                                        <h6 class="fw-bold mb-0"><i
                                                class="fas fa-file-invoice me-2"></i>@lang('Quote Information')</h6>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 fw-bold">@lang('Title')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->title }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Category')</dt>
                                            <dd class="col-sm-8">
                                                {{ $selectedQuote->category->{app()->getLocale() . '_name'} ?? 'N/A' }}
                                            </dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Budget')</dt>
                                            <dd class="col-sm-8">{{ number_format($selectedQuote->budget, 2) }}
                                                {{ $selectedQuote->currency }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Project City')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->project_city }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Created')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->created_at }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <!-- Section Informations du client -->
                            <div class="col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-light border-bottom border-primary">
                                        <h6 class="fw-bold mb-0"><i class="fas fa-user me-2"></i>@lang('Customer Information')
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 fw-bold">@lang('Name')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->customer->name }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Email')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->customer->email }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Phone')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->customer->phone ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('City')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->customer->city ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4 fw-bold">@lang('Postal Code')</dt>
                                            <dd class="col-sm-8">{{ $selectedQuote->customer->zip_code ?? 'N/A' }}
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <!-- Section Détails du devis -->
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light border-bottom border-primary">
                                        <h6 class="fw-bold mb-0"><i
                                                class="fas fa-info-circle me-2"></i>@lang('Quote Details')</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="p-3 bg-light rounded">{!! $selectedQuote->details !!}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Section Réponse -->
                            @if ($selectedQuote->response)
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light border-bottom border-primary">
                                            <h6 class="fw-bold mb-0"><i
                                                    class="fas fa-comment-alt me-2"></i>@lang('Response')</h6>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-3 fw-bold">@lang('Message')</dt>
                                                <dd class="col-sm-9">{{ $selectedQuote->response }}</dd>
                                                @if ($selectedQuote->response_budget)
                                                    <dt class="col-sm-3 fw-bold">@lang('Proposed Budget')</dt>
                                                    <dd class="col-sm-9">
                                                        {{ number_format($selectedQuote->response_budget, 2) }}
                                                        {{ $selectedQuote->response_currency }}</dd>
                                                @endif
                                                @if ($selectedQuote->response_at)
                                                    <dt class="col-sm-3 fw-bold">@lang('Response Date')</dt>
                                                    <dd class="col-sm-9">
                                                        {{ $selectedQuote->response_at }}
                                                    </dd>
                                                @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Section Ressources -->
                            @if ($selectedQuote->file)
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light border-bottom border-primary">
                                            <h6 class="fw-bold mb-0"><i
                                                    class="fas fa-file-download me-2"></i>@lang('Resources')</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="me-3"><i
                                                        class="fas fa-file me-2"></i>{{ $selectedQuote->file_name ?? basename($selectedQuote->file) }}</span>
                                                <button wire:click="downloadFile({{ $selectedQuote->id }})"
                                                    wire:loading.attr="disabled" class="btn btn-sm btn-primary">
                                                    <span wire:loading
                                                        wire:target="downloadFile({{ $selectedQuote->id }})"
                                                        class="spinner-border spinner-border-sm me-1" role="status"
                                                        aria-hidden="true"></span>
                                                    <i class="fas fa-download me-1"></i> @lang('Download')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            @lang('No quote selected.')
                        </div>
                    @endif
                </div>
                <div class="modal-footer" style="border-top: 2px solid #FF6B35;">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        <i class="fas fa-times me-1"></i> @lang('Close')
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de réponse -->
    <div class="modal fade" id="responseQuoteModal" tabindex="-1" aria-labelledby="responseQuoteModalLabel"
        aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="responseQuoteModalLabel">@lang('Respond to Quote')</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if ($selectedQuote)
                        <div class="mb-3">
                            <label for="response" class="form-label fw-bold">@lang('Response')</label>
                            <textarea wire:model.live="response" id="response" rows="5" class="form-control"
                                placeholder="@lang('Enter your response...')" aria-describedby="responseHelp"></textarea>
                            <small id="responseHelp" class="form-text text-muted">@lang('Provide your comments or proposed changes.')</small>
                            @error('response')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="responseBudget" class="form-label fw-bold">@lang('Proposed Budget (optional)')</label>
                                <input type="number" wire:model.live="responseBudget" id="responseBudget"
                                    step="0.01" class="form-control" placeholder="@lang('Enter proposed budget...')"
                                    aria-describedby="responseBudgetHelp">
                                <small id="responseBudgetHelp" class="form-text text-muted">@lang('Enter a new budget if proposing a change.')</small>
                                @error('responseBudget')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="responseCurrency" class="form-label fw-bold">@lang('Currency (optional)')</label>
                                <input type="text" wire:model.live="responseCurrency" id="responseCurrency"
                                    class="form-control" placeholder="@lang('Enter currency...')"
                                    aria-describedby="responseCurrencyHelp">
                                <small id="responseCurrencyHelp"
                                    class="form-text text-muted">@lang('Specify the currency for the proposed budget.')</small>
                                @error('responseCurrency')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            @lang('No quote selected.')
                        </div>
                    @endif
                </div>
                <div class="modal-footer" style="border-top: 2px solid #FF6B35;">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        <i class="fas fa-times me-1"></i> @lang('Cancel')
                    </button>
                    <button type="button" class="btn btn-success" wire:click="submitResponse"
                        wire:loading.attr="disabled">
                        <span wire:loading wire:target="submitResponse" class="spinner-border spinner-border-sm me-1"
                            role="status" aria-hidden="true"></span>
                        <i class="fas fa-check me-1"></i> @lang('Submit')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {


            // Gestion des modals
            // console.log('Livewire initialized');
            // Ouverture des modals spécifiques
            Livewire.on('openModal', () => {
                $('#deleteQuoteModal').modal('show');
            });

            Livewire.on('openDetailsModal', () => {
                $('#detailsQuoteModal').modal('show');
            });

            Livewire.on('openResponseModal', () => {
                $('#responseQuoteModal').modal('show');
            });

            // Fermeture de tous les modals
            Livewire.on('closeModal', () => {
                $('#deleteQuoteModal').modal('hide');
                $('#detailsQuoteModal').modal('hide');
                $('#responseQuoteModal').modal('hide');
            });

            // Gestion des alertes
            Livewire.on('alert', (data) => {
                console.log('Alerte reçue:', data);
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

@push('css')
    <style>
        .table thead th {
            position: sticky;
            top: 0;
            background-color: #2A2E45;
            color: #F8F9FA;
            font-weight: 600;
            border-bottom: 2px solid #FF6B35;
            padding: 12px 8px;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 107, 53, 0.05);
        }

        .table td {
            vertical-align: middle;
            padding: 0.75rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-header,
        .modal-footer {
            border-color: #FF6B35;
        }

        .btn-close-white {
            filter: invert(1);
        }

        .card-header {
            background-color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-content {
            border-radius: 0.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-body {
            background-color: #F8F9FA;
        }

        .btn-primary {
            background-color: #FF6B35;
            border-color: #FF6B35;
        }

        .btn-primary:hover {
            background-color: #e55a2e;
            border-color: #e55a2e;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        dl.row dt,
        dl.row dd {
            margin-bottom: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }
    </style>
@endpush
