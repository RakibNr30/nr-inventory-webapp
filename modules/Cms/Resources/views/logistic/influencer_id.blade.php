<div>
    @php
    $userPrefix = \Modules\Ums\Entities\UserPrefix::query()->firstOrCreate([
        'id' => 1
    ]);
    @endphp

    <span>
        {{ $userPrefix->prefix . $data->influencer_id ?? '' }}
    </span>
</div>
