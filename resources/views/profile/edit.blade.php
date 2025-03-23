@extends('layouts.back')

@section('subtitle', __('Profile'))

@push('css')
    <style>
        /* Styles pour respecter la charte graphique BIM INGENIOUS BTP */
        .profile-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            background-color: #FFFFFF;
        }

        .card-header {
            background-color: #2A2E45;
            color: #F8F9FA;
            border-bottom: 3px solid #FF6B35;
            padding: 1.5rem;
        }

        .card-header h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Style pour la photo de profil */
        .profile-picture-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 2rem;
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #FF6B35;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .profile-picture-input {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 44px;
            height: 44px;
            background-color: #FF6B35;
            color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-picture-input:hover {
            background-color: #E55A2B;
            transform: scale(1.1);
        }

        .profile-picture-input input {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        /* Style des formulaires */
        .form-section {
            margin-bottom: 3rem;
            padding: 1.5rem;
            background-color: rgba(42, 46, 69, 0.03);
            border-radius: 8px;
        }

        .form-section h5 {
            font-size: 1.15rem;
            color: #2A2E45;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #FF6B35;
            padding-bottom: 0.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: #2A2E45;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #6C757D;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }

        /* Style pour les champs de mot de passe avec toggle */
        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6C757D;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: #FF6B35;
        }

        /* Boutons */
        .btn-primary {
            background-color: #FF6B35;
            border-color: #FF6B35;
            color: #FFFFFF;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #E55A2B;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            background-color: #6C757D;
            border-color: #6C757D;
            color: #FFFFFF;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Indicateur de chargement */
        .btn.loading .spinner-border {
            display: inline-block;
        }

        .btn .spinner-border {
            display: none;
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
        }

        /* Alertes */
        .alert {
            border-radius: 8px;
            margin-bottom: 2rem;
        }
    </style>
@endpush

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 profile-container">
                <div class="card">
                    <div class="card-header">
                        <h4>@lang('Profile')</h4>
                    </div>
                    <div class="card-body">
                        <!-- Affichage des messages de statut -->
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @lang('Profile updated successfully!')
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                @lang('Password updated successfully!')
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Section : Photo de profil -->
                        <div class="text-center form-section">
                            <div class="profile-picture-wrapper">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/back/img/avatar/avatar-1.png') }}"
                                    alt="@lang('Profile Picture')" class="profile-picture" id="profile-picture-preview">
                                <label class="profile-picture-input">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" name="avatar" id="avatar-input" accept="image/*">
                                </label>
                            </div>
                        </div>

                        <!-- Section : Informations du profil -->
                        <div class="form-section">
                            <h5>@lang('Profile Information')</h5>
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile-form">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name">@lang('Name')</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">@lang('Email')</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        @lang('Save Changes')
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Section : Mise à jour du mot de passe -->
                        <div class="form-section">
                            <h5>@lang('Update Password')</h5>
                            <form method="POST"  id="password-form">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="current_password">@lang('Current Password')</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="current_password" id="current_password"
                                                    class="form-control @error('current_password') is-invalid @enderror">
                                                <i class="fas fa-eye password-toggle" data-target="current_password"></i>
                                            </div>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="password">@lang('New Password')</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror">
                                                <i class="fas fa-eye password-toggle" data-target="password"></i>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="password_confirmation">@lang('Confirm New Password')</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="password_confirmation" id="password_confirmation"
                                                    class="form-control">
                                                <i class="fas fa-eye password-toggle" data-target="password_confirmation"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        @lang('Update Password')
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Section : Suppression du compte -->
                        <div class="form-section">
                            <h5>@lang('Delete Account')</h5>
                            <form method="POST" action="{{ route('profile.destroy') }}" id="delete-form">
                                @csrf
                                @method('DELETE')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="delete_password">@lang('Password')</label>
                                            <div class="password-wrapper">
                                                <input type="password" name="password" id="delete_password"
                                                    class="form-control @error('password', 'userDeletion') is-invalid @enderror" required>
                                                <i class="fas fa-eye password-toggle" data-target="delete_password"></i>
                                            </div>
                                            @error('password', 'userDeletion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        @lang('Delete Account')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Prévisualisation de la photo de profil
            const avatarInput = document.getElementById('avatar-input');
            const avatarPreview = document.getElementById('profile-picture-preview');

            if (avatarInput) {
                avatarInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            avatarPreview.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Gestion des formulaires avec indicateur de chargement
            const forms = document.querySelectorAll('#profile-form, #password-form, #delete-form');
            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    const button = form.querySelector('button[type="submit"]');
                    button.classList.add('loading');
                    button.disabled = true;
                });
            });

            // Toggle visibilité des mots de passe
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const targetId = toggle.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    toggle.classList.toggle('fa-eye', !isPassword);
                    toggle.classList.toggle('fa-eye-slash', isPassword);
                });
            });

            // Confirmation avant suppression du compte
            const deleteForm = document.getElementById('delete-form');
            if (deleteForm) {
                deleteForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const form = e.target;
                    const button = form.querySelector('button[type="submit"]');

                    Swal.fire({
                        title: '@lang("Are you sure you want to delete your account?")',
                        text: '@lang("This action cannot be undone.")',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#FF6B35',
                        cancelButtonColor: '#6C757D',
                        confirmButtonText: '@lang("Yes, delete it")',
                        cancelButtonText: '@lang("Cancel")'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            button.classList.add('loading');
                            button.disabled = true;
                            form.submit();
                        } else {
                            button.classList.remove('loading');
                            button.disabled = false;
                        }
                    });
                });
            }
        });
    </script>
@endpush
