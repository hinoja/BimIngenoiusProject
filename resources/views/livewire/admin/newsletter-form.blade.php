<div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $newsletterId ? __('Edit Newsletter') : __('Create Newsletter') }}
                </h6>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="subject" class="form-label">@lang('Subject')</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                               id="subject" wire:model="subject">
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">@lang('Content')</label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" wire:model="content" rows="10"></textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            @lang('You can use HTML tags for formatting. Use {name} to include the subscriber\'s name.')
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">@lang('Status')</label>
                        <select class="form-select @error('status') is-invalid @enderror"
                                id="status" wire:model.live="status">
                            <option value="draft">@lang('Draft')</option>
                            <option value="scheduled">@lang('Scheduled')</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($status === 'scheduled')
                        <div class="mb-3">
                            <label for="scheduledFor" class="form-label">@lang('Schedule For')</label>
                            <input type="datetime-local" class="form-control @error('scheduledFor') is-invalid @enderror"
                                   id="scheduledFor" wire:model="scheduledFor">
                            @error('scheduledFor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-secondary">
                            @lang('Cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ $newsletterId ? __('Update Newsletter') : __('Create Newsletter') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
