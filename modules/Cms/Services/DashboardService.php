<?php

namespace Modules\Cms\Services;

use App\Helpers\AuthManager;
use App\Helpers\NumberManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\Entities\Campaign;
use Modules\Cms\Repositories\CampaignInfluencerRepository;
use Modules\Cms\Repositories\CampaignRepository;
use Modules\Ums\Repositories\UserRepository;

class DashboardService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * @var $campaignRepository
     */
    protected $campaignRepository;

    /**
     * @var $campaignInfluencerRepository
     */
    protected $campaignInfluencerRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct
    (
        UserRepository $userRepository,
        CampaignRepository $campaignRepository,
        CampaignInfluencerRepository $campaignInfluencerRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->campaignRepository = $campaignRepository;
        $this->campaignInfluencerRepository = $campaignInfluencerRepository;
    }

    /**
     * Get all influencer
     *
     * @return mixed
     */
    public function influencers($limit = 0)
    {
        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->where('is_process_completed', 1)
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->paginate($limit);
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function statistics()
    {
        $statistics = new \stdClass();
        $influencers = $this->campaignInfluencerRepository->model
            ->get();

        $statistics->overall_influencers = $influencers
            ->count();
        $statistics->pending_influencers = $influencers
            ->where('accept_status', 0)
            ->count();
        $statistics->accepted_influencers = $influencers
            ->where('accept_status', 1)
            ->count();
        $statistics->denied_influencers = $influencers
            ->where('accept_status', -1)
            ->count();
        $statistics->favourite_influencers = $influencers
            ->where('is_add_to_favourite', 1)
            ->count();

        return $statistics;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function statisticsInfluencer()
    {
        $statistics = new \stdClass();
        $campaign_influencers = $this->campaignInfluencerRepository->model
            ->with(['campaign'])
            ->where('influencer_id', auth()->user()->id)->get();

        $statistics->overall_campaigns = $campaign_influencers
            ->count();
        $statistics->pending_campaigns = $campaign_influencers
            ->where('campaign_accept_status_by_influencer', 0)
            ->count();
        $statistics->accepted_campaigns = $campaign_influencers
            ->where('campaign_accept_status_by_influencer', 1)
            ->count();
        $statistics->denied_campaigns = $campaign_influencers
            ->where('campaign_accept_status_by_influencer', -1)
            ->count();
        $statistics->active_campaigns = $campaign_influencers
            ->where('available_until', '>', Carbon::now())
            ->count();
        $statistics->expired_campaigns = $campaign_influencers
            ->where('available_until', '<=', Carbon::now())
            ->count();

        return $statistics;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function campaignStatistics()
    {
        $statistics = new \stdClass();

        if (AuthManager::isBrand()) {
            $campaigns = $this->campaignRepository->model
                ->where('brand_id', auth()->user()->id)
                ->with(['campaignInfluencers'])
                ->withCount(['campaignInfluencers'])
                ->get();
        } else {
            $campaigns = $this->campaignRepository->model
                ->with(['campaignInfluencers'])
                ->withCount(['campaignInfluencers'])
                ->get();
        }

        $campaigns->map(function ($value) {
            return [
                $value['follower_count'] = NumberManager::campaignFollowerCount($value),
                $value['uploaded_content_count'] = NumberManager::campaignUploadedContentCount($value)
            ];
        });

        $campaign_array = [];

        foreach ($campaigns as $campaign) {
            $start_date = \Carbon\Carbon::parse($campaign->start_date);
            if ($campaign->cycle_time_unit == 1)
                $campaign['next_deadline'] = $start_date->addMonths($campaign->cycle_count);
            else if ($campaign->cycle_time_unit == 2)
                $campaign['next_deadline'] = $start_date->addWeeks($campaign->cycle_count);

            $campaign_array[] = $campaign;
        }

        $campaign_collection = collect($campaign_array);

        $statistics->overall_campaigns = $campaign_collection
            ->count();

        $statistics->running_campaigns = $campaign_collection->filter(function ($value) {
            return $value->next_deadline->gt(Carbon::now()) && $value->is_active &&
                ($value->campaign_influencers_count < $value->amount_of_influencer_per_cycle ||
                $value->follower_count < $value->amount_of_influencer_follower_per_cycle ||
                $value->uploaded_content_count < $value->amount_of_influencer_per_cycle);
        })->count();

        $statistics->overdue_campaigns = $campaign_collection->filter(function ($value) {
            return $value->next_deadline->lte(Carbon::now()) &&
                $value->campaign_influencers_count < $value->amount_of_influencer_per_cycle &&
                $value->follower_count < $value->amount_of_influencer_follower_per_cycle &&
                $value->uploaded_content_count < $value->amount_of_influencer_per_cycle;
        })->count();

        $statistics->completed_campaigns = $campaign_collection->filter(function ($value) {
            return $value->campaign_influencers_count >= $value->amount_of_influencer_per_cycle &&
                $value->follower_count >= $value->amount_of_influencer_follower_per_cycle &&
                $value->uploaded_content_count >= $value->amount_of_influencer_per_cycle;
        })->count();

        $statistics->not_active_campaigns = $campaign_collection->filter(function ($value) {
            return !$value->is_active;
        })->count();

        return $statistics;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function statisticsBrand()
    {
        $statistics = new \stdClass();
        $influencers = $this->campaignInfluencerRepository->model
            ->whereJsonContains('brand_ids', auth()->user()->id)
            ->orWhereJsonContains('denied_brand_ids', auth()->user()->id)
            ->get();

        $statistics->overall_influencers = $influencers
            ->count();
        $statistics->pending_influencers = $influencers
            ->where('accept_status', 0)
            ->count();
        $statistics->accepted_influencers = $influencers
            ->where('accept_status', 1)
            ->count();
        $statistics->denied_influencers = $influencers
            ->where('accept_status', -1)
            ->count();
        $statistics->favourite_influencers = $influencers
            ->where('is_add_to_favourite', 1)
            ->count();

        return $statistics;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function statisticsBrandCampaign()
    {
        $statistics = new \stdClass();

        $campaigns = $this->campaignRepository->model
            ->where('brand_id', auth()->user()->id)
            ->orderByDesc('start_date')
            ->get();

        $campaign_ids = $campaigns->pluck('id')->toArray();

        $campaign_influencers = $this->campaignInfluencerRepository->model
            ->whereIn('campaign_id', $campaign_ids);

        $statistics->campaign = $campaigns->first();
        $statistics->overall_campaigns = count($campaigns);

        $statistics->overall_influencers = $campaign_influencers
            ->get()
            ->unique('influencer_id')
            ->count();

        $statistics->favourite_influencers = $campaign_influencers
            ->where('is_add_to_favourite', 1)
            ->get()
            ->unique('influencer_id')
            ->count();

        return $statistics;
    }

    public function campaignChartData()
    {
        $campaigns = Campaign::query()->latest()->take(10)->get();
        $campaigns = $this->campaignRepository->model
            ->withCount(['campaignInfluencers'])
            ->latest()
            ->take(10)
            ->get();

        $labels = $campaigns->pluck('title')->toArray();
        $values = $campaigns->pluck('campaign_influencers_count')->toArray();

        $response = new \stdClass();
        $response->labels = $labels ?? [];
        $response->values = $values ?? [];

        return $response;
    }
}
