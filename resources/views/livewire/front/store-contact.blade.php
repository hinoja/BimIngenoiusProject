<div class="col-md-8">
    <div class="contact-form">
        <h4>@lang('Leave us a message')</h4>
        @if (session()->has('success'))
            <div class="alert alert-success text-justify">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <form class="comment-form">
            <div class="form-group @error('name') has-error @enderror has-feedback">
                <input id="name" wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Your Name')">
                @error('name')
                    <div class="invalid-feedback text-danger text-bold"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="form-group @error('subject') has-error @enderror has-feedback">
                <input id="email" wire:model.defer="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Your Email')">
                @error('email')
                    <div class="invalid-feedback text-danger text-bold"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="form-group @error('subject') has-error @enderror has-feedback">
                <input id="subject" wire:model.defer="subject" type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="@lang('Your Subject')">
                @error('subject')
                    <div class="invalid-feedback text-danger text-bold"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="comment-form-comment form-group @error('message') has-error @enderror has-feedback">
                <textarea id="message" wire:model.defer="message" placeholder="@lang('Your Message')" class="form-control @error('message') is-invalid @enderror"></textarea>
                @error('message')
                    <div class="invalid-feedback text-danger text-bold"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="text-right">
                <button wire:click.prevent="store" wire:loading.remove class="ot-btn btn-color" type="submit">@lang('Send Message')</button>
                <button wire:loading class="ot-btn btn-color" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    @lang('Loading')...
                </button>
            </div>                        			
        </form>
    </div>
</div>