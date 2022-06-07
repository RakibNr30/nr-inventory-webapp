@component('mail::message')
    # {{ $data['title'] ?? '' }}

    Dear, {{ $data['brand_name'] }}<br>
    You successfully registered as #{{ $data['role'] ?? '' }}<br><br>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
