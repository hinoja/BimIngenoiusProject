@props(['title', 'previousTitle', 'previousRouteName'])

<div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ $previousRouteName }}">{{ $previousTitle }}</a>
        </div>
        <div class="breadcrumb-item">{{ $title }}</div>
    </div>
</div>
