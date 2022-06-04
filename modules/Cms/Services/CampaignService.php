<?php

namespace Modules\Cms\Services;

use App\Helpers\NumberManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Cms\Repositories\CampaignInfluencerRepository;
use Modules\Cms\Repositories\CampaignRepository;

class CampaignService
{
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
     * @param CampaignRepository $campaignRepository
     * @param CampaignInfluencerRepository $campaignInfluencerRepository
     */
    public function __construct
    (
        CampaignRepository $campaignRepository,
        CampaignInfluencerRepository $campaignInfluencerRepository
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->campaignInfluencerRepository = $campaignInfluencerRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->campaignRepository->model->withCount(['campaignInfluencers'])->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->campaignRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->campaignRepository->model
            ->with(
                [
                    'campaignInfluencers' => function (HasMany $query) {
                        $query->where('accept_status', 1)
                            ->where('campaign_accept_status_by_influencer', 1);
                    }
                ]
            )
            ->find($id);
    }

    /**
     * Update data
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->campaignRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->campaignRepository->delete($id);
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        return $this->campaignRepository->findBy($attribute, $value);
    }

    /**
     * Get all campaign
     *
     * @return mixed
     */
    public function campaigns($limit = 0)
    {
        return $this->campaignRepository->model->whereJsonContains('influencer_ids', auth()->user()->id)->get();
    }

    /**
     * Get all campaign
     *
     * @return mixed
     */
    public function brandCampaigns($filters, $limit = 0)
    {
        $campaigns = $this->campaignRepository->model
            ->where('brand_id', auth()->user()->id)
            ->with(['campaignInfluencers'])
            ->withCount(['campaignInfluencers'])
            ->paginate($limit);

        $campaigns->map(function ($value) {
            return [
                $value['follower_count'] = NumberManager::campaignFollowerCount($value),
                $value['uploaded_content_count'] = NumberManager::campaignUploadedContentCount($value)
            ];
        });

        $campaign_collection = collect();

        foreach ($filters as $filter) {
            if ($filter == 1) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->next_deadline->gt(Carbon::now()) && $value->is_active &&
                        ($value->campaign_influencers_count < $value->amount_of_influencer_per_cycle ||
                        $value->follower_count < $value->amount_of_influencer_follower_per_cycle ||
                        $value->uploaded_content_count < $value->amount_of_influencer_per_cycle);
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 2) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->next_deadline->lte(Carbon::now()) &&
                        $value->campaign_influencers_count < $value->amount_of_influencer_per_cycle &&
                        $value->follower_count < $value->amount_of_influencer_follower_per_cycle &&
                        $value->uploaded_content_count < $value->amount_of_influencer_per_cycle;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 3) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->campaign_influencers_count >= $value->amount_of_influencer_per_cycle &&
                        $value->follower_count >= $value->amount_of_influencer_follower_per_cycle &&
                        $value->uploaded_content_count >= $value->amount_of_influencer_per_cycle;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 4) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return !$value->is_active;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
        }

        return count($filters) ? $campaign_collection->unique('id') : $campaigns;
    }

    /**
     * Get all campaign
     *
     * @return mixed
     */
    public function influencerCampaigns($limit = 0)
    {
        return $this->campaignInfluencerRepository->model
            ->with(['campaign'])
            ->where('influencer_id', auth()->user()->id)
            ->orderByDesc('start_date')
            ->get();
    }

    public function campaignWithInfluencers($filters, $limit = 0)
    {
        $campaigns = $this->campaignRepository->model
            ->with(
                [
                    'campaignInfluencers' => function (HasMany $query) {
                        $query->where('accept_status', 1)
                            ->where('campaign_accept_status_by_influencer', 1);
                    }
                ]
            )
            ->withCount(
                [
                    'campaignInfluencers' => function (Builder $query) {
                        $query->where('accept_status', 1)
                            ->where('campaign_accept_status_by_influencer', 1);
                    }
                ]
            )
            ->paginate($limit);

        $campaigns->map(function ($value) {
            return [
                $value['follower_count'] = NumberManager::campaignFollowerCount($value),
                $value['uploaded_content_count'] = NumberManager::campaignUploadedContentCount($value)
            ];
        });

        $campaign_collection = collect();

        foreach ($filters as $filter) {
            if ($filter == 1) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->next_deadline->gt(Carbon::now()) && $value->is_active &&
                        ($value->campaign_influencers_count < $value->amount_of_influencer_per_cycle ||
                        $value->follower_count < $value->amount_of_influencer_follower_per_cycle ||
                        $value->uploaded_content_count < $value->amount_of_influencer_per_cycle);
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 2) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->next_deadline->lte(Carbon::now()) &&
                        $value->campaign_influencers_count < $value->amount_of_influencer_per_cycle &&
                        $value->follower_count < $value->amount_of_influencer_follower_per_cycle &&
                        $value->uploaded_content_count < $value->amount_of_influencer_per_cycle;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 3) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return $value->campaign_influencers_count >= $value->amount_of_influencer_per_cycle &&
                        $value->follower_count >= $value->amount_of_influencer_follower_per_cycle &&
                        $value->uploaded_content_count >= $value->amount_of_influencer_per_cycle;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
            if ($filter == 4) {
                $filter_campaigns = $campaigns->filter(function ($value) {
                    return !$value->is_active;
                });
                $campaign_collection = $campaign_collection->merge($filter_campaigns);
            }
        }

        return count($filters) ? $campaign_collection->unique('id') : $campaigns;
    }
}
