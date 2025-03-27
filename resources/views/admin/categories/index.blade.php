@extends('layouts.back')

@section('subtitle', __('Categories list'))

@section('content')


<x-admin.section-header :title="__('Categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

<div class="section-body">
    <div class="row">
        @livewire('admin.manage-categories')
    </div>
</div>
@endsection

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts()
    {{-- <livewire:toaster /> --}}
    <script type="text/javascript">
        // close message  modal
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                // code
                $('#AddCategory').modal('hide');
                $('#deleteCategory').modal('hide');
            });
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', () => {
                // code
                $('#AddCategory').modal('show');
            });


            //Edit Category Modal
            Livewire.on('openEditModal', () => {
                $('#AddCategory').modal('show');
            });
        });

        // Delete category modal
        Livewire.on('openDeleteModal', () => {
            // code
            $('#deleteCategory').modal('show');

        });
    </script> 
@endpush
@push('css')
    @livewireStyles()
@endpush
