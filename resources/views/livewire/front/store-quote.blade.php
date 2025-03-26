<div class="col-md-8 contact-form">
    @if (session()->has('success'))
        <div class="alert alert-success text-center">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form class="comment-form">
        <div class="col-md-12">
            <h4 class="mb-4" style="margin-top: 25px;">@lang('Personal Information')</h4>
            <hr style="margin-top: -10px;">
            
            <div class="form-group">
                <label class="labelled" for="civility">@lang('Civility') *</label>
                <select id="civility" wire:model.defer="civility" class="form-control @error('civility') is-invalid @enderror">
                    <option value="">@lang('Select civility')</option>
                    @foreach ($civilities as $key => $civility)
                        <option value="{{ $key }}">{{ $civility }}</option>
                    @endforeach
                </select>
                @error('civility')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="labelled" for="first_name">@lang('First Name') *</label>
                <input id="first_name" wire:model.defer="first_name" type="text" class="form-control" placeholder="@lang('Enter your first name')">
                @error('first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="labelled" for="last_name">@lang('Last Name') *</label>
                <input id="last_name" wire:model.defer="last_name" type="text" class="form-control" placeholder="@lang('Enter your last name')">
                @error('last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="labelled" for="phone">@lang('Phone') *</label>
                <input id="phone" wire:model.defer="phone" type="text" class="form-control" placeholder="@lang('Enter your phone number')">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="labelled" for="email">@lang('Email') *</label>
                <input id="email" wire:model.defer="email" type="email" class="form-control" placeholder="@lang('Enter your email')">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="labelled" for="city">@lang('City') *</label>
                <input id="city" wire:model.defer="city" type="text" class="form-control" placeholder="@lang('Enter your city')">
                @error('city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="labelled" for="zip_code">@lang('Zip Code') *</label>
                <input id="zip_code" wire:model.defer="zip_code" type="text" class="form-control" placeholder="@lang('Enter your zip code')">
                @error('zip_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <h4 style="margin-top: 25px;">@lang('Project Information')</h4>
            <hr style="margin-top: -10px;">

            <div class="form-group">
                <label class="labelled" for="title">@lang('Project Title') *</label>
                <input id="title" wire:model.defer="title" type="text" class="form-control" placeholder="@lang('Enter the project title')">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- <div class="col-md-12"> --}}
                <div class="form-group">
                    <label class="labelled" for="details">@lang('Category') *</label>
                    <select id="category" wire:model.defer="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">@lang('Select project category')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            {{-- </div> --}}

            <div class="row">
                <div class="form-group col-md-8">
                    <label class="labelled" for="details">@lang('Budget') *</label>
                    <input id="budget" wire:model.defer="budget" type="number" step="0.01" class="form-control @error('budget') is-invalid @enderror" placeholder="@lang('Budget')">
                    @error('budget')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label class="labelled" for="details">@lang('Currency') *</label>
                    <select id="currency" wire:model.defer="currency" class="form-control @error('currency') is-invalid @enderror">
                        <option value="">@lang('Select Currency')</option>
                        @foreach ($currencies as $key => $currency)
                            <option value="{{ $key }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                    @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
    
            <div class="form-group">
                <label class="labelled" for="details">@lang('Project Details') *</label>
                <textarea id="details" wire:model.defer="details" class="form-control" placeholder="@lang('Enter the project details')"></textarea>
                @error('details')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="labelled" for="project_city">@lang('Project City')</label>
                <input id="project_city" wire:model.defer="project_city" type="text" class="form-control" placeholder="@lang('Enter the project city')">
                @error('project_city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="labelled" for="file">@lang('Upload File')</label>
                <input id="file" wire:model.defer="file" type="file" class="form-control">
                @error('file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="text-right mt-4">
                <button wire:click.prevent="store" wire:loading.remove class="ot-btn btn-color" type="submit">@lang('Submit Quote')</button>
                <button wire:loading class="ot-btn btn-color" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    @lang('Submitting')...
                </button>
            </div>
        </div>
    </form>
</div>