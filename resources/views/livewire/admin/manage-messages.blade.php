<div class="col-12">
    <!-- Filtres -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
            <h5 class="mb-0"><i class="fas fa-filter mr-2"></i>@lang('Filter Messages')</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            placeholder="@lang('Search by name, email, subject...')">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                        <select wire:model.live="filterStatus" class="form-control">
                            <option value="">@lang('All Messages')</option>
                            @foreach ($statusOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                        <select wire:model.live="perPage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <button wire:click="resetFilters" class="btn btn-secondary w-100">
                        <i class="fas fa-undo-alt mr-1"></i> @lang('Reset')
                    </button>
                </div>
            </div>
            <div wire:loading class="text-center mt-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">@lang('Loading...')</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des messages -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <th class="text-center">#</th>
                        <th wire:click="sortBy('name')" style="cursor: pointer;">
                            @lang('Name')
                            @if ($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('subject')" style="cursor: pointer;">
                            @lang('Subject')
                            @if ($sortField === 'subject')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                            @lang('Received at')
                            @if ($sortField === 'created_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @endif
                        </th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </thead>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td class="p-0 text-center">
                                {{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>
                                <span class="badge bg-{{ $contact->response ? 'success' : 'warning' }}">
                                    {{ $contact->response ? __('Answered') : __('Not Answered') }}
                                </span>
                            </td>
                            <td>
                                <button wire:click="showModalForm({{ $contact }})"
                                    class="btn btn-{{ $contact->response ? 'primary' : 'danger' }} btn-sm">
                                    <i class="fas fa-eye"></i> @lang('View')
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h2>@lang('No messages found')</h2>
                                    <p class="lead">
                                        @lang('There are no messages matching your search criteria.')
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $contacts->links() }}
            </nav>
        </div>
    </div>

    <!-- Modal showMessage - Design amélioré -->
    <div wire:ignore.self class="modal fade" id="MessageModal" tabindex="-1" role="dialog"
        aria-labelledby="MessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                    <h5 class="modal-title" id="MessageModalLabel">
                        <i class="fas fa-envelope me-2"></i> @lang('Message Details')
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal()"
                        aria-label="Close"></button>
                </div>

                @if ($displayContact)
                    <div class="modal-body p-4">
                        <!-- En-tête du message avec info expéditeur -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="message-avatar me-3">
                                <div
                                    style="width: 50px; height: 35px; border-radius: 50%; background-color: #2A2E45; color: white; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold;">
                                    {{ strtoupper(substr($displayContact->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="message-sender-info flex-grow-1">
                                <h5 class="mb-0 fw-bold">{{ $displayContact->name }}</h5>
                                <p class="text-muted mb-0">
                                    <a href="mailto:{{ $displayContact->email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope-open me-1"></i> {{ $displayContact->email }}
                                    </a>
                                </p>
                            </div>
                            <div class="message-date text-end">
                                <span class="badge bg-light text-dark">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $displayContact->created_at }}
                                </span>
                                <br>

                            </div>
                        </div>

                        <!-- Sujet du message -->
                        <div class="message-subject mb-1">
                            <div class="card">
                                <div class="card-header bg-light py-2">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-tag me-1"></i> @lang('Subject')
                                    </h6>
                                </div>
                                <div class="card-body py-1">
                                    {{ $displayContact->subject }}
                                </div>
                            </div>
                        </div>

                        <!-- Contenu du message -->
                        <div class="message-content mb-4">
                            <div class="card">
                                <div class="card-header bg-light py-2">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-comment-alt me-2"></i> @lang('Message')
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="message-text p-2" style="min-height: 60px; text-align: justify;">
                                        {{ $displayContact->message }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Séparateur -->
                        <div class="message-divider my-4 position-relative">
                            <hr>
                            <span class="position-absolute top-0 start-50 translate-middle px-3 bg-white text-muted">
                                @if ($displayContact->response)
                                    <i class="fas fa-reply me-1"></i> @lang('Your Response')
                                @else
                                    <i class="fas fa-reply me-1"></i> @lang('Your Reply')
                                @endif
                            </span>
                        </div>

                        <!-- Formulaire de réponse ou réponse déjà envoyée -->
                        @if (!$displayContact->response)
                            <form wire:submit.prevent="replyMessage({{ $displayContact }})" id="InputRepyForm">
                                <div class="form-group mb-3">
                                    <textarea rows="6" wire:model.defer="reply" class="form-control @error('reply') is-invalid @enderror"
                                        placeholder="@lang('Type your reply here...')" style="resize: none;"></textarea>
                                    @error('reply')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Les boutons ont été déplacés vers le footer -->
                            </form>
                        @else
                            <div class="response-container">
                                <div class="card border-success">
                                    <div
                                        class="card-header bg-success bg-opacity-10 text-success py-2 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-bold">
                                            <i class="fas fa-check-circle me-2"></i> @lang('Response Sent')
                                        </h6>
                                        <small>
                                            <i class="far fa-clock me-1"></i> {{ $displayContact->updated_at }}
                                        </small>
                                    </div>
                                    <div class="card-body">
                                        <div class="response-text p-2" style="min-height: 80px; text-align: justify;">
                                            {{ $displayContact->response }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer bg-light">
                        @if (!$displayContact->response)
                            <!-- Boutons déplacés ici -->
                            <button type="button" class="btn btn-outline-secondary" wire:click="closeModal()">
                                <i class="fas fa-times me-1"></i> @lang('Cancel')
                            </button>
                            <button wire:loading.remove wire:target="replyMessage" type="submit" class="btn btn-primary"
                                onclick="document.getElementById('InputRepyForm').requestSubmit()">
                                <i class="fas fa-paper-plane me-1"></i> @lang('Send Response')
                            </button>
                            <button wire:loading wire:target="replyMessage" class="btn btn-primary" disabled>
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                @lang('Sending...')
                            </button>
                        @else
                            <button type="button" class="btn btn-secondary" wire:click="closeModal()">
                                <i class="fas fa-times me-1"></i> @lang('Close')
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', () => {
                $('#MessageModal').modal('show');
            });

            Livewire.on('closeModal', () => {
                $('#MessageModal').modal('hide');
            });
        });
    </script>
@endpush

