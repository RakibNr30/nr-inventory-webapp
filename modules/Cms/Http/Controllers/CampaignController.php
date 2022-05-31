<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;

// requests...
use Illuminate\Http\Request;
use Modules\Cms\Entities\Campaign;
use Modules\Cms\Http\Requests\CampaignStoreRequest;
use Modules\Cms\Http\Requests\CampaignUpdateRequest;

// datatable...
use Modules\Cms\DataTables\CampaignDataTable;

// services...
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Cms\Services\DashboardService;
use Modules\Cms\Services\InfluencerCategoryService;
use Modules\Cms\Services\ProductService;
use Modules\Ums\Services\UserService;

class CampaignController extends Controller
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
     * @var $productService
     */
    protected $productService;

    /**
     * @var $influencerCategoryService
     */
    protected $influencerCategoryService;

    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $dashboardService
     */
    protected $dashboardService;

    /**
     * Constructor
     *
     * @param CampaignService $campaignService
     * @param CampaignInfluencerService $campaignInfluencerService
     * @param ProductService $productService
     * @param InfluencerCategoryService $influencerCategoryService
     * @param UserService $userService
     * @param DashboardService $dashboardService
     */

    public function __construct
    (
        CampaignService $campaignService,
        CampaignInfluencerService $campaignInfluencerService,
        ProductService $productService,
        InfluencerCategoryService $influencerCategoryService,
        UserService $userService,
        DashboardService $dashboardService
    )
    {
        $this->campaignService = $campaignService;
        $this->campaignInfluencerService = $campaignInfluencerService;
        $this->productService = $productService;
        $this->influencerCategoryService = $influencerCategoryService;
        $this->userService = $userService;
        $this->dashboardService = $dashboardService;
        $this->middleware(['permission:Campaigns']);
    }

    /**
     * Campaign list
     *
     * @return \Illuminate\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        $dashboard = new \stdClass();
        $campaigns = [];

        $filters = [];
        $search = '';

        if (request()->has('filters')) {
            $filters = array_map('intval', request()->get('filters'));
        }
        if (request()->has('search')) {
            $search = request()->get('search');
        }

        $campaign_influencers = [];
        if (AuthManager::isInfluencer()) {
            $campaign_influencers = $this->campaignService->influencerCampaigns();
        }
        if (AuthManager::isBrand()) {
            $dashboard->statistics = $this->dashboardService->campaignStatistics();
            $campaigns = $this->campaignService->brandCampaigns($filters);

            $campaigns = $campaigns->filter(function ($item) use ($search) {
                $search = strtolower($search);
                return preg_match("/$search/", strtolower($item['title']));
            });
        }
        if (AuthManager::isSuperAdmin() || AuthManager::isAdmin() || AuthManager::isInfluencerManager()) {
            $dashboard->statistics = $this->dashboardService->campaignStatistics();
            $campaigns = $this->campaignService->campaignWithInfluencers($filters);

            $campaigns = $campaigns->filter(function ($item) use ($search) {
                $search = strtolower($search);
                return preg_match("/$search/", strtolower($item['title']));
            });
        }

        return view('cms::campaign.index', compact('campaigns', 'campaign_influencers', 'dashboard'));
    }

    /**
     * Create campaign
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // brand lists
        $brands = $this->userService->brands();
        // product lists
        $products = $this->productService->all();
        // influencer category lists
        $influencerCategories = $this->influencerCategoryService->all();

        // return view
        return view('cms::campaign.create', compact('brands', 'products', 'influencerCategories'));
    }


    /**
     * Store campaign
     *
     * @param CampaignStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampaignStoreRequest $request)
    {
        $data = $request->all();

        if (isset($data['target_influencer_category_ids']))
            $data['target_influencer_category_ids'] = array_map('intval', $data['target_influencer_category_ids']);
        if (isset($data['target_influencer_genders']))
            $data['target_influencer_genders'] = array_map('intval', $data['target_influencer_genders']);
        if (isset($data['product_ids']))
            $data['product_ids'] = array_map('intval', $data['product_ids']);

        $data['created_by'] = auth()->user()->id;

        // create campaign
        $campaign = $this->campaignService->create($data);
        // upload file
        $campaign->uploadFiles();
        // check if campaign created
        if ($campaign) {
            // flash notification
            notifier()->success('Campaign created successfully.');
            if (!AuthManager::isBrand()) {
                return redirect()->route('backend.cms.campaign.pre-selection', [$campaign->id]);
            }
        } else {
            // flash notification
            notifier()->error('Campaign cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show campaign.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get campaign
        $campaign = $this->campaignService->find($id);

        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        $brands = [];

        if (AuthManager::isInfluencer()) {
            $brands = $this->campaignInfluencerService->campaignInfluencerBrands($campaign->id);
        }

        // return view
        return view('cms::campaign.show', compact('campaign', 'brands'));
    }

    /**
     * Show campaign.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // brand lists
        $brands = $this->userService->brands();
        // influencer category lists
        $influencerCategories = $this->influencerCategoryService->all();

        // get campaign
        $campaign = $this->campaignService->find($id);
        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::campaign.edit', compact('campaign', 'brands', 'influencerCategories'));
    }

    /**
     * Update campaign
     *
     * @param CampaignUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CampaignUpdateRequest $request, $id)
    {
        $data = $request->all();

        // get campaign
        $campaign = $this->campaignService->find($id);
        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        if (isset($data['brand_ids']))
            $data['brand_ids'] = array_map('intval', $data['brand_ids']);
        if (isset($data['target_influencer_category_ids']))
            $data['target_influencer_category_ids'] = array_map('intval', $data['target_influencer_category_ids']);
        if (isset($data['target_influencer_genders']))
            $data['target_influencer_genders'] = array_map('intval', $data['target_influencer_genders']);

        // update campaign
        $campaign = $this->campaignService->update($data, $id);
        // upload files
        $campaign->uploadFiles();
        // check if campaign updated
        if ($campaign) {
            // flash notification
            notifier()->success('Campaign updated successfully.');
        } else {
            // flash notification
            notifier()->error('Campaign cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete campaign
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get campaign
        $campaign = $this->campaignService->find($id);
        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }
        // delete campaign
        if ($this->campaignService->delete($id)) {
            // flash notification
            notifier()->success('Campaign deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Campaign cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Preselection influencer
     *
     * @return \Illuminate\View\View
     */
    public function preSelection($id)
    {
        $campaign = $this->campaignService->find($id);

        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        $influencers = $this->userService->influencerByCampaignMatch($campaign);

        // return view
        return view('cms::campaign.pre_selection', compact('influencers', 'campaign'));
    }

    /**
     * Preselection influencer
     *
     * @return \Illuminate\View\View
     */
    public function preSelectionCreate($id, $influencerId)
    {
        $campaign = $this->campaignService->find($id);

        if (empty($campaign)) {
            notifier()->error('Campaign not found!');
            return redirect()->back();
        }

        $influencer = $this->userService->find($influencerId);

        if (empty($influencer)) {
            notifier()->error('Influencer not found!');
            return redirect()->back();
        }

        $this->userService->update(['is_pre_selected' => true], $influencerId);

        $brands = $this->userService->brands();

        // return view
        return view('cms::campaign.influencer.pre_selection_create', compact('campaign', 'influencer', 'brands'));
    }

    /**
     * Update user
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateActiveStatus(Request $request, $id)
    {
        $data = $request->all();

        $campaign = $this->campaignService->find($id);

        if (empty($campaign)) {
            return response()->json(['status' => 'success', 'updated' => false]);
        }

        $campaign = $this->campaignService->update($data, $id);

        if ($campaign) {
            return response()->json(['status' => 'success', 'updated' => true]);
        } else {
            return response()->json(['status' => 'success', 'updated' => false]);
        }
    }
}
