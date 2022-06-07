@component('mail::message')
# {{ $data['title'] ?? '' }}

Dear, {{ $data['first_name'] }} {{ $data['first_name'] }}
You successfully registered as <b>#{{ $data['register_as'] ?? '' }}</b>


You can login now,<br>

@component('mail::button', ['url' => $data['login_url'] ?? ''])
LOGIN
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
