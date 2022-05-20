<?php

namespace Modules\Ums\Services;

use Carbon\Carbon;
use Modules\Cms\Entities\CampaignInfluencer;
use Modules\Ums\Repositories\UserRepository;

class UserService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
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
        return $this->userRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Author data
     *
     * @param $id
     * @return mixed
     */
    public function authorInfo($id)
    {
        return $this->userRepository->model->with([
            'additionalInfo'
        ])->where('id', $id)->first();
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userRepository->model->firstOrCreate($data);
    }

    public function influencers($limit = 0)
    {
        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->where('is_process_completed', 1)
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->paginate($limit);
    }

    public function influencerByCampaignMatch($campaign, $limit = 0)
    {
        $influencer_ids = $campaign->target_influencer_category_ids ?? [];
        $genders = $campaign->target_influencer_genders ?? [];
        //$lower_date = Carbon::now()->addYears(-1 * ($campaign->target_influencer_lower_age));
        //$upper_date = Carbon::now()->addYears(-1 * ($campaign->target_influencer_upper_age));
        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->join('user_additional_infos', 'user_additional_infos.id', 'users.id')
            ->select([
                'users.*',
                'user_additional_infos.gender',
                'user_additional_infos.dob',
            ])
            ->where('is_process_completed', 1)
            ->where('is_pre_selected', 0)
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->where(function ($query) use ($influencer_ids){
                $query->whereJsonContains('categories', $influencer_ids[0] ?? null);
                for ($i = 1; $i < count($influencer_ids); $i++) {
                    $query->orWhereJsonContains('categories', $influencer_ids[$i]);
                }
                return $query;
            })
            ->whereIn('gender', $genders)
            ->paginate($limit);
    }

    public function campaignInfluencers($limit = 0)
    {
        $campaign_influencer_ids = CampaignInfluencer::query()
            ->where('campaign_id', \request()->id)->get()->pluck('influencer_id')->toArray();

        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->where('is_process_completed', 1)
            ->whereNotIn('id', $campaign_influencer_ids)
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->paginate($limit);
    }

    /**
     * First or create data
     *
     * @param int $limit
     * @return mixed
     */
    public function brands($limit = 0)
    {
        return $this->userRepository->model->with(['additionalInfo', 'businessInfo'])
            ->where('is_process_completed', 1)
            ->whereHas("roles", function ($query) {
                $query->where("name", "Brand");
            })->paginate($limit);
    }

    /**
     * Find data
     *
     * @param $value
     * @return mixed
     */
    public function usersIn($value)
    {
        return $this->userRepository->model->whereIn('id', $value)->get();
    }
}
