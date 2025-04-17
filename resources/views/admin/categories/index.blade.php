@extends('layouts.back')

@section('subtitle', __('Categories list'))

@section('content')
    <x-admin.section-header :title="__('Categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.users.index')" />

    <div class="section-body">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Add Category Form -->
                    <div class="col-lg-5 col-md-6 col-xs-12">
                        <div class="card border-0 rounded-lg">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="card-header bg-white border-bottom py-3">
                                    <h4 class="card-title mb-0">@lang('Add a new Category')</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="form-group">
                                        <label for="fr_name">@lang('French Name')</label>
                                        <input type="text" name="fr_name"
                                            class="form-control @error('fr_name') is-invalid @enderror" id="fr_name"
                                            placeholder="@lang('Enter the French name')" value="{{ old('fr_name') }}">
                                        @error('fr_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="en_name">@lang('English Name')</label>
                                        <input type="text" name="en_name" value="{{ old('en_name') }}"
                                            class="form-control @error('en_name') is-invalid @enderror" id="en_name"
                                            placeholder="@lang('Enter the English name')">
                                        @error('en_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fr_description">@lang('Enter the French description')</label>
                                        <textarea id="fr_description" name="fr_description" class="form-control summernote"> {{ old('fr_description') }} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fr_description">@lang('Enter the English description')</label>
                                        <textarea id="fr_description" name="en_description" class="form-control summernote">{{ old('en_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">@lang('Image')</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top py-3">
                                    <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                        <span wire:loading.remove>@lang('Add')</span>
                                        <span wire:loading>@lang('Processing...')</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-6 col-12">
                        @livewire('admin.manage-categories')
                    </div>
                </div>
                {{--
                <!-- Edit Modal -->
                <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">@lang('Edit Category')</h5>
                                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form wire:submit.prevent="updateCategory">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>@lang('French Name')</label>
                                        <input type="text" wire:model="editFrName" class="form-control"
                                            placeholder="@lang('French Name')" />
                                        @error('editFrName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('English Name')</label>
                                        <input type="text" wire:model="editEnName" class="form-control"
                                            placeholder="@lang('English Name')" />
                                        @error('editEnName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group" wire:ignore>
                                        <label>@lang('Description')</label>
                                        <textarea wire:model.defer="editDescription" id="editDescription" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Image')</label>
                                        <input type="file" wire:model="editImage" class="form-control" />
                                        @error('editImage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" wire:click="closeModal()"
                                        class="btn btn-secondary">@lang('Cancel')</button>
                                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}


            </div>

        </div>
    </div>
@endsection

@push('css')
    @livewireStyles()
    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
    </style>
@endpush

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    @livewireScripts()
@endpush
