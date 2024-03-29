<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;

// requests...
use App\Mail\RegisterMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Cms\Entities\CampaignInfluencer;
use Modules\Cms\Services\CampaignInfluencerService;
use Modules\Cms\Services\CampaignService;
use Modules\Cms\Services\DashboardService;
use Modules\Cms\Services\InfluencerCategoryService;
use Modules\Ums\Http\Requests\InfluencerStoreRequest;
use Modules\Ums\Http\Requests\InfluencerUpdateRequest;
use Modules\Ums\Http\Requests\UserStoreRequest;

use Modules\Ums\Services\UserAdditionalInfoService;
use Modules\Ums\Services\UserService;
use Modules\Ums\Services\UserShippingInfoService;
use Modules\Ums\Services\UserSocialAccountInfoService;

class InfluencerController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $userAdditionalInfoService
     */
    protected $userAdditionalInfoService;

    /**
     * @var $userShippingInfoService
     */
    protected $userShippingInfoService;

    /**
     * @var $userSocialAccountInfoService
     */
    protected $userSocialAccountInfoService;

    /**
     * @var $influencerCategoryService
     */
    protected $influencerCategoryService;

    /**
     * @var $dashboardService
     */
    protected $dashboardService;

    /**
     * @var $campaignService
     */
    protected $campaignService;

    /**
     * @var $campaignInfluencerService
     */
    protected $campaignInfluencerService;

    /**
     * Constructor
     *
     * @param UserService $userService
     * @param UserAdditionalInfoService $userAdditionalInfoService
     * @param InfluencerCategoryService $influencerCategoryService
     * @param DashboardService $dashboardService
     * @param CampaignService $campaignService
     * @param UserShippingInfoService $userShippingInfoService
     * @param UserSocialAccountInfoService $userSocialAccountInfoService
     * @param CampaignInfluencerService $campaignInfluencerService
     */
    public function __construct
    (
        UserService $userService,
        UserAdditionalInfoService $userAdditionalInfoService,
        InfluencerCategoryService $influencerCategoryService,
        DashboardService $dashboardService,
        CampaignService $campaignService,
        UserShippingInfoService $userShippingInfoService,
        UserSocialAccountInfoService $userSocialAccountInfoService,
        CampaignInfluencerService $campaignInfluencerService
    )
    {
        $this->userService = $userService;
        $this->userAdditionalInfoService = $userAdditionalInfoService;
        $this->influencerCategoryService = $influencerCategoryService;
        $this->dashboardService = $dashboardService;
        $this->campaignService = $campaignService;
        $this->userShippingInfoService = $userShippingInfoService;
        $this->userSocialAccountInfoService = $userSocialAccountInfoService;
        $this->campaignInfluencerService = $campaignInfluencerService;
        $this->middleware(['permission:Influencer']);
    }

    /**
     * User list
     *
     * @return \Illuminate\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        $dashboard = new \stdClass();

        if (AuthManager::isBrand()) {
            $favourite = 0;
            if (\request()->has('favourite')) {
                $favourite = \request()->get('favourite');
            }

            if ($favourite == 1) {
                $influencers = $this->campaignInfluencerService->brandFavouriteInfluencers();
            } else {
                $influencers = $this->campaignInfluencerService->brandInfluencers();
            }

            $dashboard->statistics = $this->dashboardService->statisticsBrand();
        } else if (AuthManager::isInfluencerManager()) {
            $influencers = $this->campaignInfluencerService->campaignManagerInfluencers();
            $dashboard->statistics = $this->dashboardService->statisticsInfluencerManager();
        } else if (AuthManager::isAdmin() || AuthManager::isSuperAdmin()) {
            $influencers = $this->campaignInfluencerService->all();
            $dashboard->statistics = $this->dashboardService->statistics();
        }

        return view('ums::influencer.index', compact('influencers', 'dashboard'));
    }

    /**
     * Create user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // influencer categories
        $influencerCategories = $this->influencerCategoryService->all();

        // campaigns
        // $campaigns = $this->campaignService->all();

        // return view
        return view('ums::influencer.create', compact('influencerCategories'));
    }


    /**
     * Store user
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InfluencerStoreRequest $request)
    {
        // get data
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        $data['is_influencer'] = true;
        $data['is_process_completed'] = true;
        $data['categories'] = array_map('intval', $data['categories'] ?? []);
        $data['terms_conditions'] = true;
        $data['subscribe'] = true;

        // create user
        $user = $this->userService->create($data);
        // assign roles
        $user->assignRole(['Influencer']);
        // upload files
        $user->uploadFiles();
        // check if user created
        if ($user) {
            $data['user_id'] = $user->id;
            $userAdditionalInfo = $this->userAdditionalInfoService->create($data);

            $data['first_name'] = $data['shipping_first_name'];
            $data['last_name'] = $data['shipping_last_name'];

            $this->userShippingInfoService->create($data);
            $this->userSocialAccountInfoService->create($data);

            $send_success = true;

            try {
                $mailData = [
                    'title' => 'Registration',
                    'first_name' => $userAdditionalInfo->first_name ?? '',
                    'last_name' => $userAdditionalInfo->last_name ?? '',
                    'register_as' => 'Influencer',
                    'login_url' => env('APP_URL') . '/login'
                ];
                \Mail::to($user->email ?? '')->send(new RegisterMail($mailData));
            } catch (\Exception $exception) {
                $send_success = false;
            }

            if ($send_success) {
                notifier()->success('Influencer added successfully.');
            } else {
                notifier()->warning('Influencer added successfully but mail not send due to connection error.');
            }
        } else {
            // flash notification
            notifier()->error('Influencer cannot be added.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show user.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        abort(404);
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error('User not found!');
            // redirect back
            return redirect()->back();
        }
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // return view
        return view('ums::user.show', compact('user', 'givenRoles'));
    }

    /**
     * Show user.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $influencerIds = CampaignInfluencer::query()->where('campaign_manager_id', \auth()->user()->id)->get()->pluck('influencer_id')->toArray();

        if (!in_array($id, $influencerIds)) {
            abort(404);
        }

        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user) || !$user->is_influencer) {
            // flash notification
            notifier()->error('Influencer not found!');
            // redirect back
            return redirect()->back();
        }

        // influencer categories
        $influencerCategories = $this->influencerCategoryService->all();
        // campaigns
        // $campaigns = $this->campaignService->all();

        // return view
        return view('ums::influencer.edit', compact('user', 'influencerCategories'));
    }

    /**
     * Update user
     *
     * @param InfluencerUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InfluencerUpdateRequest $request, $id)
    {
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error('Influencer not found!');
            // redirect back
            return redirect()->back();
        }
        // get data
        $data = $request->all();
        // upload files
        $user->uploadFiles();

        $data['categories'] = array_map('intval', $data['categories'] ?? []);
        // update user
        $user = $this->userService->update($data, $id);

        // check if user updated
        if ($user) {
            $this->userAdditionalInfoService->updateOrCreate(['user_id' => $user->id], $data);

            $data['first_name'] = $data['shipping_first_name'];
            $data['last_name'] = $data['shipping_last_name'];

            $this->userShippingInfoService->updateOrCreate(['user_id' => $user->id], $data);
            $this->userSocialAccountInfoService->updateOrCreate(['user_id' => $user->id], $data);

            notifier()->success('Influencer updated successfully.');
        } else {
            // flash notification
            notifier()->error('Incluencer cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error('User not found!');
            // redirect back
            return redirect()->back();
        }
        // delete user
        if ($this->userService->delete($id)) {
            // flash notification
            notifier()->success('User deleted successfully.');
        } else {
            // flash notification
            notifier()->success('User cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    public function list()
    {
        if (!AuthManager::isAdmin() && !AuthManager::isSuperAdmin())
            abort(404);

        $influencers = $this->userService->influencers();

        return view('ums::influencer.list', compact('influencers'));
    }

    /**
     * User list
     *
     * @return \Illuminate\View\View
     */
    /*public function priority()
    {
        $teachers = $this->userService->allTeachers();
        return view('ums::user.priority', compact(
            'teachers'
        ));
    }*/

    /**
     * Update user
     *
     * @param Request $request
     * @return array
     */

    /*public function priorityUpdate(Request $request)
    {
        if ($request->has('ids')) {
            $ids = explode(',', $request['ids']);
            $ids = array_map('intval', $ids);
            foreach($ids as $index => $id) {
                $data = [
                    'priority_order' => $index + 1
                ];
                $this->userService->update($data, $id);
            }
        }

        return response()->json(['status' => 'success']);
    }*/
}
