@extends('layouts.back')

@section('subtitle', __('Contacts list'))

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-admin.section-header :title="__('Contacts list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-messages')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    <script type="text/javascript">
        // close message  modal
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeModal', () => {
                // code
                $('#MessageModal').modal('hide');
                $('#InputRepyForm').modal('hide');
            });
        });


        document.addEventListener('livewire:init', () => {
            Livewire.on('openModal', () => {
                // code
                $('#MessageModal').modal('show');

            });
        });
    </script>
@endpush

@push('css')
    @livewireStyles
    <style>
        /* Styles généraux */
        .empty-state {
            text-align: center;
            padding: 40px 0;
        }
        .empty-state-icon {
            font-size: 50px;
            color: #ccc;
            margin-bottom: 20px;
        }

        /* Styles pour le modal de message */
        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header .btn-close {
            color: white;
            opacity: 0.8;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .message-avatar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message-divider {
            height: 20px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 8px 8px 0 0 !important;
        }

        .message-text, .response-text {
            line-height: 1.6;
        }

        textarea.form-control {
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        textarea.form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(42, 46, 69, 0.25);
            border-color: #2A2E45;
        }

        .btn {
            border-radius: 6px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #2A2E45;
            border-color: #2A2E45;
        }

        .btn-primary:hover {
            background-color: #1e2132;
            border-color: #1e2132;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
    </style>
@endpush

