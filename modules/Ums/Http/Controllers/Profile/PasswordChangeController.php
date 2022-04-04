<?php

namespace Modules\Ums\Http\Controllers\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;
use Modules\Ums\Services\UserService;

class PasswordChangeController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // first or create user additional info
        $user = $this->userService->firstOrCreate([
            'id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.password_change.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|required_with:repeat_password|same:repeat_password',
        ]);

        // get data
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user_pass = $this->userService->find($id)->password;

        if (!Hash::check($data['old_password'], $user_pass)) {
            // flash notification
            notifier()->error('Old password do not match.');
            return redirect()->back();
        }
        // create user
        $user = $this->userService->update($data, $id);
        // check if user created
        if ($user) {
            // flash notification
            notifier()->success('Password Changed successfully.');
        } else {
            // flash notification
            notifier()->error('Password cannot be changed.');
        }
        // redirect back
        return redirect()->back();
    }
}
