@extends('admin.layouts.master')

@section('content')
    @php
    use \Carbon\Carbon;
    @endphp
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Campaign Details ({{ $campaign->title ?? '' }})</h3>
                            <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Campaign List</a>
                            @if(\App\Helpers\AuthManager::isSuperAdmin() || \App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isInfluencerManager())
                                <a href="{{ route('backend.cms.campaign.influencer.create', [$campaign->id]) }}" type="button" class="btn btn-primary btn-sm text-white float-right mr-2">
                                    Add Influencer to Campaign
                                </a>
                            @endif
                            <div class="float-right mr-2">
                                <input type="checkbox" name="is_active" id="is_active"
                                       {{ $campaign->is_active ? 'checked' : '' }}
                                       data-bootstrap-switch
                                       data-on-text="Active"
                                       data-off-text="De-active"
                                >
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div class="profile-user-img img-fluid img-circle"
                                     style="background-image: url({{ $campaign->logo->file_url ?? config('core.image.default.logo_preview') }})">
                                </div>
                            </div>
                            <h3 class="profile-username text-center">{{ $campaign->title ?? '' }}</h3>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-body">
                            <strong>
                                Brand
                            </strong>
                            <p class="text-muted mb-0">
                                <span class="text-dark">Name: </span> {{ $campaign->brand->additionalInfo->first_name ?? '' }}
                                <br>
                                <span class="text-dark">Contact: </span> {{ $campaign->brand->email ?? '' }}
                                <br>
                                <a href="{{ route('backend.cms.brand.show', [$campaign->brand->id]) }}">
                                    <span class="badge badge-primary">
                                        View
                                    </span>
                                </a>
                            </p>
                            <hr>
                            <strong>
                                Start Date
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->start_date ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                First Content Online
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->first_content_online ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Cycle Count
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->cycle_count ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Cycle Time Unit
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->cycle_time_unit == 1 ? 'Monthly' : 'Weekly' }}
                            </p>
                            <hr>
                            <strong>
                                Next Deadline
                            </strong>
                            <p class="text-muted mb-0">
                                @php
                                    $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                    if ($campaign->cycle_time_unit == 1)
                                        $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                    else if ($campaign->cycle_time_unit == 2)
                                        $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                @endphp
                                {{ $next_deadline->format('M d, Y') ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Products
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->product_ids ?? []))
                                    @foreach($campaign->product_ids as $index => $category)
                                        <span class="badge badge-primary">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Target Group Influencer Category
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->target_influencer_category_ids ?? []))
                                    @foreach($campaign->target_influencer_category_ids as $index => $category)
                                        <span class="badge badge-primary">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Target Group Influencer Gender
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->target_influencer_genders ?? []))
                                    @foreach($campaign->target_influencer_genders as $index => $gender)
                                        <span class="badge badge-success">
                                            {{ $gender == 1 ? 'Male' : '' }}
                                            {{ $gender == 2 ? 'Female' : '' }}
                                            {{ $gender == 3 ? 'Others' : '' }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Age Range
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->target_influencer_lower_age ?? 0 }} - {{ $campaign->target_influencer_upper_age ?? 0 }}
                            </p>
                            <hr>
                            <strong>
                                Amount of Influencer Per Cycle
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->amount_of_influencer_per_cycle ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Amount of Influencer Follower Per Cycle
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->amount_of_influencer_follower_per_cycle ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Offer Signed
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->offer_signed == 1 ? 'Yes' : 'No' }}
                            </p>
                            <hr>
                            <strong>
                                Start of Recurring Bill
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->start_of_recurring_bill ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Count
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->billing_cycle_count ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Time Unit
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->billing_cycle_time_unit == 1 ? 'Monthly' : 'Weekly' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Next Deadline
                            </strong>
                            <p class="text-muted mb-0">
                                @php
                                    $start_of_recurring_bill = \Carbon\Carbon::parse($campaign->start_of_recurring_bill);
                                    if ($campaign->billing_cycle_time_unit == 1)
                                        $next_deadline = $start_of_recurring_bill->addMonths($campaign->billing_cycle_count);
                                    else if ($campaign->billing_cycle_time_unit == 2)
                                        $next_deadline = $start_of_recurring_bill->addWeeks($campaign->billing_cycle_count);
                                @endphp
                                {{ $next_deadline->format('M d, Y') ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Euros Total
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->euros_total ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>-->

                <div class="col-md-12">
                    @if(!\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                <h6 class="float-left">Influencers</h6>
                                <a href="{{ route('backend.cms.campaign.pre-selection', [$campaign->id]) }}" type="button" class="btn btn-dark btn-sm text-white float-right">
                                    Add Influencer From Pre-selection
                                </a>
                            </div>
                            <div class="card-body">
                                @if(count($campaign->campaignInfluencers))
                                    <div class="influencer-list">
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped projects">
                                                <thead>
                                                <tr>
                                                    <th>Influencer Name</th>
                                                    <th>Instagram Profile</th>
                                                    <th>Instagram Follower</th>
                                                    <th>Tiktok Profile</th>
                                                    <th>Tiktok Follower</th>
                                                    <th>Start Date</th>
                                                    <th>Fee</th>
                                                    <th>Content Type</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($campaign->campaignInfluencers as $index => $campaignInfluencer)
                                                    <tr>
                                                        @php
                                                            $influencer = $campaignInfluencer->user ?? null;
                                                            $campaign = $campaignInfluencer->campaign ?? null;
                                                        @endphp

                                                        <td>
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <a data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        <i class="far fa-clone mr-3"></i>
                                                                    </a>
                                                                    <a class="font-weight-bold text-dark" data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        <img alt="Avatar" class="table-avatar" src="{{ $influencer->avatar->file_url ??
                                                                            ($influencer->additionalInfo->gender == 2 ?
                                                                            config('core.image.default.avatar_female') :
                                                                            config('core.image.default.avatar_male')) }}"
                                                                        >
                                                                    </a>
                                                                    <a class="font-weight-bold text-dark ml-2" data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        {{ $influencer->additionalInfo->first_name ?? '' }}
                                                                        {{ $influencer->additionalInfo->last_name ?? '' }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            @if(isset($influencer->socialAccountInfo->instagram_username))
                                                                <a target="_blank" href="https://instagram.com/{{ $influencer->socialAccountInfo->instagram_username }}">
                                                                    {{ '@' . $influencer->socialAccountInfo->instagram_username }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->instagram_followers ?? 0) }}
                                                        </td>
                                                        <td>
                                                            @if(isset($influencer->socialAccountInfo->tiktok_username))
                                                                <a target="_blank" href="https://tiktok.com/{{ $influencer->socialAccountInfo->tiktok_username }}">
                                                                    {{ '@' . $influencer->socialAccountInfo->tiktok_username }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->tiktok_followers ?? 0) }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->start_date ?? '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->fee }}&euro;
                                                        </td>
                                                        <td>
                                                            <small class="text-primary font-weight-bold">
                                                                @foreach($campaignInfluencer->content_types as $c_index => $content_type)
                                                                    {{ $content_type }}
                                                                    @if($c_index + 1 < count($campaignInfluencer->content_types))
                                                                        {{ ',' }}
                                                                    @endif
                                                                @endforeach
                                                            </small>
                                                            {{-- modal --}}
                                                            <div class="modal fade" id="modal-xl-{{ $index }}" style="display: none;" aria-hidden="true">

                                                                @php
                                                                    $uploaded_content = 0;
                                                                    foreach($campaignInfluencer->content_types as $index => $content_type) {
                                                                        $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . \Str::snake($content_type);
                                                                        $uploaded_content += isset($campaignInfluencer->getMedia($media_collection)[0]);
                                                                    }
                                                                    $missing_contents = count($campaignInfluencer->content_types ?? []) - $uploaded_content;
                                                                @endphp

                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="row w-100">
                                                                                <div class="col-md-6">
                                                                                    <div class="d-inline-block position-relative" style="top: -30px">
                                                                                        <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 80px; width: 80px" src="{{ $influencer->avatar->file_url ??
                                                                                            ($influencer->additionalInfo->gender == 2 ?
                                                                                            config('core.image.default.avatar_female') :
                                                                                            config('core.image.default.avatar_male')) }}"
                                                                                        >
                                                                                    </div>

                                                                                    <div class="ml-1 d-inline-block">
                                                                                        <h4 class="modal-title">
                                                                                            <span class="d-block font-weight-bold text-md">
                                                                                                {{ $influencer->additionalInfo->first_name ?? '' }}
                                                                                                    {{ $influencer->additionalInfo->last_name ?? '' }}
                                                                                            </span>
                                                                                        </h4>
                                                                                        <span class="d-block text-sm text-gray">
                                                                                            {{ $influencer->email ?? '' }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            <i class="fab fa-instagram mr-2"></i> {{ $influencer->socialAccountInfo->instagram_username }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            <i class="fab fa-tiktok mr-2"></i> {{ $influencer->socialAccountInfo->tiktok_username }}
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="ml-4 d-inline-block">
                                                                                        <span class="d-block font-weight-bold text-md">

                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Follower
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ $influencer->socialAccountInfo->instagram_followers }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ $influencer->socialAccountInfo->tiktok_followers }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {!! Form::open(['url' => route('backend.cms.campaign-influencer.reminder', [$campaignInfluencer->id]), 'method' => 'put']) !!}
                                                                                    <div class="d-inline-block text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Briefing Reminder
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->briefing_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="briefing_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ Carbon::now()->gt(Carbon::parse($campaignInfluencer->created_at)->addDays(2)) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="d-inline-block ml-4 text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Content Reminder
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->content_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="content_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ !$uploaded_content && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="d-inline-block ml-4 text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Missing Content Reminder
                                                                                            @if(!$missing_contents && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))))
                                                                                                <span class="badge badge-danger">
                                                                                                    {{ $missing_contents }}
                                                                                                </span>
                                                                                            @endif
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->missing_content_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="missing_content_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ (count($campaignInfluencer->content_types ?? []) > $uploaded_content) && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    {!! Form::close() !!}
                                                                                </div>
                                                                            </div>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 table-responsive">
                                                                                    <table class="table w-100" style="height: 180px">
                                                                                        <tr>
                                                                                            <th class="align-middle">Campaign</th>
                                                                                            <th class="align-middle">Start Date</th>
                                                                                            <th class="align-middle">Deadline, Time Left</th>
                                                                                            <th class="align-middle">Briefing Reminder</th>
                                                                                            <th class="align-middle">Content Reminder</th>
                                                                                            <th class="align-middle">Missing Content Reminder</th>
                                                                                            <th class="align-middle">Duration</th>
                                                                                            <th class="align-middle">Content</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            @php
                                                                                                $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                                                                if ($campaign->cycle_time_unit == 1)
                                                                                                    $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                                                                                else if ($campaign->cycle_time_unit == 2)
                                                                                                    $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                                                                            @endphp

                                                                                            <td>{{ $campaign->title ?? '' }}</td>
                                                                                            <td>{{ $campaignInfluencer->campaign->start_date ?? '' }}</td>
                                                                                            <td>{{ $next_deadline->format('d.m.Y') ?? '' }}, {{ $next_deadline->diffInDays() }} days</td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->briefing_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->briefing_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->briefing_reminders_at ?? [] as $c_index => $briefing_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($briefing_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->content_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->content_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->content_reminders_at ?? [] as $c_index => $content_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($content_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->missing_content_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->missing_content_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->missing_content_reminders_at ?? [] as $c_index => $missing_content_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($missing_content_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $campaign->cycle_count }}
                                                                                                @if ($campaign->cycle_time_unit == 1)
                                                                                                    Months
                                                                                                @elseif ($campaign->cycle_time_unit == 2)
                                                                                                    Weeks
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $uploaded_content }} / {{ count($campaignInfluencer->content_types ?? []) }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        @foreach($campaignInfluencer->content_types as $index => $content_type)
                                                                                            @php
                                                                                                $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . \Str::snake($content_type);
                                                                                            @endphp
                                                                                            <div class="col-md-4">
                                                                                                <div class="card">
                                                                                                    <div class="card-header">
                                                                                                        <div class="card-title">
                                                                                                            {{ $content_type }}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="card-body">
                                                                                                        <div class="form-group text-center">
                                                                                                            @error($media_collection)
                                                                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                                                            @enderror
                                                                                                            @if(isset($campaignInfluencer->getMedia($media_collection)[0]))
                                                                                                                {!! Form::open(['url' => route('backend.cms.campaign-influencer.feedback', [$campaignInfluencer->id]), 'method' => 'put']) !!}
                                                                                                                <div class="image-output" style="border: 1px solid #bebebe">
                                                                                                                    <img src="{{ $campaignInfluencer->getMedia($media_collection)[0]->getUrl() }}" class="w-100" style="height: 100px" />
                                                                                                                </div>
                                                                                                                <div class="form-group text-left mt-2">
                                                                                                                    <label>Grade</label>
                                                                                                                    <input name="grade_{{ \Str::snake($content_type) }}" value="{{ old('grade_' . \Str::snake($content_type)) ?? $campaignInfluencer->feedback['grade_' . \Str::snake($content_type)] ?? '' }}" type="number" min="0" placeholder="Grade" class="form-control" required />
                                                                                                                </div>
                                                                                                                <div class="form-group text-left mt-2">
                                                                                                                    <label>Feedback</label>
                                                                                                                    <textarea name="feedback_{{ \Str::snake($content_type) }}" rows="3" class="form-control" required>
                                                                                                                    {{ old('feedback_' . \Str::snake($content_type)) ?? $campaignInfluencer->feedback['feedback_' . \Str::snake($content_type)] ?? '' }}
                                                                                                                </textarea>
                                                                                                                </div>
                                                                                                                <div class="form-group text-left mt-2">
                                                                                                                    <button class="btn btn-primary btn-sm">Send</button>
                                                                                                                </div>
                                                                                                                {!! Form::close() !!}
                                                                                                            @else
                                                                                                                <div class="m-auto pt-3 text-center">
                                                                                                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                                                                                                    <span class="d-block text-danger">Content Not Uploaded</span>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-user"></i>
                                        <span class="d-block">No Influencer Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                <h6>Brands</h6>
                            </div>
                            <div class="card-body">
                                @if(count($brands))
                                    <div class="brand-list">
                                        <div class="row">
                                            @foreach($brands as $index => $brand)
                                                <div class="col-lg-4 col-6">
                                                    <div class="small-box bg-gradient-secondary">
                                                        <div class="inner text-justify">
                                                            <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 80px; width: 80px; margin-left: calc(50% - 40px);"
                                                                 src="{{ $brand->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                            >
                                                        </div>

                                                        <a class="small-box-footer"
                                                           data-toggle="modal" href="#modal-lg-{{ $index }}"
                                                        >
                                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>

                                                        <div class="modal fade" id="modal-lg-{{ $index }}" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg text-dark">
                                                                <div class="modal-content text-left">
                                                                    <div class="modal-header">
                                                                        <div class="d-inline-block position-relative" style="top: 14px">
                                                                            <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 60px; width: 60px"
                                                                                 src="{{ $brand->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="ml-2">
                                                                            <h4 class="modal-title">
                                                                                <span class="font-weight-bold text-md">
                                                                                    {{ $brand->additionalInfo->first_name ?? '' }}
                                                                                </span>
                                                                            </h4>
                                                                            <span class="text-sm font-weight-normal">
                                                                                Here you‘ll find all relevant information about the brand {{ $brand->additionalInfo->first_name ?? '' }}. You will recieve further information when your package has been sent out.
                                                                            </span>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <span class="d-block font-weight-bold">Additional Info</span>
                                                                                <div class="form-group">
                                                                                    <textarea rows="3" class="form-control" readonly>
                                                                                        {{ $brand->additionalInfo->about ?? 'N/A' }}
                                                                                    </textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-product-hunt"></i>
                                        <span class="d-block">No Brand Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .influencer-list {
            max-height: 600px;
            overflow-y: scroll;
        }
        .influencer-list::-webkit-scrollbar {
            display: none;
        }

        .brand-list {
            max-height: 400px;
            overflow-y: scroll;
        }
        .brand-list::-webkit-scrollbar {
            display: none;
        }

        ul.box-footer {
            list-style: none;
            display: flex;
            background-color: rgba(0,0,0,.1);
            color: rgba(255,255,255,.8);
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        ul.box-footer li {
            width: 33.33%;
        }
        ul.box-footer li a {
            color: #fff;
        }
        ul.box-footer li a:hover {
            color: #fff3cd;
        }

        ul.box-body {

        }
        ul.box-body li {
            width: 42%;
        }
        th, td {white-space:nowrap; text-align: left}
    </style>
    <style>
        .tooltip2 {
            position: relative;
            display: inline-block;
        }

        .tooltip2 .tooltiptext {
            visibility: hidden;
            width: 180px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 2;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip2 .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip2:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("input[name=is_active]").on('switchChange.bootstrapSwitch',function (e, data) {
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token()}}'
                    }
                });
                $.ajax({
                    url: '{{ route('backend.cms.campaign.active-status.update', [$campaign->id]) }}',
                    method: 'POST',
                    data: {
                        is_active: data ? 1 : 0
                    },
                    success: function(){}
                })
            });
    </script>
@stop
