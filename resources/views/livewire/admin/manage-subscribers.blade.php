<div>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">@lang('Subscribers Management')</h1>
                <p class="mb-0">@lang('Manage your newsletter subscribers')</p>
            </div>
            <div class="col-md-6 text-md-end">
                <button type="button" class="btn btn-primary" wire:click="toggleAddForm">
                    <i class="fas fa-plus-circle me-1"></i> @lang('Add Subscriber')
                </button>
            </div>
        </div>

        @if($showAddForm)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('Add New Subscriber')</h6>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="addSubscriber">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">@lang('Email')</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" wire:model="email" placeholder="@lang('Enter email address')">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">@lang('Name')</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" wire:model="name" placeholder="@lang('Enter name (optional)')">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" wire:click="toggleAddForm">
                                @lang('Cancel')
                            </button>
                            <button type="submit" class="btn btn-primary">
                                @lang('Add Subscriber')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('All Subscribers')</h6>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="@lang('Search subscribers...')"
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
                                <th wire:click="sortBy('email')" class="cursor-pointer">
                                    @lang('Email')
                                    @if($sortField === 'email')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('name')" class="cursor-pointer">
                                    @lang('Name')
                                    @if($sortField === 'name')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('status')" class="cursor-pointer">
                                    @lang('Status')
                                    @if($sortField === 'status')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('subscribed_at')" class="cursor-pointer">
                                    @lang('Subscribed At')
                                    @if($sortField === 'subscribed_at')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>{{ $subscriber->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $subscriber->status === 'active' ? 'success' : ($subscriber->status === 'unsubscribed' ? 'warning' : 'danger') }}">
                                            {{ $statusOptions[$subscriber->status] ?? $subscriber->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($subscriber->subscribed_at)
                                            {{ $subscriber->subscribed_at->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm {{ $subscriber->status === 'active' ? 'btn-warning' : 'btn-success' }}"
                                                    wire:click="toggleStatus({{ $subscriber->id }})">
                                                <i class="fas {{ $subscriber->status === 'active' ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger"
                                                    wire:click="confirmDelete({{ $subscriber->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        @lang('No subscribers found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        @lang('Showing') {{ $subscribers->firstItem() ?? 0 }} @lang('to') {{ $subscribers->lastItem() ?? 0 }} @lang('of') {{ $subscribers->total() }} @lang('entries')
                    </div>
                    <div>
                        {{ $subscribers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Subscriber Modal -->
    <div class="modal fade" id="deleteSubscriberModal" tabindex="-1" aria-labelledby="deleteSubscriberModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSubscriberModalLabel">@lang('Delete Subscriber')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($selectedSubscriber)
                        <p>@lang('Are you sure you want to delete the subscriber'): <strong>{{ $selectedSubscriber->email }}</strong>?</p>
                        <p class="text-danger">@lang('This action cannot be undone.')</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteSubscriber">@lang('Delete')</button>
                </div>
            </div>
        </div>
    </div>
</div>


