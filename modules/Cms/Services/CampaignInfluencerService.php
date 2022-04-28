<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\CampaignInfluencerRepository;
use Modules\Ums\Repositories\UserRepository;

class CampaignInfluencerService
{
    /**
     * @var $campaignInfluencerRepository
     */
    protected $campaignInfluencerRepository;

    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * Constructor
     *
     * @param CampaignInfluencerRepository $campaignInfluencerRepository
     */
    public function __construct(CampaignInfluencerRepository $campaignInfluencerRepository, UserRepository $userRepository)
    {
        $this->campaignInfluencerRepository = $campaignInfluencerRepository;
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
        return $this->campaignInfluencerRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->campaignInfluencerRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->campaignInfluencerRepository->find($id);
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
        return $this->campaignInfluencerRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->campaignInfluencerRepository->delete($id);
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
        return $this->campaignInfluencerRepository->findBy($attribute, $value);
    }

    /**
     * Find data
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function updateOrCreate($key, $value)
    {
        return $this->campaignInfluencerRepository->model->updateOrCreate($key, $value);
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function brandInfluencers($limit = 0)
    {
        return $this->campaignInfluencerRepository->model
            ->whereJsonContains('brand_ids', auth()->user()->id)
            ->paginate($limit);
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function campaignInfluencerBrands($campaign_id, $limit = 0)
    {
        $campaign_influencer = $this->campaignInfluencerRepository->model
            ->where('campaign_id', $campaign_id)
            ->where('influencer_id', auth()->user()->id)
            ->first();

        return $this->userRepository->model->with(['additionalInfo', 'businessInfo'])
            ->whereIn('id', $campaign_influencer->brand_ids ?? [])
            ->paginate($limit);
    }

    /**
     * Find data
     *
     * @return mixed
     */
    public function brandFavouriteInfluencers($limit = 0)
    {
        return $this->campaignInfluencerRepository->model
            ->whereJsonContains('brand_ids', auth()->user()->id)
            ->where('is_add_to_favourite', 1)
            ->paginate($limit);
    }
}
