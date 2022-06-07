<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use App\Mail\BrandDenyMail;
use App\Mail\CampaignDenyMail;
use App\Mail\NotificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

// services...
use Modules\Cms\Entities\Campaign;
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
     * @param CampaignInfluencerStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampaignInfluencerStoreRequest $request, $id)
    {
        $data = $request->all();

        if (isset($data['brand_ids']))
            $data['brand_ids'] = array_map('intval', $data['brand_ids'] ?? []);

        $data['campaign_manager_id'] = Campaign::query()->find($id)->created_by ?? null;

        $brandsCampaignIds = Campaign::query()
            ->whereIn('brand_id', $data['brand_ids'])
            ->where('is_active', 1)
            ->get()->pluck('id')->toArray();

        $brandsCampaignIds[] = intval($id);

        $brandsCampaignIds = array_unique($brandsCampaignIds);

        $alreadyAddedCount = 0;
        $addedCount = 0;

        foreach ($brandsCampaignIds as $campaignId) {
            $campaign_influencer = CampaignInfluencer::query()
                ->where('campaign_id', $campaignId)
                ->where('influencer_id', $data['influencer_id'])
                ->first();

            if ($campaign_influencer) {
                $alreadyAddedCount++;
            } else {
                $data['campaign_id'] = $campaignId;
                $this->campaignInfluencerService->create($data);
                $addedCount++;
            }
        }

        if ($addedCount > 0) {
            notifier()->success('This influencer added to ' . $addedCount . ' campaign');
        } else {
            notifier()->success('This influencer can not be added any campaign');
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
            if (isset($data['internal_accept_status'])) {
                if ($campaign_influencer->accept_status == 1) {
                    notifier()->success('Modified successfully..');
                }
            }

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

                $brand = $this->userService->find($campaign_influencer->campaign->brand_id ?? '');

                try {
                    $mailData = [
                        'title' => 'Campaign Accept/Deny Notification',
                        'campaign_name' => $campaign_influencer->campaign->title ?? '',
                        'brand_name' => $brand->additionalInfo->first_name ?? '',
                    ];
                    \Mail::to($brand->email ?? '')->send(new CampaignDenyMail($mailData));
                } catch (\Exception $exception) {
                    $send_success = false;
                }

                if ($campaign_influencer) {
                    if ($send_success) {
                        notifier()->success('Brand denied successfully.');
                    } else {
                        notifier()->warning('Brand denied successfully but mail not send due to connection error.');
                    }
                } else {
                    notifier()->error('Brand can not be denied.');
                }

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
            notifier()->error('Commented can not be successful.');
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

        if (isset($data['briefing_reminder'])) {
            $data['briefing_reminders_at'] = $campaign_influencer->briefing_reminders_at ?? [];
            $data['briefing_reminders_at'][] = $current_time;
        }

        if (isset($data['content_reminder'])) {
            $data['content_reminders_at'] = $campaign_influencer->content_reminders_at ?? [];
            $data['content_reminders_at'][] = $current_time;
        }
        if (isset($data['missing_content_reminder'])) {
            $data['missing_content_reminders_at'] = $campaign_influencer->missing_content_reminders_at ?? [];
            $data['missing_content_reminders_at'][] = $current_time;
        }

        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        $send_success = true;

        try {
            $title = isset($data['briefing_reminder']) ? 'Briefing Reminder' : (isset($data['content_reminder']) ? 'Content Reminder' : (isset($data['missing_content_reminder']) ? 'Missing Content Reminder' : ''));
            $mailData = [
                'title' => $title,
            ];
            \Mail::to($campaign_influencer->user->email ?? '')->send(new NotificationMail($mailData));
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

        $brand = $this->userService->find($brand_id);

        try {
            $mailData = [
                'title' => 'Brand Denied Notification',
                'influencer_name' => ($campaign_influencer->first_name ?? '') . ' ' . ($campaign_influencer->last_name ?? ''),
                'brand_name' => $brand->additionalInfo->first_name ?? '',
                'campaign_name' => $campaign_influencer->campaign->title ?? '',
            ];
            \Mail::to($brand->email ?? '')->send(new BrandDenyMail($mailData));
        } catch (\Exception $exception) {
            $send_success = false;
        }

        if ($campaign_influencer) {
            if ($send_success) {
                notifier()->success('Brand denied successfully.');
            } else {
                notifier()->warning('Brand denied successfully but mail not send due to connection error.');
            }
        } else {
            notifier()->error('Brand can not be denied.');
        }

        return redirect()->back();
    }

    public function campaignInfluencerManager()
    {
        $campaignInfluencers = [];

        if (AuthManager::isInfluencerManager()) {
            $campaignInfluencers = $this->campaignInfluencerService->campaignManagerInfluencers();
        }

        if (AuthManager::isSuperAdmin() || AuthManager::isAdmin()) {
            $campaignInfluencers = $this->campaignInfluencerService->all();
        }

        return view('cms::campaign.influencer.index', compact('campaignInfluencers'));
    }

    public function report(Request $request, $id)
    {
        $request->validate([
            'report_details' => 'required|max:10000'
        ]);

        $campaign_influencer = $this->campaignInfluencerService->find($id);

        if (empty($campaign_influencer)) {
            notifier()->error('Influencer not found in this campaign!');
            return redirect()->back();
        }

        // get data
        $data = $request->except(['_token', '_method']);

        $campaign_influencer = $this->campaignInfluencerService->update($data, $id);

        if ($campaign_influencer) {
            notifier()->success('Reported successfully.');
        } else {
            notifier()->error('Report can not be successful.');
        }

        return redirect()->back();
    }
}
