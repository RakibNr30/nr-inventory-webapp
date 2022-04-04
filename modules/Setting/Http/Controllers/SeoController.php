<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Setting\Http\Requests\SeoUpdateRequest;

// services...
use Modules\Setting\Services\SeoService;

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
     * Seo list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // get seo data
        $seo = $this->seoService->firstOrCreate([]);
        // return view
        return view('setting::seo.index', compact('seo'));
    }

    /**
     * Update seo
     *
     * @param SeoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SeoUpdateRequest $request, $id)
    {
        // get seo
        $seo = $this->seoService->find($id);
        // check if seo doesn't exists
        if (empty($seo)) {
            // flash notification
            notifier()->error('Seo not found!');
            // redirect back
            return redirect()->back();
        }
        // update seo
        $seo = $this->seoService->update($request->all(), $id);
        // check if seo updated
        if ($seo) {
            // flash notification
            notifier()->success('Seo updated successfully.');
        } else {
            // flash notification
            notifier()->error('Seo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
