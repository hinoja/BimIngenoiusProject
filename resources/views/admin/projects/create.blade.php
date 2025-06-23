@extends('layouts.back')

@section('subtitle', __('Create Project'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #2A2E45; color: #F8F9FA; border-bottom: 2px solid #FF6B35;">
                        <h4>@lang('Create New Project')</h4>
                    </div>
                    <div class="card-body">
                        @livewire('admin.add-project')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        trix-editor {
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 0.25rem;
            border-color: #ced4da;
        }

        trix-toolbar {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
    </style>
@endpush

@push('js')
    @livewireScripts
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush


