<?php

namespace Modules\Setting\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Setting\Services\SiteService;

// requests...
use Modules\Setting\Http\Requests\SiteStoreRequest;
use Modules\Setting\Http\Requests\SiteUpdateRequest;

// resources...
use Modules\Setting\Transformers\SiteResource;

class SiteController extends Controller
{
    /**
     * @var $siteService
     */
    protected $siteService;

    /**
     * Constructor
     *
     * @param SiteService $siteService
     */
    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
    }

    /**
     * Site list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all sites
        $sites = $this->siteService->all(request()->get('limit') ?? 0);
        // if no site found
        if (!count($sites)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Site not available.');
        }
        // transform sites
        $sites = SiteResource::collection($sites);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($sites);
    }

    /**
     * Store a site.
     *
     * @param SiteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteStoreRequest $request)
    {
        // create site
        $site = $this->siteService->create($request->all());
        // check if created
        if ($site) {
            // transform site
            $site = SiteResource::make($site);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Site created successfully.')
                ->data($site);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Site cannot be created.');
        }
    }

    /**
     * Show site.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get site
        $site = $this->siteService->find($id);
        // if no site found
        if (empty($site)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Site not found.');
        }
        // transform site
        $site = SiteResource::make($site);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Site is available.')
            ->data($site);
    }

    /**
     * Update site.
     *
     * @param SiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteUpdateRequest $request, $id)
    {
        // get site
        $site = $this->siteService->find($id);
        // if no site found
        if (empty($site)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Site not found.');
        }
        // update site
        $site = $this->siteService->update($request->all(), $id);
        // check if updated
        if ($site) {
            // get updated site
            $site = $this->siteService->find($id);
            // transform site
            $site = SiteResource::make($site);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Site updated successfully.')
                ->data($site);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Site cannot be updated.');
        }
    }

    /**
     * Remove site.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get site
        $site = $this->siteService->find($id);
        // if no site found
        if (empty($site)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Site not found.');
        }
        // delete site
        if ($this->siteService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Site deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Site cannot be deleted.');
        }
    }
}
