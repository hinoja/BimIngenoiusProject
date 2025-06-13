@props(['url'])
<tr>
    <td class="header">
        <a href="{{ url('/') }}" style="display: inline-block;">
            <img src="{{ asset('logo.jpg') }}" class="logo" alt="{{ config('app.name') }}" style="max-width: 150px; height: auto; display: block; margin: 0 auto;">
            <h1 style="color: #ffffff; font-size: 24px; margin: 15px 0 0 0; font-weight: 600;">{{ config('app.name') }}</h1>
        </a>
    </td>
</tr>
