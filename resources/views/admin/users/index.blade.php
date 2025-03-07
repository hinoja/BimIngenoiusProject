@extends('layouts.back')

@section('subtitle', __('Users list'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <x-livewire-alert::scripts /> --}}
    <x-admin.section-header :title="__('Users list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>Email</th>
                                        <th>@lang('Role')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                    {{ $user->role->name === 'admin' ? 'badge-admin' : '' }}
                                                    {{ $user->role->name === 'author' ? 'badge-author' : '' }}
                                                    {{ $user->role->name === 'editor' ? 'badge-editor' : '' }}">
                                                    {{ ucfirst($user->role->name) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($user->role_id !== 1)
                                                    @if (!$user->is_active && $user->disabled_by !== auth()->id() && $user->disabled_at)
                                                        <a role="link" aria-disabled="true" class="btn btn-secondary"
                                                            title="@lang('You cannot enable this account because it was disabled by its owner.')">@lang('Unblock')</a>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('admin.users.status', $user->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <a href="{{ route('admin.users.status', $user->id) }}"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();"
                                                                class="btn btn-{{ $user->is_active ? 'danger' : 'primary' }}">
                                                                <i
                                                                    class="fas {{ $user->is_active ? 'fa-lock' : 'fa-unlock' }}"></i>
                                                                @if ($user->is_active)
                                                                    @lang('Block')
                                                                @else
                                                                    @lang('Unblock')
                                                                @endif
                                                            </a>
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap5.min.css') }}">
        <style>
            /* Custom Styles */
            .table th,
            .table td {
                vertical-align: middle;
            }

            .badge {
                font-size: 14px;
                padding: 8px 12px;
                border-radius: 20px;
            }

            .badge-admin {
                background-color: #4CAF50;
                /* Vert */
                color: white;
            }

            .badge-author {
                background-color: #007bff;
                /* Bleu */
                color: white;
            }

            .badge-editor {
                background-color: #FFC107;
                /* Jaune */
                color: black;
            }

            .btn-action {
                min-width: 100px;
            }

            .btn-block {
                background-color: #dc3545;
                color: white;
            }

            .btn-unblock {
                background-color: #6610f2;
                color: white;
            }
        </style>
    @endpush
@endpush
@push('js')
    <script src="{{ asset('assets/back/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/back/js/page/modules-datatables.js') }}"></script>
@endpush
