<?php

namespace Modules\Setting\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Setting\Services\SocialiteService;

// requests...
use Modules\Setting\Http\Requests\SocialiteStoreRequest;
use Modules\Setting\Http\Requests\SocialiteUpdateRequest;

// resources...
use Modules\Setting\Transformers\SocialiteResource;

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
     * Socialite list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all socialites
        $socialites = $this->socialiteService->all(request()->get('limit') ?? 0);
        // if no socialite found
        if (!count($socialites)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Socialite not available.');
        }
        // transform socialites
        $socialites = SocialiteResource::collection($socialites);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($socialites);
    }

    /**
     * Store a socialite.
     *
     * @param SocialiteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialiteStoreRequest $request)
    {
        // create socialite
        $socialite = $this->socialiteService->create($request->all());
        // check if created
        if ($socialite) {
            // transform socialite
            $socialite = SocialiteResource::make($socialite);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Socialite created successfully.')
                ->data($socialite);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Socialite cannot be created.');
        }
    }

    /**
     * Show socialite.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get socialite
        $socialite = $this->socialiteService->find($id);
        // if no socialite found
        if (empty($socialite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Socialite not found.');
        }
        // transform socialite
        $socialite = SocialiteResource::make($socialite);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Socialite is available.')
            ->data($socialite);
    }

    /**
     * Update socialite.
     *
     * @param SocialiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialiteUpdateRequest $request, $id)
    {
        // get socialite
        $socialite = $this->socialiteService->find($id);
        // if no socialite found
        if (empty($socialite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Socialite not found.');
        }
        // update socialite
        $socialite = $this->socialiteService->update($request->all(), $id);
        // check if updated
        if ($socialite) {
            // get updated socialite
            $socialite = $this->socialiteService->find($id);
            // transform socialite
            $socialite = SocialiteResource::make($socialite);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Socialite updated successfully.')
                ->data($socialite);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Socialite cannot be updated.');
        }
    }

    /**
     * Remove socialite.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get socialite
        $socialite = $this->socialiteService->find($id);
        // if no socialite found
        if (empty($socialite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Socialite not found.');
        }
        // delete socialite
        if ($this->socialiteService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Socialite deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Socialite cannot be deleted.');
        }
    }
}
