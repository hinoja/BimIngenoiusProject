<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('Quote Details') }}
            </h2>
            <div>
                <a href="{{ route('admin.quotes.edit', $quote) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i> {{ __('Edit Quote') }}
                </a>
                <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Quotes') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">{{ $quote->title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">{{ __('Quote Details') }}</h6>
                            <div class="p-3 bg-light rounded">
                                {!! $quote->details !!}
                            </div>
                        </div>
                        
                        @if($quote->file)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">{{ __('Attached File') }}</h6>
                            <a href="{{ Storage::url($quote->file) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-file-download me-1"></i> {{ __('Download File') }}
                            </a>
                        </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">{{ __('Budget') }}</h6>
                                <p class="fs-5 fw-bold">{{ number_format($quote->budget, 2) }} {{ $quote->currency }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">{{ __('Project City') }}</h6>
                                <p>{{ $quote->project_city }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">{{ __('Customer Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-circle bg-primary text-white me-3">
                                {{ substr($quote->customer->name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $quote->customer->name }}</h6>
                               