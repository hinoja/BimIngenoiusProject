@props(['color', 'icon', 'value', 'label'])

@php
    // Définir la couleur du texte selon la couleur de fond
    $textColor = in_array($color, ['warning', 'light', 'info']) ? 'text-dark' : 'text-white';
@endphp

<div class="col-md-4 col-sm-6 mb-4">
    <div class="card card-statistic-1 shadow-sm h-100">
        <div class="card-icon bg-{{ $color }} {{ $textColor }}">
            <i class="fas fa-{{ $icon }}" style="font-size: 2em;"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $label }}</h4>
            </div>
            <div class="card-body">
                {{ $value }}
            </div>
        </div>
    </div>
</div>
