<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Illuminate\Http\Request;

// services...
use Modules\Cms\Entities\CampaignInfluencer;
use Modules\Cms\Http\Requests\CampaignInfluencerStoreRequest;
use Modules\Cms\Http\Requests\CampaignInfluencerUpdateRequest;
use Modules\Cms\Http\Requests\CampaignStoreRequest;
use Modules\Cms\Services\BrandService;
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Ums\Services\UserService;

class CampaignInfluencerController extends Controller
{
    /**
     * @var $campaignService
     */
    protected $campaignService;

    /**
     * @var $brandService
     */
    protected $brandService;

    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $campaignInfluencerService
     */
    protected $campaignInfluencerService;

    public function __construct
    (
        CampaignInfluencerService $campaignInfluencerService,
        BrandService $brandService,
        UserService $userService,
        CampaignService $campaignService
    )
    {
        $this->campaignInfluencerService = $campaignInfluencerService;
        $this->brandService = $brandService;
        $this->userService = $userService;
        $this->campaignService = $campaignService;

        //$this->middleware(['permission:Cms']);
    }

    public function create()
    {
        $influencers = $this->userService->campaignInfluencers();

        $brands = $this->userService->brands();
        $campaign = $this->campaignService->find(\request()->id);

        // return view
        return view('cms::campaign.influencer.create', compact('influencers','brands', 'campaign'));
    }

    /**
     * Store campaign influencer
     *
     * @param CampaignStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampaignInfluencerStoreRequest $request, $id)
    {
        $data = $request->all();

        $campaign_influencer = CampaignInfluencer::query()
            ->where('campaign_id', $id)
            ->where('influencer_id', $data['influencer_id'])
            ->first();

        if ($campaign_influencer) {
            // flash notification
            notifier()->error('Influencer already added to this campaign.');
            // redirect to
            return redirect()->route('backend.cms.campaign.influencer.create', [$id]);
        }

        if (isset($data['brand_ids']))
            $data['brand_ids'] = array_map('intval', $data['brand_ids'] ?? []);

        $data['campaign_id'] = $id;

        // create campaign
        $campaign = $this->campaignInfluencerService->create($data);
        // check if campaign created
        if ($campaign) {
            // flash notification
            notifier()->success('Influencer added successfully to campaign.');
        } else {
            // flash notification
            notifier()->error('Influencer cannot be added successfully to campaign.');
        }

        // redirect to
        return redirect()->route('backend.cms.campaign.influencer.create', [$id]);
    }

    /**
     * Store campaignAccept
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function store(Request $request)
    {
        $data = $request->all();
        // create campaign accept
        $campaignAccept = $this->campaignAcceptService->updateOrCreate(
                ['influencer_id' => auth()->user()->id, 'campaign_id' => $data['campaign_id']],
                ['status' => $data['status']
            ]
        );
        // check if campaignAccept created
        if ($campaignAccept) {
            // flash notification
            notifier()->success('Campaign accepted successfully.');
        } else {
            // flash notification
            notifier()->error('Campaign cannot be accepted successfully.');
        }
        // redirect back
        return redirect()->back();
    }*/

    /**
     * Update user
     *
     * @param CampaignInfluencerUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CampaignInfluencerUpdateRequest $request, $id)
    {
        // get campaign influencer
        $campaign_influencer = $this->campaignInfluencerService->find($id);
        // check if user doesn't exists
        if (empty($campaign_influencer)) {
            // flash notification
            notifier()->error('Influencer not found in this campaign!');
            // redirect back
            return redirect()->back();
        }
        // get data
        $data = $request->except(['_token', '_method']);

        // update campaign influencer
        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        // check if user updated
        if ($campaign_influencer) {
            if (isset($data['accept_status'])) {
                if ($campaign_influencer->is_influencer_accepted == 1) {
                    notifier()->success('Influencer accepted.');
                }
                if ($campaign_influencer->is_influencer_accepted == -1) {
                    notifier()->success('Influencer denied.');
                }
            }

            if (isset($data['is_add_to_favourite'])) {
                if ($campaign_influencer->is_influencer_add_to_favourite == 1) {
                    notifier()->success('Influencer added to favourite.');
                }
                if ($campaign_influencer->is_influencer_add_to_favourite == 0) {
                    notifier()->success('Influencer removed from favourite.');
                }
            }

        } else {
            notifier()->error('Influencer cannot be updated.');
        }
        // redirect back
        return redirect()->back();
    }
}
