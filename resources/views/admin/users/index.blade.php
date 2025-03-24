@extends('layouts.back')

@section('subtitle', __('Users list'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <style>
        /* Insérez ici le CSS personnalisé ci-dessus */
        .btn-rounded {
            border-radius: 30px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: transform 0.2s ease;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <x-admin.section-header :title="__('Users list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users-cog mr-2"></i>@lang('User Management')
                        </h4>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-add">
                            <i class="fas fa-user-plus mr-2"></i>@lang('Add User')
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Role')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm mr-3">
                                                        <i class="fas fa-user-circle"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">@lang('Registered')
                                                            {{ $user->created_at?->diffForHumans() ?? __('N/a') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="mailto:{{ $user->email }}" class="text-primary">
                                                        <i class="fas fa-envelope mr-1"></i>{{ $user->email }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-admin">
                                                    <i class="fas fa-shield-alt"></i>
                                                    {{ ucfirst($user->role->name) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($user->role_id !== 1)
                                                    <div class="d-flex gap-2">
                                                        @if (!$user->is_active && $user->disabled_by !== auth()->id() && $user->disabled_at)
                                                            <button class="btn-action btn-secondary" disabled
                                                                title="@lang('You cannot enable this account because it was disabled by its owner.')">
                                                                <i class="fas fa-lock-open"></i> @lang('Unlock')
                                                            </button>
                                                        @else
                                                            <form method="POST"
                                                                action="{{ route('admin.users.status', $user->id) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="btn btn-icon {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                                    data-toggle="tooltip"
                                                                    title="{{ $user->is_active ? __('Block User') : __('Unblock User') }}">
                                                                    <i
                                                                        class="fas {{ $user->is_active ? 'fa-lock' : 'fa-lock-open' }}"></i>
                                                                </button>

                                                            </form>
                                                        @endif
                                                    </div>
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

@push('js')
    <script src="{{ asset('assets/back/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets/back/js/page/modules-datatables.js') }}"></script>
@endpush
