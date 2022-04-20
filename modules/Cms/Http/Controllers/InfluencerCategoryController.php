<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\InfluencerCategoryStoreRequest;
use Modules\Cms\Http\Requests\InfluencerCategoryUpdateRequest;

// datatable...
use Modules\Cms\DataTables\InfluencerCategoryDataTable;

// services...
use Modules\Cms\Services\InfluencerCategoryService;

class InfluencerCategoryController extends Controller
{
    /**
     * @var $influencerCategoryService
     */
    protected $influencerCategoryService;

    /**
     * Constructor
     *
     * @param InfluencerCategoryService $influencerCategoryService
     */
    public function __construct(InfluencerCategoryService $influencerCategoryService)
    {
        $this->influencerCategoryService = $influencerCategoryService;
    }

    /**
     * InfluencerCategory list
     *
     * @param InfluencerCategoryDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(InfluencerCategoryDataTable $datatable)
    {
        return $datatable->render('cms::influencer_category.index');
    }

    /**
     * Create influencerCategory
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::influencer_category.create');
    }


    /**
     * Store influencerCategory
     *
     * @param InfluencerCategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InfluencerCategoryStoreRequest $request)
    {
        // create influencerCategory
        $influencerCategory = $this->influencerCategoryService->create($request->all());
        // check if influencerCategory created
        if ($influencerCategory) {
            // flash notification
            notifier()->success('Influencer category created successfully.');
        } else {
            // flash notification
            notifier()->error('Influencer category cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show influencerCategory.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get influencerCategory
        $influencerCategory = $this->influencerCategoryService->find($id);
        // check if influencerCategory doesn't exists
        if (empty($influencerCategory)) {
            // flash notification
            notifier()->error('Influencer category not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::influencer_category.show', compact('influencerCategory'));
    }

    /**
     * Show influencerCategory.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get influencerCategory
        $influencerCategory = $this->influencerCategoryService->find($id);
        // check if influencerCategory doesn't exists
        if (empty($influencerCategory)) {
            // flash notification
            notifier()->error('Influencer category not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::influencer_category.edit', compact('influencerCategory'));
    }

    /**
     * Update influencerCategory
     *
     * @param InfluencerCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InfluencerCategoryUpdateRequest $request, $id)
    {
        // get influencerCategory
        $influencerCategory = $this->influencerCategoryService->find($id);
        // check if influencerCategory doesn't exists
        if (empty($influencerCategory)) {
            // flash notification
            notifier()->error('Influencer category not found!');
            // redirect back
            return redirect()->back();
        }
        // update influencerCategory
        $influencerCategory = $this->influencerCategoryService->update($request->all(), $id);
        // check if influencerCategory updated
        if ($influencerCategory) {
            // flash notification
            notifier()->success('Influencer category updated successfully.');
        } else {
            // flash notification
            notifier()->error('Influencer category cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete influencerCategory
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get influencerCategory
        $influencerCategory = $this->influencerCategoryService->find($id);
        // check if influencerCategory doesn't exists
        if (empty($influencerCategory)) {
            // flash notification
            notifier()->error('Influencer category not found!');
            // redirect back
            return redirect()->back();
        }
        // delete influencerCategory
        if ($this->influencerCategoryService->delete($id)) {
            // flash notification
            notifier()->success('Influencer category deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Influencer category cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
