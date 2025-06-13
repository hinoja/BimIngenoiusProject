@extends('layouts.back')

@section('subtitle', __('Edit Project'))

@section('content')
    <x-admin.section-header :title="__('Edit Project')" :previousTitle="__('Projects')" :previousRouteName="route('admin.projects.index')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @livewire('admin.edit-project', ['project' => $project])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    @livewireStyles
@endpush

@push('js')
    @livewireScripts
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (data) => {
                Swal.fire({
                    icon: data.type,
                    title: data.title || (data.type === 'success' ? 'Success!' : 'Error!'),
                    text: data.message,
                    timer: data.timer || 3000,
                    showConfirmButton: data.showConfirmButton !== undefined ? data.showConfirmButton : true
                });
            });
        });
    </script>
@endpush

