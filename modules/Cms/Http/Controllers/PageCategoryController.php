<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\PageCategoryStoreRequest;
use Modules\Cms\Http\Requests\PageCategoryUpdateRequest;

// datatable...
use Modules\Cms\DataTables\PageCategoryDataTable;

// services...
use Modules\Cms\Services\PageCategoryService;

class PageCategoryController extends Controller
{
    /**
     * @var $pageCategoryService
     */
    protected $pageCategoryService;

    /**
     * Constructor
     *
     * @param PageCategoryService $pageCategoryService
     */
    public function __construct(PageCategoryService $pageCategoryService)
    {
        $this->pageCategoryService = $pageCategoryService;
        $this->middleware(['permission:Common Settings']);
    }

    /**
     * PageCategory list
     *
     * @param PageCategoryDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(PageCategoryDataTable $datatable)
    {
        return $datatable->render('cms::page_category.index');
    }

    /**
     * Create pageCategory
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::page_category.create');
    }


    /**
     * Store pageCategory
     *
     * @param PageCategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageCategoryStoreRequest $request)
    {
        // create pageCategory
        $pageCategory = $this->pageCategoryService->create($request->all());
        // check if pageCategory created
        if ($pageCategory) {
            // flash notification
            notifier()->success('PageCategory created successfully.');
        } else {
            // flash notification
            notifier()->error('PageCategory cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show pageCategory.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // check if pageCategory doesn't exists
        if (empty($pageCategory)) {
            // flash notification
            notifier()->error('PageCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::page_category.show', compact('pageCategory'));
    }

    /**
     * Show pageCategory.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // check if pageCategory doesn't exists
        if (empty($pageCategory)) {
            // flash notification
            notifier()->error('PageCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::page_category.edit', compact('pageCategory'));
    }

    /**
     * Update pageCategory
     *
     * @param PageCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageCategoryUpdateRequest $request, $id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // check if pageCategory doesn't exists
        if (empty($pageCategory)) {
            // flash notification
            notifier()->error('PageCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // update pageCategory
        $pageCategory = $this->pageCategoryService->update($request->all(), $id);
        // check if pageCategory updated
        if ($pageCategory) {
            // flash notification
            notifier()->success('PageCategory updated successfully.');
        } else {
            // flash notification
            notifier()->error('PageCategory cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete pageCategory
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // check if pageCategory doesn't exists
        if (empty($pageCategory)) {
            // flash notification
            notifier()->error('PageCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // delete pageCategory
        if ($this->pageCategoryService->delete($id)) {
            // flash notification
            notifier()->success('PageCategory deleted successfully.');
        } else {
            // flash notification
            notifier()->success('PageCategory cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
