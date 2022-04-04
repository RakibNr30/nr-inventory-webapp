<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\PageStoreRequest;
use Modules\Cms\Http\Requests\PageUpdateRequest;

// datatable...
use Modules\Cms\DataTables\PageDataTable;

// services...
use Modules\Cms\Services\PageCategoryService;
use Modules\Cms\Services\PageService;

class PageController extends Controller
{
    /**
     * @var $pageService
     */
    protected $pageService;
    /**
     * @var $pageCategoryService
     */
    protected $pageCategoryService;

    /**
     * Constructor
     *
     * @param PageService $pageService
     * @param PageCategoryService $pageCategoryService
     */
    public function __construct(PageService $pageService, PageCategoryService $pageCategoryService)
    {
        $this->pageService = $pageService;
        $this->pageCategoryService = $pageCategoryService;
        $this->middleware(['permission:Cms']);
    }

    /**
     * Page list
     *
     * @param PageDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(PageDataTable $datatable)
    {
        return $datatable->render('cms::page.index');
    }

    /**
     * Create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // get all page categories
        $pageCategories = $this->pageCategoryService->all();
        // return view
        return view('cms::page.create', compact('pageCategories'));
    }


    /**
     * Store page
     *
     * @param PageStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageStoreRequest $request)
    {
        // create page
        $page = $this->pageService->create($request->all());
        // upload file
        $page->uploadFiles();
        // check if page created
        if ($page) {
            // flash notification
            notifier()->success('Page created successfully.');
        } else {
            // flash notification
            notifier()->error('Page cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show page.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get page
        $page = $this->pageService->find($id);
        // check if page doesn't exists
        if (empty($page)) {
            // flash notification
            notifier()->error('Page not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::page.show', compact('page'));
    }

    /**
     * Show page.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get all content categories
        $pageCategories = $this->pageCategoryService->all();
        // get page
        $page = $this->pageService->find($id);
        // check if page doesn't exists
        if (empty($page)) {
            // flash notification
            notifier()->error('Page not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::page.edit', compact('page', 'pageCategories'));
    }

    /**
     * Update page
     *
     * @param PageUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageUpdateRequest $request, $id)
    {
        // get page
        $page = $this->pageService->find($id);
        // check if page doesn't exists
        if (empty($page)) {
            // flash notification
            notifier()->error('Page not found!');
            // redirect back
            return redirect()->back();
        }
        // update page
        $page = $this->pageService->update($request->all(), $id);
        // upload files
        $page->uploadFiles();
        // check if page updated
        if ($page) {
            // flash notification
            notifier()->success('Page updated successfully.');
        } else {
            // flash notification
            notifier()->error('Page cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete page
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get page
        $page = $this->pageService->find($id);
        // check if page doesn't exists
        if (empty($page)) {
            // flash notification
            notifier()->error('Page not found!');
            // redirect back
            return redirect()->back();
        }
        // delete page
        if ($this->pageService->delete($id)) {
            // flash notification
            notifier()->success('Page deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Page cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
