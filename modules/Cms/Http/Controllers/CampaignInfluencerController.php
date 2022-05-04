<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Illuminate\Http\Request;

// services...
use Modules\Cms\Entities\CampaignInfluencer;
use Modules\Cms\Http\Requests\CampaignInfluencerStoreRequest;
use Modules\Cms\Http\Requests\CampaignInfluencerUpdateRequest;
use Modules\Cms\Http\Requests\CampaignStoreRequest;
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Ums\Services\UserService;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Throw_;

class CampaignInfluencerController extends Controller
{
    /**
     * @var $campaignService
     */
    protected $campaignService;

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
        UserService $userService,
        CampaignService $campaignService
    )
    {
        $this->campaignInfluencerService = $campaignInfluencerService;
        $this->userService = $userService;
        $this->campaignService = $campaignService;
        $this->middleware(['permission:Campaigns']);
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

        if (isset($data['campaign_accept_status_by_influencer'])) {
            if ($data['campaign_accept_status_by_influencer'] == -1) {
                $request->validate([
                    'denied_reason' => 'required|max:10000'
                ]);
            }
        }

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

            if (isset($data['campaign_accept_status_by_influencer'])) {
                if ($campaign_influencer->campaign_accept_status_by_influencer == 1) {
                    notifier()->success('Campaign accepted.');
                }
                if ($campaign_influencer->campaign_accept_status_by_influencer == -1) {
                    notifier()->success('Campaign declined.');
                }
            }

        } else {
            notifier()->error('Cannot be updated.');
        }
        // redirect back
        return redirect()->back();
    }

    public function feedback(Request $request, $id)
    {
        $campaign_influencer = $this->campaignInfluencerService->find($id);

        if (empty($campaign_influencer)) {
            notifier()->error('Influencer not found in this campaign!');
            return redirect()->back();
        }

        // get data
        $data = $request->except(['_token', '_method']);

        $data["feedback"] = array_merge($campaign_influencer->feedback ?? [], $data);

        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        if ($campaign_influencer) {
            notifier()->success('Commented successfully.');
        } else {
            notifier()->error('Commented can not be successfully.');
        }

        return redirect()->back();
    }

    public function reminder(Request $request, $id)
    {
        $campaign_influencer = $this->campaignInfluencerService->find($id);

        if (empty($campaign_influencer)) {
            notifier()->error('Influencer not found in this campaign!');
            return redirect()->back();
        }

        // get data
        $data = $request->except(['_token', '_method']);

        $current_time = Carbon::now();

        if (isset($data['briefing_reminder']))
            $data['briefing_reminder_at'] = $current_time;
        if (isset($data['content_reminder']))
            $data['content_reminder_at'] = $current_time;
        if (isset($data['missing_content_reminder']))
            $data['missing_content_reminder_at'] = $current_time;

        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        $send_success = true;

        try {
            MailManager::send($campaign_influencer->user, []);
        } catch (\Exception $exception) {
            $send_success = false;
        }

        if ($campaign_influencer) {
            if ($send_success) {
                notifier()->success('Reminder sent out successfully.');
            } else {
                notifier()->warning('Reminder sent out successfully but mail not send due to connection error.');
            }
        } else {
            notifier()->error('Reminder sent out can not be successful.');
        }

        return redirect()->back();
    }

    public function brandRemove(Request $request, $id, $brand_id)
    {
        $request->validate([
            'brand_denied_reason' => 'required|max:10000'
        ]);

        $campaign_influencer = $this->campaignInfluencerService->find($id);

        if (empty($campaign_influencer)) {
            notifier()->error('Influencer not found in this campaign!');
            return redirect()->back();
        }

        // get data
        $data = $request->except(['_token', '_method']);

        $denied_brand_ids = $campaign_influencer->denied_brand_ids ?? [];
        $brand_denied_reasons = $campaign_influencer->brand_denied_reasons ?? [];

        array_push($denied_brand_ids, intval($brand_id));
        array_push($brand_denied_reasons, $data['brand_denied_reason']);

        $data['denied_brand_ids'] = $denied_brand_ids;
        $data['brand_denied_reasons'] = $brand_denied_reasons;

        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        if ($campaign_influencer) {
            notifier()->success('Brand denied successfully.');
        } else {
            notifier()->error('Brand can not be denied.');
        }

        return redirect()->back();
    }
}
