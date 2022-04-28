<?php

namespace Modules\Cms\Services;

use Carbon\Carbon;
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
        $influencers = $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->get();

        $statistics->overall_influencers = $influencers
                                            ->where('is_process_completed', 1)->count();
        $statistics->pending_influencers = $influencers
                                            ->where('is_influencer_accepted', 0)
                                            ->where('is_process_completed', 1)->count();
        $statistics->accepted_influencers = $influencers
                                            ->where('is_influencer_accepted', 1)
                                            ->where('is_process_completed', 1)->count();
        $statistics->denied_influencers = $influencers
                                            ->where('is_influencer_accepted', -1)
                                            ->where('is_process_completed', 1)->count();
        $statistics->favourite_influencers = $influencers
                                            ->where('is_influencer_add_to_favourite', 1)
                                            ->where('is_process_completed', 1)->count();

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
            ->where('accept_status', 0)
            ->count();
        $statistics->accepted_campaigns = $campaign_influencers
            ->where('accept_status', 1)
            ->count();
        $statistics->denied_campaigns = $campaign_influencers
            ->where('accept_status', -1)
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
    public function statisticsBrand()
    {
        $statistics = new \stdClass();
        $influencers = $this->campaignInfluencerRepository->model
            ->whereJsonContains('brand_ids', auth()->user()->id)
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
}
