<!-- Élément de menu pour les devis -->
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.quotes.*') ? 'active' : '' }}" href="{{ route('admin.quotes.index') }}">
        <i class="fas fa-file-invoice-dollar me-2"></i>
        <span>@lang('Quotes')</span>
        <span class="badge bg-primary rounded-pill ms-auto">
            {{ \App\Models\Quote::where('status', 'pending')->count() }}
        </span>
    </a>
</li>