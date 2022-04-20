<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\CampaignRepository;

class CampaignService
{
    /**
     * @var $campaignRepository
     */
    protected $campaignRepository;

    /**
     * Constructor
     *
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->campaignRepository->paginate($limit);
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
        return $this->campaignRepository->find($id);
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
    public function brandCampaigns($limit = 0)
    {
        return $this->campaignRepository->model->where('brand_id', auth()->user()->id)->get();
    }
}
