@component('mail::message')
# {{ $data['title'] ?? '' }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
