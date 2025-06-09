<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">@lang('Quote Details')</h5>
                    <div>
                        <span class="badge bg-{{ 
                            $quote->status === 'pending' ? 'warning' : 
                            ($quote->status === 'approved' ? 'success' : 
                            ($quote->status === 'rejected' ? 'danger' : 'info')) 
                        }} fs-6">
                            {{ ucfirst(__($quote->status)) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4>{{ $quote->title }}</h4>
                        <div class="d-flex justify-content-between text-muted small mb-3">
                            <div>
                                <i class="fas fa-calendar me-1"></i> {{ $quote->created_at->format('d/m/Y') }}
                            </div>
                            <div>
                                <i class="fas fa-tag me-1"></i> {{ $quote->category->name }}
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $quote->project_city }}
                            </div>
                        </div>
                        <div class="p-3 bg-light rounded mb-3">
                            <h5 class="border-bottom pb-2 mb-3">@lang('Project Details')</h5>
                            <div class="quote-details">
                                {!! $quote->details !!}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">@lang('Budget')</h5>
                                <div class="fs-4 fw-bold">{{ number_format($quote->budget, 2) }} {{ $quote->currency }}</div>
                            </div>
                            @if($quote->file)
                                <a href="{{ Storage::url($quote->file) }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-file-download me-1"></i> @lang('Download Attachment')
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Historique des actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">@lang('Activity History')</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">@lang('Quote Created')</h6>
                                <small>{{ $quote->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <p class="mb-1">@lang('Quote was submitted by the customer.')</p>
                            <small class="text-muted">{{ $quote->customer->name }}</small>
                        </div>
                        @if($quote->updated_at->gt($quote->created_at))
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">@lang('Quote Updated')</h6>
                                    <small>{{ $quote->updated_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-1">@lang('Quote was updated.')</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Informations du client -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">@lang('Customer Information')</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-circle me-3 bg-primary">
                            <span class="initials">{{ substr($quote->customer->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $quote->customer->name }}</h5>
                            <p class="text-muted mb-0">{{ $quote->customer->email }}</p>
                        </div>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        @if($quote->customer->phone)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('Phone')</span>
                                <span>{{ $quote->customer->phone }}</span>
                            </li>
                        @endif
                        
                        @if($quote->customer->company)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('Company')</span>
                                <span>{{ $quote->customer->company }}</span>
                            </li>
                        @endif
                        
                        @if($quote->customer->address)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('Address')</span>
                                <span>{{ $quote->customer->address }}</span>
                            </li>
                        @endif
                        
                        @if($quote->customer->city)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('City')</span>
                                <span>{{ $quote->customer->city }}</span>
                            </li>
                        @endif
                        
                        @if($quote->customer->country)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('Country')</span>
                                <span>{{ $quote->customer->country }}</span>
                            </li>
                        @endif
                        
                        @if($quote->customer->postal_code)
                            <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                <span class="text-muted">@lang('Postal Code')</span>
                                <span>{{ $quote->customer->postal_code }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">@lang('Actions')</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.quotes.edit', $quote) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> @lang('Edit Quote')
                        </a>
                        <button wire:click="changeStatus" class="btn btn-success">
                            <i class="fas fa-exchange-alt me-1"></i> @lang('Change Status')
                        </button>
                        <button wire:click="confirmDelete" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> @lang('Delete Quote')
                        </button>
                        <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> @lang('Back to List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('styles')
    <style>
        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .initials {
            font-size: 24px;
            color: white;
            font-weight: bold;
        }
        
        .quote-details {
            min-height: 200px;
        }
    </style>
    @endpush
</div>