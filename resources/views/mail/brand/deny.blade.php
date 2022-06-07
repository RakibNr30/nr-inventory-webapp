@component('mail::message')
    # {{ $data['title'] ?? '' }}

    Dear, {{ $data['brand_name'] }}<br>
    You are denied by {{ $data['influencer_name'] }} from {{ $data['campaign_name'] }} campaign<br><br>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
