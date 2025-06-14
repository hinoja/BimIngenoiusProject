@extends('layouts.admin')

@section('title', __('Edit News'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit News') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Débogage temporaire -->
                    <div class="alert alert-info">
                        Chargement du composant Livewire...
                        @if(isset($news))
                            News ID: {{ $news->id }}
                        @else
                            Variable $news non définie
                        @endif
                    </div>

                    @livewire('admin.edit-news', ['news' => $news])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            margin-bottom: 0;
        }
    </style>
@endpush

@push('scripts')
    @livewireScripts
@endpush

@push('styles')
    @livewireStyles
@endpush

