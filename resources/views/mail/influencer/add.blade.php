@component('mail::message')
# {{ $data['title'] ?? '' }}

Dear, {{ $data['first_name'] }} {{ $data['first_name'] }}<br>
You successfully registered as #{{ $data['role'] ?? '' }}<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
