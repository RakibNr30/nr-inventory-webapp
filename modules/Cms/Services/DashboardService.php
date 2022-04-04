<?php

namespace Modules\Cms\Services;

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
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct
    (
        UserRepository $userRepository,
        CampaignRepository $campaignRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Get all data
     *
     * @param $id
     * @return mixed
     */
    public function statistics($id)
    {
        $statistics = new \stdClass();

        return $statistics;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function overallStatistics()
    {
        $statistics = new \stdClass();

        return $statistics;
    }

    /**
     * Get all influencer
     *
     * @return mixed
     */
    public function influencers($limit = 0)
    {
        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->paginate($limit);
    }

    /**
     * Get all campaign
     *
     * @return mixed
     */
    public function campaigns($limit = 0)
    {
        return $this->campaignRepository->paginate($limit);
    }
}
