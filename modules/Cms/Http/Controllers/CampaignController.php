<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\CampaignStoreRequest;
use Modules\Cms\Http\Requests\CampaignUpdateRequest;

// datatable...
use Modules\Cms\DataTables\CampaignDataTable;

// services...
use Modules\Cms\Services\BrandService;
use Modules\Cms\Services\CampaignService;

class CampaignController extends Controller
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
     * Constructor
     *
     * @param CampaignService $campaignService
     */
    public function __construct(CampaignService $campaignService, BrandService $brandService)
    {
        $this->campaignService = $campaignService;
        $this->brandService = $brandService;
        //$this->middleware(['permission:Cms']);
    }

    /**
     * Campaign list
     *
     * @param CampaignDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(CampaignDataTable $datatable)
    {
        return $datatable->render('cms::campaign.index');
    }

    /**
     * Create campaign
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // brand lists
        $brands = $this->brandService->all();

        // return view
        return view('cms::campaign.create', compact('brands'));
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

        $data['brand_ids'] = array_map('intval', $data['brand_ids']);

        // create campaign
        $campaign = $this->campaignService->create($data);
        // upload file
        $campaign->uploadFiles();
        // check if campaign created
        if ($campaign) {
            // flash notification
            notifier()->success('Campaign created successfully.');
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
        // return view
        return view('cms::campaign.show', compact('campaign'));
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
        $brands = $this->brandService->all();

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
        return view('cms::campaign.edit', compact('campaign', 'brands'));
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

        $data['brand_ids'] = array_map('intval', $data['brand_ids']);

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
}
