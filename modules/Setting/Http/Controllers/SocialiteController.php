<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Setting\Http\Requests\SocialiteUpdateRequest;

// services...
use Modules\Setting\Services\SocialiteService;

class SocialiteController extends Controller
{
    /**
     * @var $socialiteService
     */
    protected $socialiteService;

    /**
     * Constructor
     *
     * @param SocialiteService $socialiteService
     */
    public function __construct(SocialiteService $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }

    /**
     * Socialite list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // get socialite data
        $socialite = $this->socialiteService->firstOrCreate([]);
        // return view
        return view('setting::socialite.index', compact('socialite'));
    }

    /**
     * Update socialite
     *
     * @param SocialiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SocialiteUpdateRequest $request, $id)
    {
        // get socialite
        $socialite = $this->socialiteService->find($id);
        // check if socialite doesn't exists
        if (empty($socialite)) {
            // flash notification
            notifier()->error('Socialite not found!');
            // redirect back
            return redirect()->back();
        }
        // update socialite
        $socialite = $this->socialiteService->update($request->all(), $id);
        // check if socialite updated
        if ($socialite) {
            // flash notification
            notifier()->success('Socialite updated successfully.');
        } else {
            // flash notification
            notifier()->error('Socialite cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
