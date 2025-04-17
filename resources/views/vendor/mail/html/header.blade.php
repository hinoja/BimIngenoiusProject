@props(['url'])
<tr>
    <td class="header">
        <a href="{{ url('/') }}" style="display: inline-block;">
            @if (trim($slot) === 'BIM INGENIOUS BTP')
                <img src="{{ asset('assets/front/images/logo.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
