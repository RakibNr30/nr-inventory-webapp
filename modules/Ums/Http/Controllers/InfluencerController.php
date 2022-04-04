<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Ums\Entities\User;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// datatable...
use Modules\Ums\DataTables\UserDataTable;

// services...
use Modules\Ums\Services\RoleService;
use Modules\Ums\Services\UserAdditionalInfoService;
use Modules\Ums\Services\UserService;
use function GuzzleHttp\Promise\all;

class InfluencerController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $additionalInfoService
     */
    protected $userAdditionalInfoService;

    /**
     * @var $roleService
     */
    protected $roleService;

    /**
     * Constructor
     *
     * @param UserService $userService
     * @param UserAdditionalInfoService $userAdditionalInfoService
     * @param RoleService $roleService
     */
    public function __construct(UserService $userService, UserAdditionalInfoService $userAdditionalInfoService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->userAdditionalInfoService = $userAdditionalInfoService;
        $this->roleService = $roleService;
        //$this->middleware(['permission:User']);
    }

    /**
     * User list
     *
     * @param UserDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $influencers = $this->userService->influencers(10);
        return view('ums::influencer.index', compact('influencers'));
    }

    /**
     * Create user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // roles
        $roles = $this->roleService->all();
        // return view
        return view('ums::user.create', compact('roles'));
    }


    /**
     * Store user
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        // get data
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        // create user
        $user = $this->userService->create($data);
        // assign roles
        if (count($data['roles']) > 0) {
            // remove chairman role
            if (in_array('Chairman', $data['roles'])) {
                $chairman = User::role('Chairman')->first();
                if ($chairman) {
                    if ($chairman->hasRole('Chairman')) {
                        $chairman->removeRole('Chairman');
                    }
                }
            }
            // assign roles
            $user->assignRole($data['roles']);
        }
        // upload files
        $user->uploadFiles();
        // check if user created
        if ($user) {
            $data['user_id'] = $user->id;
            $data['personal_email'] = $user->email;
            $data['personal_phone'] = $user->phone;
            $additionalInfo = $this->userAdditionalInfoService->create($data);
            // upload files
            $additionalInfo->uploadFiles();
            if ($additionalInfo) {
                // flash notification
                notifier()->success('User created successfully.');
            } else {
                // flash notification
                notifier()->error('User cannot be created successfully.');
            }
        } else {
            // flash notification
            notifier()->error('User cannot be created successfully.');
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
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error('User not found!');
            // redirect back
            return redirect()->back();
        }
        // roles
        $roles = $this->roleService->all();
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // return view
        return view('ums::user.edit', compact('user', 'roles', 'givenRoles'));
    }

    /**
     * Update user
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
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
        // get data
        $data = $request->all();
        // upload files
        $user->uploadFiles();
        // update user
        $user = $this->userService->update($data, $id);
        // assign roles
        if (count($data['roles']) > 0) {
            // remove chairman role
            if (in_array('Chairman', $data['roles'])) {
                $chairman = User::role('Chairman')->first();
                if ($chairman) {
                    if ($chairman->hasRole('Chairman')) {
                        $chairman->removeRole('Chairman');
                    }
                }
            }
            // assign roles
            $user->syncRoles($data['roles']);
        }
        // check if user updated
        if ($user) {
            $data['personal_email'] = $user->email;
            $data['personal_phone'] = $user->phone;
            $additionalInfo = $this->userAdditionalInfoService->updateOrCreate(['user_id' => $user->id], $data);
            // upload files
            $additionalInfo->uploadFiles();
            if ($additionalInfo) {
                // flash notification
                notifier()->success('User updated successfully.');
            } else {
                // flash notification
                notifier()->error('User cannot be updated successfully.');
            }
        } else {
            // flash notification
            notifier()->error('User cannot be updated successfully.');
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
