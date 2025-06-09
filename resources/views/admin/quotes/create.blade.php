<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('Create New Quote') }}
            </h2>
            <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Quotes') }}
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        @livewire('admin.add-quote')
    </div>
</x-app-layout>