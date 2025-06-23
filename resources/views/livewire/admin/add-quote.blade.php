<div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="card-title">@lang('Add New Quote')</h4>
                    <p class="card-subtitle text-muted">@lang('Create a new quote for a customer')</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-primary" role="progressbar" 
                                    style="width: {{ ($step / $totalSteps) * 100 }}%;" 
                                    aria-valuenow="{{ ($step / $totalSteps) * 100 }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="save">
                        <!-- Étape 1: Informations client -->
                        @if ($step === 1)
                        <div class="step-content">
                            <h5 class="mb-4">@lang('Customer Information')</h5>
                            
                            <div class="mb-4">
                                <label class="form-label">@lang('Select Existing Customer')</label>
                                <div class="input-group">
                                    <select class="form-control" wire:model="customer_id" wire:change="selectExistingCustomer($event.target.value)">
                                        <option value="">@lang('-- Select a customer --')</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" wire:click="$set('customer_id', '')">
                                        @lang('New Customer')
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customer_name" class="form-label">@lang('Customer Name')</label>
                                        <input type="text" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                                            wire:model="customer_name" placeholder="@lang('Enter customer name')">
                                        @error('customer_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customer_email" class="form-label">@lang('Customer Email')</label>
                                        <input type="email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" 
                                            wire:model="customer_email" placeholder="@lang('Enter customer email')">
                                        @error('customer_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="customer_phone" class="form-label">@lang('Customer Phone')</label>
                                        <input type="text" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" 
                                            wire:model="customer_phone" placeholder="@lang('Enter customer phone')">
                                        @error('customer_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Étape 2: Informations devis -->
                        @if ($step === 2)
                        <div class="step-content">
                            <h5 class="mb-4">@lang('Quote Details')</h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">@lang('Quote Title')</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" 
                                            wire:model="title" placeholder="@lang('Enter quote title')">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id" class="form-label">@lang('Category')</label>
                                        <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" 
                                            wire:model="category_id">
                                            <option value="">@lang('-- Select a category --')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="details" class="form-label">@lang('Quote Details')</label>
                                        <div wire:ignore>
                                            <input id="details_input" type="hidden" name="details">
                                            <trix-editor id="trix_editor" input="details_input" class="trix-content @error('details') is-invalid @enderror"></trix-editor>
                                        </div>
                                        @error('details')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="budget" class="form-label">@lang('Budget')</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" id="budget" class="form-control @error('budget') is-invalid @enderror" 
                                                wire:model="budget" placeholder="0.00">
                                            <select class="form-select" wire:model="currency">
                                                <option value="EUR">EUR</option>
                                                <option value="USD">USD</option>
                                                <option value="GBP">GBP</option>
                                            </select>
                                        </div>
                                        @error('budget')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="project_city" class="form-label">@lang('Project City')</label>
                                        <input type="text" id="project_city" class="form-control @error('project_city') is-invalid @enderror" 
                                            wire:model="project_city" placeholder="@lang('Enter project city')">
                                        @error('project_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file" class="form-label">@lang('Attachment (optional)')</label>
                                        <input type="file" id="file" class="form-control @error('file') is-invalid @enderror" 
                                            wire:model="file">
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div wire:loading wire:target="file" class="text-sm text-gray-500 mt-1">
                                            @lang('Uploading...')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between mt-4">
                            @if ($step > 1)
                                <button type="button" class="btn btn-secondary" wire:click="previousStep">
                                    <i class="fas fa-arrow-left me-1"></i> @lang('Previous')
                                </button>
                            @else
                                <div></div>
                            @endif
                            
                            @if ($step < $totalSteps)
                                <button type="button" class="btn btn-primary" wire:click="nextStep">
                                    @lang('Next') <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            @else
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> @lang('Save Quote')
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css" />
<style>
    trix-editor {
        min-height: 200px;
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.5rem;
        background-color: #fff;
    }
    
    trix-toolbar {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-bottom: none;
        border-radius: 0.25rem 0.25rem 0 0;
        padding: 0.25rem;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
<script>
    document.addEventListener('livewire:initialized', function() {
        const editor = document.querySelector("trix-editor");
        const input = document.querySelector("input[id=details_input]");
        
        if (editor) {
            editor.addEventListener("trix-change", function() {
                @this.set('details', input.value);
            });
            
            // Si une valeur existe déjà, l'initialiser dans l'éditeur
            if (@this.get('details')) {
                input.value = @this.get('details');
                editor.editor.loadHTML(input.value);
            }
        }
    });
</script>
@endpush