<div>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">@lang('Newsletters Management')</h1>
                <p class="mb-0">@lang('Manage and send newsletters to your subscribers')</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('admin.newsletters.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> @lang('Create Newsletter')
                </a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@lang('All Newsletters')</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">@lang('Newsletter Actions'):</div>
                        <a class="dropdown-item" href="{{ route('admin.newsletters.subscribers') }}">
                            <i class="fas fa-users fa-sm fa-fw me-2 text-gray-400"></i>
                            @lang('Manage Subscribers')
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="@lang('Search newsletters...')"
                                wire:model.live.debounce.300ms="search">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model.live="filterStatus">
                            <option value="">@lang('All Statuses')</option>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model.live="perPage">
                            <option value="10">10 @lang('per page')</option>
                            <option value="25">25 @lang('per page')</option>
                            <option value="50">50 @lang('per page')</option>
                            <option value="100">100 @lang('per page')</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('subject')" class="cursor-pointer">
                                    @lang('Subject')
                                    @if($sortField === 'subject')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('status')" class="cursor-pointer">
                                    @lang('Status')
                                    @if($sortField === 'status')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('scheduled_for')" class="cursor-pointer">
                                    @lang('Scheduled For')
                                    @if($sortField === 'scheduled_for')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('sent_at')" class="cursor-pointer">
                                    @lang('Sent At')
                                    @if($sortField === 'sent_at')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('created_at')" class="cursor-pointer">
                                    @lang('Created At')
                                    @if($sortField === 'created_at')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($newsletters as $newsletter)
                                <tr>
                                    <td>{{ $newsletter->subject }}</td>
                                    <td>
                                        <span class="badge bg-{{ $newsletter->status_color }}">
                                            {{ $statusOptions[$newsletter->status] ?? $newsletter->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($newsletter->scheduled_for)
                                            {{ $newsletter->scheduled_for->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($newsletter->sent_at)
                                            {{ $newsletter->sent_at->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $newsletter->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.newsletters.edit', $newsletter) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            @if($newsletter->isDraft() || $newsletter->isScheduled())
                                                <button type="button" class="btn btn-sm btn-success"
                                                        wire:click="confirmSend({{ $newsletter->id }})">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-danger"
                                                    wire:click="confirmDelete({{ $newsletter->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        @lang('No newsletters found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        @lang('Showing') {{ $newsletters->firstItem() ?? 0 }} @lang('to') {{ $newsletters->lastItem() ?? 0 }} @lang('of') {{ $newsletters->total() }} @lang('entries')
                    </div>
                    <div>
                        {{ $newsletters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Newsletter Modal -->
    <div class="modal fade" id="deleteNewsletterModal" tabindex="-1" aria-labelledby="deleteNewsletterModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNewsletterModalLabel">@lang('Delete Newsletter')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($selectedNewsletter)
                        <p>@lang('Are you sure you want to delete the newsletter'): <strong>{{ $selectedNewsletter->subject }}</strong>?</p>
                        <p class="text-danger">@lang('This action cannot be undone.')</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteNewsletter">@lang('Delete')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Send Newsletter Modal -->
    <div class="modal fade" id="sendNewsletterModal" tabindex="-1" aria-labelledby="sendNewsletterModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendNewsletterModalLabel">@lang('Send Newsletter')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($selectedNewsletter)
                        <p>@lang('Are you sure you want to send the newsletter'): <strong>{{ $selectedNewsletter->subject }}</strong>?</p>
                        <p>@lang('It will be sent to') <strong>{{ $subscribersCount }}</strong> @lang('active subscribers').</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-success" wire:click="sendNewsletter" wire:loading.attr="disabled">
                        <span wire:loading wire:target="sendNewsletter">
                            <i class="fas fa-spinner fa-spin"></i> @lang('Processing...')
                        </span>
                        <span wire:loading.remove wire:target="sendNewsletter">
                            <i class="fas fa-paper-plane"></i> @lang('Send')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>




