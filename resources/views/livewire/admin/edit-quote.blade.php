<div>
    <form wire:submit="updateQuote">
        <div class="row">
            <!-- Informations du devis -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">@lang('Quote Information')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="form-label">@lang('Title') <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="title" id="title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details" class="form-label">@lang('Details') <span class="text-danger">*</span></label>
                                    <textarea wire:model="details" id="details" rows="6" class="form-control @error('details') is-invalid @enderror"></textarea>
                                    @error('details') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="budget" class="form-label">@lang('Budget') <span class="text-danger">*</span></label>
                                    <input type="number" wire:model="budget" id="budget" step="0.01" class="form-control @error('budget') is-invalid @enderror">
                                    @error('budget') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency" class="form-label">@lang('Currency') <span class="text-danger">*</span></label>
                                    <select wire:model="currency" id="currency" class="form-select @error('currency') is-invalid @enderror">
                                        <option value="">@lang('Select Currency')</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="JPY">JPY</option>
                                        <option value="CNY">CNY</option>
                                        <option value="INR">INR</option>
                                    </select>
                                    @error('currency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project_city" class="form-label">@lang('Project City') <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="project_city" id="project_city" class="form-control @error('project_city') is-invalid @enderror">
                                    @error('project_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">@lang('Category') <span class="text-danger">*</span></label>
                                    <select wire:model="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">@lang('Select Category')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">@lang('Status') <span class="text-danger">*</span></label>
                                    <select wire:model="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="pending">@lang('Pending')</option>
                                        <option value="approved">@lang('Approved')</option>
                                        <option value="rejected">@lang('Rejected')</option>
                                        <option value="completed">@lang('Completed')</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newFile" class="form-label">@lang('File')</label>
                                    <input type="file" wire:model="newFile" id="newFile" class="form-control @error('newFile') is-invalid @enderror">
                                    @error('newFile') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                    <div class="mt-2">
                                        @if ($quote->file)
                                            <div class="d-flex align-items-center">
                                                <a href="{{ Storage::url($quote->file) }}" target="_blank" class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-file-download me-1"></i> @lang('Current File')
                                                </a>
                                                <button type="button" wire:click="deleteFile" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash me-1"></i> @lang('Delete')
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">@lang('No file attached')</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations du client -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">@lang('Customer Information')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_name" class="form-label">@lang('Name') <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror">
                                    @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_email" class="form-label">@lang('Email') <span class="text-danger">*</span></label>
                                    <input type="email" wire:model="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror">
                                    @error('customer_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_phone" class="form-label">@lang('Phone')</label>
                                    <input type="text" wire:model="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror">
                                    @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_company" class="form-label">@lang('Company')</label>
                                    <input type="text" wire:model="customer_company" id="customer_company" class="form-control @error('customer_company') is-invalid @enderror">
                                    @error('customer_company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_address" class="form-label">@lang('Address')</label>
                                    <input type="text" wire:model="customer_address" id="customer_address" class="form-control @error('customer_address') is-invalid @enderror">
                                    @error('customer_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_city" class="form-label">@lang('City')</label>
                                    <input type="text" wire:model="customer_city" id="customer_city" class="form-control @error('customer_city') is-invalid @enderror">
                                    @error('customer_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_country" class="form-label">@lang('Country')</label>
                                    <input type="text" wire:model="customer_country" id="customer_country" class="form-control @error('customer_country') is-invalid @enderror">
                                    @error('customer_country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_postal_code" class="form-label">@lang('Postal Code')</label>
                                    <input type="text" wire:model="customer_postal_code" id="customer_postal_code" class="form-control @error('customer_postal_code') is-invalid @enderror">
                                    @error('customer_postal_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> @lang('Update Quote')
                            </button>
                            <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> @lang('Back to List')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
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
