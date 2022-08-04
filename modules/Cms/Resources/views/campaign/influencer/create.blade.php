@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Add Influencer to Campaign</h3>
                            <a href="{{ route('backend.cms.campaign.show', [request()->id]) }}" type="button" class="btn btn-dark btn-sm text-white float-right">Back to Campaign</a>
                        </div>

                        {!! Form::open(['url' => route('backend.cms.campaign.influencer.store', [request()->id]), 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="influencer_id" class="@error('influencer_id') text-danger @enderror">Choose an influencer</label>
                                        <select id="influencer_id" name="influencer_id"
                                                class="form-control select2 @error('influencer_id') is-invalid @enderror" data-placeholder="Select an influencer">
                                            @foreach($influencers as $influencer)
                                                <option value="{{ $influencer->id }}" {{ old('influencer_id') == $influencer->id ? 'selected' : '' }}>
                                                    {{ $influencer->additionalInfo->first_name ?? '' }} {{ $influencer->additionalInfo->last_name ?? '' }} ({{ $influencer->email ?? '' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('influencer_id')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="brand_ids" class="@error('brand_ids') text-danger @enderror">Choose Brand Campaigns</label>
                                        <select id="brand_ids" name="brand_ids[]"
                                                class="form-control select2 @error('brand_ids') is-invalid @enderror" data-placeholder="Select a brand campaign" multiple>
                                            @foreach($brandCampaigns->groupBy('brand_id') as $brandCampaigns)
                                                <optgroup label="{{ $brandCampaigns[0]->brand->additionalInfo->first_name ?? '' }}">
                                                    @foreach($brandCampaigns as $brandCampaign)
                                                        <option value="{{ $brandCampaign->brand_id }}" {{ in_array($brandCampaign->brand_id, old('brand_ids') ?? []) ? 'selected' : '' }}>{{ $brandCampaign->title ?? '' }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('brand_ids')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="available_until" class="@error('available_until') text-danger @enderror">Influencer Campaign Availability</label>
                                        <input id="available_until" name="available_until" value="{{ old('available_until') }}" type="text" class="form-control datepicker @error('available_until') is-invalid @enderror" placeholder="Enter available until" onchange="setDate(this.id)" autofocus>
                                        @error('available_until')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <p>Available Until: <span id="available_until_value">0000-00-00</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="content_types" class="d-block @error('content_types') text-danger @enderror">
                                            Content Type
                                        </label>
                                        @foreach(config('core.content_types') as $content_key => $content_type)
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $content_key }}" name="content_types[]" value="{{ $content_key }}" {{ in_array($content_key, old('content_types') ?? []) ? 'checked' : '' }}>
                                                <label for="customCheckbox{{ $content_key }}" class="custom-control-label ml-3 font-weight-normal">{{ $content_type }}</label>
                                            </div>
                                        @endforeach
                                        @error('content_types')
                                        <span class="invalid-feedback d-block"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fee" class="@error('fee') text-danger @enderror">Fee</label>
                                        <input id="fee" name="fee" value="{{ old('fee') }}" type="number" step="any" min="0" class="form-control @error('fee') is-invalid @enderror" placeholder="Enter fee" autofocus>
                                        @error('fee')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cycle_count" class="@error('cycle_count') text-danger @enderror">Cycle Count (Cooperation Duration)</label>
                                        <input id="cycle_count" name="cycle_count" value="{{ old('cycle_count') }}" type="number" min="0" class="form-control @error('cycle_count') is-invalid @enderror" placeholder="Enter cycle count" autofocus>
                                        @error('cycle_count')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="@error('start_date') text-danger @enderror">Start Date</label>
                                        <input id="start_date" name="start_date" value="{{ old('start_date') }}" type="text" class="form-control datepicker @error('start_date') is-invalid @enderror" placeholder="Enter start date" autofocus>
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="personal_notes" class="@error('personal_notes') text-danger @enderror">Personal Notes</label>
                                        <textarea id="personal_notes" name="personal_notes" class="form-control" rows="3" placeholder="Enter personal notes">{{ old('personal_notes') }}</textarea>
                                        @error('personal_notes')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Add to campaign</button>
                            <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}

                        {{--{!! Form::open(['url' => route('backend.cms.campaign.influencer.store', [request()->id]), 'method' => 'post']) !!}
                            <div class="card-body">
                                @if(count($influencers))
                                    <div class="table-responsive w-100">
                                        <table class="table table-striped projects">
                                            <tbody>
                                            <tr>
                                                <td>Avatar</td>
                                                <td>Name</td>
                                                <td>Social Media Username</td>
                                                <td>Social Media Follower</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox" style="margin-top: 22px">
                                                        <input class="custom-control-input" type="checkbox"
                                                               id="customCheckbox" name="check_all"
                                                               value="1" onclick="toggleCheckAll(this)">
                                                        <label for="customCheckbox" class="custom-control-label">Select All</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach($influencers as $index => $influencer)
                                                <tr>
                                                    <td>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <img alt="Avatar" class="table-avatar" src="{{ config('core.image.default.avatar_male') }}">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <a class="font-weight-bold">
                                                            {{ $influencer->additionalInfo->first_name ?? '' }}
                                                            {{ $influencer->additionalInfo->last_name ?? '' }}
                                                        </a>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            Instagram Story, TikTok Video
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <a class="font-weight-bold">
                                                            Username
                                                        </a>
                                                        <br>
                                                        <div class="mt-1">
                                                            <i class="fas fa-check">
                                                            </i>
                                                            <a class="" href="javascript:void(0)">
                                                                {{ $influencer->socialAccountInfo->instagram_username ?? '' }}
                                                            </a>
                                                        </div>
                                                        <div class="mt-1">
                                                            <i class="fas fa-check">
                                                            </i>
                                                            <a class="" href="javascript:void(0)">
                                                                {{ $influencer->socialAccountInfo->tiktok_username ?? '' }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="font-weight-bold">
                                                            Follower
                                                        </a>
                                                        <br>
                                                        <div class="mt-1">
                                                            <a>
                                                                {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->instagram_followers ?? 0) }}
                                                            </a>
                                                        </div>
                                                        <div class="mt-1">
                                                            <a>
                                                                {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->tiktok_followers ?? 0) }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox d-inline-">
                                                            <input class="custom-control-input" type="checkbox"
                                                                   id="customCheckbox{{ $influencer->id }}" name="influencer_ids[]"
                                                                   value="{{ $influencer->id }}"
                                                                {{ in_array($influencer->id, $campaign->influencer_ids ?? []) ? 'checked' : '' }}>
                                                            <label for="customCheckbox{{ $influencer->id }}" class="custom-control-label">Select</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else

                                @endif
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .select2-selection__rendered {
            /line-height: 28px !important;
        }
        .select2-selection {
            /height: auto !important;
        }
    </style>
@stop
@section('script')
    <script>
        /*function toggleCheckAll(source) {
            var checkboxes = document.getElementsByName('influencer_ids[]');
            for(var i=0, n=checkboxes.length; i<n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }*/

        function setDate(id) {
            var value = document.getElementById(id).value;
            document.getElementById('available_until_value').innerText = value;
        }
    </script>
@stop
