<div class="container">
    <div class="row justify-content-center">
        <!-- Add News Button -->
        <div class="col-12 mb-3 text-right">
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-1"></i> @lang('Add New News')
            </a>
        </div>

        <!-- Filter Section -->
        <div class="col-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="mb-0"><i class="fas fa-filter mr-2"></i>@lang('Filter News')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" wire:model.live="filterTitle" class="form-control"
                                    placeholder="@lang('Title or Content')">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                <select wire:model.live="filterStatus" class="form-control">
                                    <option value="">@lang('All Statuses')</option>
                                    <option value="1">@lang('Published')</option>
                                    <option value="0">@lang('Unpublished')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div wire:loading class="text-center mt-2">
                        <i class="fas fa-spinner fa-spin"></i> @lang('Loading...')
                    </div>
                </div>
            </div>
        </div>

        <!-- News List -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 50px;">#</th>
                                    <th scope="col" class="text-center" style="width: 100px;">@lang('Image')</th>
                                    <th scope="col" style="min-width: 180px;">@lang('Title')</th>
                                    <th scope="col" style="min-width: 120px;">@lang('Author')</th>
                                    <th scope="col" style="min-width: 100px;">@lang('Published At')</th>
                                    <th scope="col" class="text-center" style="width: 150px;">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($newsItems as $news)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration + ($newsItems->currentPage() - 1) * $newsItems->perPage() }}
                                        </td>
                                        <td class="text-center">
                                            @if ($news->image)
                                                <img src="{{ $news->image }}" class="rounded thumbnail-img"
                                                    style="width: 60px; height: 60px; object-fit: cover;"
                                                    alt="@lang('News Image')">
                                            @else
                                                <span class="text-muted"><i class="fas fa-image"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="fw-bold">{{ $news->fr_title ?? ($news->en_title ?? 'N/A') }}</span>
                                                <small
                                                    class="text-muted">{{ Str::limit(strip_tags($news->fr_content ?? ($news->en_content ?? '')), 50) }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $news->user?->name ?? 'N/A' }}</td>
                                        <td>
                                            @if (!$news->published_at)
                                                <span class="badge bg-secondary">@lang('Pending')</span>
                                            @else
                                                <span class="badge bg-success">
                                                    {{ $news->published_at }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.news.show', $news) }}"
                                                    class="btn btn-sm btn-info" title="@lang('View Details')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.news.edit', $news) }}"
                                                    class="btn btn-sm btn-primary" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button wire:click="showPublishForm({{ $news->id }})"
                                                    class="btn btn-sm {{ $news->published_at ? 'btn-warning' : 'btn-success' }}"
                                                    title="{{ $news->published_at ? __('Unpublish') : __('Publish') }}">
                                                    <i
                                                        class="fas {{ $news->published_at ? 'fa-eye-slash' : 'fa-paper-plane' }}"></i>
                                                 
                                                </button>
                                                <button wire:click="showDeleteForm({{ $news->id }})"
                                                    class="btn btn-sm btn-danger" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            @lang('No news found.')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        @lang('Showing') {{ $newsItems->firstItem() }} @lang('to')
                        {{ $newsItems->lastItem() }}
                        @lang('of') {{ $newsItems->total() }} @lang('entries')
                    </div>
                    <div>
                        {{ $newsItems->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteNewsModal" tabindex="-1" aria-labelledby="deleteNewsModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h5 class="modal-title" id="deleteNewsModalLabel">@lang('Delete News')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure you want to delete the news') <strong>{{ $fr_title ?? 'N/A' }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal" wire:click="closeModal">@lang('Cancel')</button>
                        <button type="button" class="btn btn-danger" wire:click="destroyNews"
                            wire:loading.attr="disabled">
                            <span wire:loading wire:target="destroyNews">
                                <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Deleting...')
                            </span>
                            <span wire:loading.remove wire:target="destroyNews">
                                <i class="fas fa-trash mr-1"></i> @lang('Delete')
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publish/Unpublish Modal -->
        <div class="modal fade" id="publishNewsModal" tabindex="-1" aria-labelledby="publishNewsModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h5 class="modal-title" id="publishNewsModalLabel">
                            {{ $newsItems->find($publishId)?->published_at ? __('Unpublish News') : __('Publish News') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        {{ $newsItems->find($publishId)?->published_at
                            ? __('Are you sure you want to unpublish the news')
                            : __('Are you sure you want to publish the news') }}
                        <strong>{{ $fr_title ?? 'N/A' }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal" wire:click="closeModal">@lang('Cancel')</button>
                        <button type="button"
                            class="btn {{ $newsItems->find($publishId)?->published_at ? 'btn-warning' : 'btn-success' }}"
                            wire:click="togglePublish" wire:loading.attr="disabled">
                            <span wire:loading wire:target="togglePublish">
                                <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Processing...')
                            </span>
                            <span wire:loading.remove wire:target="togglePublish">
                                <i class="fas {{ $newsItems->find($publishId)?->published_at ? 'fa-eye-slash' : 'fa-paper-plane' }} mr-1"></i>
                                {{ $newsItems->find($publishId)?->published_at ? __('Unpublish') : __('Publish') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .table thead th {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-header {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        .modal-footer {
            border-top: 2px solid #FF6B35;
        }

        .input-group-text {
            background-color: #2A2E45;
            color: #F8F9FA;
            border: 1px solid #FF6B35;
        }

        .page-item.active .page-link {
            background-color: #2A2E45;
            border-color: #2A2E45;
        }

        .page-link {
            color: #2A2E45;
        }

        .thumbnail-img {
            transition: transform 0.2s;
        }

        .thumbnail-img:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openDeleteModal', () => {
                $('#deleteNewsModal').modal('show');
            });
            Livewire.on('openPublishModal', () => {
                $('#publishNewsModal').modal('show');
            });
            Livewire.on('closeModal', () => {
                $('#deleteNewsModal').modal('hide');
                $('#publishNewsModal').modal('hide');
            });
        });
    </script>
@endpush
