@extends('layouts.back')

@section('subtitle', __('Projects list'))

@section('content')

    <x-admin.section-header :title="__('Projects list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">

            @livewire('admin.manage-projets')
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts()
    <script>
        Livewire.on('closeModal', () => {
            $('#projectModal').modal('hide');
            $('#deleteProjectModal').modal('hide');
            $('#detailsProjectModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove(); // Supprime les fonds résiduels
        });
        Livewire.on('showToast', (type, message) => {
            toastr[type](message);
        });
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-modal', (event) => {
                const modalType = event.type;
                document.body.classList.add('modal-open');
                // Initialisation spécifique au modal si nécessaire
            });

            Livewire.on('close-modal', (event) => {
                const modalType = event.type;
                document.body.classList.remove('modal-open');
                Livewire.dispatch('reset-file-input');
            });

            Livewire.on('reset-file-input', () => {
                const inputs = document.querySelectorAll('input[type="file"]');
                inputs.forEach(input => input.value = '');
            });
        });
    </script>
    <script>
        Livewire.on('closeModal', () => {
            $('#projectModal').modal('hide');
            $('#deleteProjectModal').modal('hide');
            $('#detailsProjectModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove(); // Supprime les fonds résiduels
        });
        document.addEventListener('alpine:init', () => {
            Alpine.data('projectForm', () => ({
                images: [],

                init() {
                    Livewire.on('notify', (data) => {
                        this.showNotification(data);
                    });

                    Livewire.on('close-modal', (modalId) => {
                        this.openModal = null;
                    });
                },

                showNotification({
                    type,
                    message,
                    duration = 3000
                }) {
                    const notification = document.createElement('div');
                    notification.className = `notification bg-${type} text-white p-4 rounded-lg mb-3`;
                    notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} mr-2"></i>
                ${message}
            `;

                    document.querySelector('.notification-container').appendChild(notification);

                    setTimeout(() => {
                        notification.remove();
                    }, duration);
                },

                handleImageUpload(event) {
                    const files = Array.from(event.target.files);
                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.images.push({
                                file,
                                url: e.target.result
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                },

                removeImage(index) {
                    this.images.splice(index, 1);
                }
            }));
        });
    </script>
@endpush
@push('css')
    @livewireStyles()
@endpush
