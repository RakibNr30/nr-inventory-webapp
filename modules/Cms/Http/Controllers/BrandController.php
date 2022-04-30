<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;

// requests...
use Illuminate\Http\Request;

// services...
use Modules\Cms\DataTables\BrandDataTable;
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Ums\Services\UserService;

class BrandController extends Controller
{
    /**
     * @var $campaignService
     */
    protected $campaignService;

    /**
     * @var $campaignInfluencerService
     */
    protected $campaignInfluencerService;

    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param CampaignService $campaignService
     * @param UserService $userService
     * @param CampaignInfluencerService $campaignInfluencerService
     */
    public function __construct(CampaignService $campaignService, UserService $userService, CampaignInfluencerService $campaignInfluencerService)
    {
        $this->campaignService = $campaignService;
        $this->userService = $userService;
        $this->campaignInfluencerService = $campaignInfluencerService;
        //$this->middleware(['permission:Cms']);
    }

    /**
     * Campaign list
     *
     * @return \Illuminate\View\View
     */
    public function index(BrandDataTable $dataTable)
    {
        $campaign_influencers = $this->campaignService->influencerCampaigns();
        if (AuthManager::isSuperAdmin() || AuthManager::isAdmin()) {
            return $dataTable->render('cms::brand.index');
        }
        return view('cms::brand.index', compact('campaign_influencers'));
    }

    public function show($id)
    {
        $brand = $this->userService->find($id);

        if (empty($brand)) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }

        return view('cms::brand.show', compact('brand'));
    }

    public function edit($id)
    {
        $campaign_influencer = $this->campaignInfluencerService->find($id);

        if (empty($campaign_influencer)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        return view('cms::brand.edit', compact('campaign_influencer'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // get campaign
        $campaign = $this->campaignInfluencerService->find($id);
        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        // upload content files
        if(count($campaign->content_types)) {
            foreach($campaign->content_types as $index => $content_type) {
                $media_collection = 'campaign_influencer_content_' . $id . '_' . \Str::snake($content_type);
                if ($request->hasFile($media_collection)) {
                    if ($campaign->hasMedia($media_collection)) {
                        $campaign->clearMediaCollection($media_collection);
                    }
                    $campaign->addMedia($request->file($media_collection))->toMediaCollection($media_collection);
                    $campaign = tap($campaign)->update(['is_content_uploaded' => true]);
                }
            }
        }

        // check if campaign updated
        if ($campaign) {
            // flash notification
            notifier()->success('File uploaded successfully.');
        } else {
            // flash notification
            notifier()->error('File cannot be uploaded successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
