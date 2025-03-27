<form wire:submit.prevent="addProject()">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="fr_title" class="font-weight-bold text-dark">@lang('French Title')</label>
                <input type="text" wire:model="fr_title" class="form-control @error('fr_title') is-invalid @enderror"
                    id="fr_title" placeholder="@lang('Enter the French title')">
                @error('fr_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="en_title" class="font-weight-bold text-dark">@lang('English Title')</label>
                <input type="text" wire:model="en_title" class="form-control @error('en_title') is-invalid @enderror"
                    id="en_title" placeholder="@lang('Enter the English title')">
                @error('en_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_fr_description" class="font-weight-bold text-dark">@lang('French Description')</label>
                <textarea wire:model="fr_description" class="form-control @error('fr_description') is-invalid @enderror"
                    id="modal_fr_description" rows="3" placeholder="@lang('Enter the French description')"></textarea>
                @error('fr_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_en_description" class="font-weight-bold text-dark">@lang('English Description')</label>
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
                <label for="modal_company" class="font-weight-bold text-dark">@lang('Company')</label>
                <input type="text" wire:model="company" class="form-control @error('company') is-invalid @enderror"
                    id="modal_company" placeholder="@lang('Enter the company name')">
                @error('company')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_country" class="font-weight-bold text-dark">@lang('Country')</label>
                <input type="text" wire:model="country" class="form-control @error('country') is-invalid @enderror"
                    id="modal_country" placeholder="@lang('Enter the country')">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_city" class="font-weight-bold text-dark">@lang('City')</label>
                <input type="text" wire:model="city" class="form-control @error('city') is-invalid @enderror"
                    id="modal_city" placeholder="@lang('Enter the city')">
                @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_address" class="font-weight-bold text-dark">@lang('Address')</label>
                <input type="text" wire:model="address" class="form-control @error('address') is-invalid @enderror"
                    id="modal_address" placeholder="@lang('Enter the address')">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_status" class="font-weight-bold text-dark">@lang('Status')</label>
                <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                    id="modal_status">
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
                <label for="modal_size" class="font-weight-bold text-dark">@lang('Size')</label>
                <select wire:model="size" class="form-control @error('size') is-invalid @enderror" id="modal_size">
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
                <label for="modal_start_date" class="font-weight-bold text-dark">@lang('Start Date')</label>
                <input type="date" wire:model="start_date"
                    class="form-control @error('start_date') is-invalid @enderror" id="modal_start_date">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="modal_end_date" class="font-weight-bold text-dark">@lang('End Date')</label>
                <input type="date" wire:model="end_date"
                    class="form-control @error('end_date') is-invalid @enderror" id="modal_end_date">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="modal_category_id" class="font-weight-bold text-dark">@lang('Category')</label>
        <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror"
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
    <div class="form-group mb-3">
        <label class="font-weight-bold text-dark">@lang('Images')</label>

        <input type="file" wire:model="images" class="form-control @error('images.*') is-invalid @enderror"
            multiple>
        @error('images.*')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-right">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i>
            @lang('Create')</button>
    </div>
</form>
