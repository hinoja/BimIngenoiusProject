@php
    $url = urlencode(request()->fullUrl());
@endphp

@push('css')
    <style>
        span {
            font-weight: bold;
        }
    </style>
@endpush

<span>@lang('Share:')</span> 
<a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" rel="noopener noreferrer">Facebook</a>,
<a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ urlencode($data->title) }}" target="_blank" rel="noopener noreferrer">Twitter</a>,
<a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&title={{ urlencode($data->title) }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>,
<a href="https://api.whatsapp.com/send?text={{ urlencode($data->title . ' ' . request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>