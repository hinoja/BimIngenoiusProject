<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">
                {{ __('Edit Quote') }}
            </h2>
            <div>
                <a href="{{ route('admin.quotes.show', $quote) }}" class="btn btn-info me-2">
                    <i class="fas fa-eye me-1"></i> {{ __('View Quote') }}
                </a>
                <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Quotes') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        @livewire('admin.edit-quote', ['quote' => $quote])
    </div>
</x-app-layout>