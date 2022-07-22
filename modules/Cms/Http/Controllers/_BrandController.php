<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;

// requests...
use App\Mail\RegisterMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

// services...
use Modules\Cms\DataTables\BrandDataTable;
use Modules\Cms\Http\Requests\BrandStoreRequest;
use Modules\Cms\Http\Requests\BrandUpdateRequest;
use Modules\Cms\Http\Requests\FaqStoreRequest;
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Ums\Entities\User;
use Modules\Ums\Services\UserService;

class _BrandController extends Controller
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
        $this->middleware(['permission:Brands']);
    }

    /**
     * Campaign list
     *
     * @return \Illuminate\View\View
     */
    public function index(BrandDataTable $dataTable)
    {
        $campaign_influencers = $this->campaignService->influencerCampaigns();

        $campaign_influencers = $campaign_influencers->filter(function ($value) {
            $available_until = \Carbon\Carbon::parse($value->available_until);
            return $value->campaign->is_active == 1 &&
                $value->campaign_accept_status_by_influencer == 1 &&
                Carbon::now()->lt($available_until);
        });

        if (AuthManager::isSuperAdmin() || AuthManager::isAdmin()) {
            return $dataTable->render('cms::brand.index');
        }

        return view('cms::brand.index', compact('campaign_influencers'));
    }

    /**
     * Create brand
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::brand.create');
    }

    /**
     * Store faq
     *
     * @param FaqStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandStoreRequest $request)
    {
        $data = $request->all();
        // create brand
        $data['is_process_completed'] = true;
        $data['is_brand'] = true;
        $data['terms_conditions'] = true;
        $data['subscribe'] = true;
        $data['password'] = bcrypt($data['password']);

        $brand = $this->userService->create($data);

        $brand->assignRole(['Brand']);
        $brand->uploadFiles();

        $data['first_name'] = $data['brand_name'];
        $data['name'] = $data['brand_name'];
        $data['email'] = $data['business_email'];
        $data['phone'] = $data['mobile'];

        // check if faq created
        if ($brand) {

            $brand->businessInfo()->create($data);
            $brandAdditionalInfo = $brand->additionalInfo()->create($data);

            $send_success = true;

            try {
                $mailData = [
                    'title' => 'Registration',
                    'first_name' => $brandAdditionalInfo->first_name ?? '',
                    'last_name' => $brandAdditionalInfo->last_name ?? '',
                    'register_as' => 'Brand',
                    'login_url' => env('APP_URL') . '/login'
                ];
                \Mail::to($brand->email ?? '')->send(new RegisterMail($mailData));
            } catch (\Exception $exception) {
                $send_success = false;
            }

            if ($send_success) {
                notifier()->success('Brand created successfully.');
            } else {
                notifier()->warning('Brand created successfully but mail not send due to connection error.');
            }
        } else {
            // flash notification
            notifier()->error('Brand cannot be created.');
        }
        // redirect back
        return redirect()->back();
    }

    public function show($id)
    {
        $brand = $this->userService->find($id);

        if (empty($brand) || !$brand->is_brand) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }

        return view('cms::brand.show', compact('brand'));
    }

    public function edit($id)
    {
        $brand = $this->userService->find($id);

        if (empty($brand) || !$brand->is_brand) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }

        return view('cms::brand.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        $data = $request->all();
        // create brand
        $brand = $this->userService->update($data, $id);

        $brand->uploadFiles();

        $additional_data = [
            'first_name' => $data['brand_name'],
        ];

        $business_data = [
            'name' => $data['brand_name'],
            'address' => $data['address'],
            'zip_code' => $data['zip_code'],
            'city' => $data['city'],
            'country_code' => $data['country_code'],
            'email' => $data['business_email'],
            'phone' => $data['mobile'],
            'vat_number' => $data['vat_number'],
            'registration_number' => $data['registration_number'],
        ];

        // check if faq created
        if ($brand) {

            $brand->additionalInfo()->update($additional_data);
            $brand->businessInfo()->update($business_data);

            // flash notification
            notifier()->success('Brand updated successfully.');
        } else {
            // flash notification
            notifier()->error('Brand updated be created.');
        }
        // redirect back
        return redirect()->back();
    }

    public function content($id, $campaign_influencer_id)
    {
        $campaign_influencer = $this->campaignInfluencerService->find($campaign_influencer_id);

        if (empty($campaign_influencer)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        $contents = $this::getContents($campaign_influencer);
        $brand_id = $id;

        return view('cms::brand.content', compact('campaign_influencer', 'contents', 'brand_id'));
    }

    public function contentUpload(Request $request, $id, $campaign_influencer_id)
    {
        $data = $request->all();
        // get campaign
        $campaign = $this->campaignInfluencerService->find($campaign_influencer_id);
        // check if campaign doesn't exists
        if (empty($campaign)) {
            // flash notification
            notifier()->error('Campaign not found!');
            // redirect back
            return redirect()->back();
        }

        $contents = $this::getContents($campaign);

        // upload content files
        if(count($campaign->content_types)) {
            $contentIndex = 0;
            foreach($campaign->brand_ids as $brand_id) {
                foreach($campaign->content_types as $content_type) {
                    $contents[$contentIndex] = $contents[$contentIndex] < $campaign->current_cycle ? ($contents[$contentIndex] + 1) : $contents[$contentIndex];
                    $media_collection = 'campaign_influencer_content_' . $$campaign_influencer_id. '_' . $brand_id . '_' . \Str::snake($content_type) . '_' . ($contents[$contentIndex]);
                    if ($request->hasFile($media_collection)) {
                        if ($campaign->hasMedia($media_collection)) {
                            $campaign->clearMediaCollection($media_collection);
                        }
                        $campaign->addMedia($request->file($media_collection))->toMediaCollection($media_collection);
                        $campaign = tap($campaign)->update(['is_content_uploaded' => true]);
                    }
                    $contentIndex++;
                }
            }
        }

        // check if campaign updated
        if ($campaign) {
            // flash notification
            notifier()->success('Content uploaded successfully.');
        } else {
            // flash notification
            notifier()->error('Content cannot be uploaded successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    public static function getContents($campaign_influencer): array
    {
        $contents = [];
        foreach($campaign_influencer->brands as $brand) {
            foreach($campaign_influencer->content_types as $content_type) {
                $uploadedContents = 0;
                foreach (range(1, $campaign_influencer->current_cycle) as $cycle) {
                    $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . $cycle;
                    $uploadedContents += (isset($campaign_influencer->getMedia($media_collection)[0]));
                }
                $contents[] = $uploadedContents;
            }
        }

        return $contents;
    }
}
