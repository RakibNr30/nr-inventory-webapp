<?php

namespace Modules\Setting\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Setting\Services\SeoService;

// requests...
use Modules\Setting\Http\Requests\SeoStoreRequest;
use Modules\Setting\Http\Requests\SeoUpdateRequest;

// resources...
use Modules\Setting\Transformers\SeoResource;

class SeoController extends Controller
{
    /**
     * @var $seoService
     */
    protected $seoService;

    /**
     * Constructor
     *
     * @param SeoService $seoService
     */
    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Seo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all seos
        $seos = $this->seoService->all(request()->get('limit') ?? 0);
        // if no seo found
        if (!count($seos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Seo not available.');
        }
        // transform seos
        $seos = SeoResource::collection($seos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($seos);
    }

    /**
     * Store a seo.
     *
     * @param SeoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeoStoreRequest $request)
    {
        // create seo
        $seo = $this->seoService->create($request->all());
        // check if created
        if ($seo) {
            // transform seo
            $seo = SeoResource::make($seo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Seo created successfully.')
                ->data($seo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Seo cannot be created.');
        }
    }

    /**
     * Show seo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get seo
        $seo = $this->seoService->find($id);
        // if no seo found
        if (empty($seo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Seo not found.');
        }
        // transform seo
        $seo = SeoResource::make($seo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Seo is available.')
            ->data($seo);
    }

    /**
     * Update seo.
     *
     * @param SeoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeoUpdateRequest $request, $id)
    {
        // get seo
        $seo = $this->seoService->find($id);
        // if no seo found
        if (empty($seo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Seo not found.');
        }
        // update seo
        $seo = $this->seoService->update($request->all(), $id);
        // check if updated
        if ($seo) {
            // get updated seo
            $seo = $this->seoService->find($id);
            // transform seo
            $seo = SeoResource::make($seo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Seo updated successfully.')
                ->data($seo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Seo cannot be updated.');
        }
    }

    /**
     * Remove seo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get seo
        $seo = $this->seoService->find($id);
        // if no seo found
        if (empty($seo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Seo not found.');
        }
        // delete seo
        if ($this->seoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Seo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Seo cannot be deleted.');
        }
    }
}
