<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\MenuLinkStoreRequest;
use Modules\Cms\Http\Requests\MenuLinkUpdateRequest;

// datatable...
use Modules\Cms\DataTables\MenuLinkDataTable;

// services...
use Modules\Cms\Services\MenuLinkService;

class MenuLinkController extends Controller
{
    /**
     * @var $menuLinkService
     */
    protected $menuLinkService;

    /**
     * Constructor
     *
     * @param MenuLinkService $menuLinkService
     */
    public function __construct(MenuLinkService $menuLinkService)
    {
        $this->menuLinkService = $menuLinkService;
    }

    /**
     * MenuLink list
     *
     * @param MenuLinkDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(MenuLinkDataTable $datatable)
    {
        return $datatable->render('cms::menu_link.index');
    }

    /**
     * Create menuLink
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::menu_link.create');
    }


    /**
     * Store menuLink
     *
     * @param MenuLinkStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuLinkStoreRequest $request)
    {
        // create menuLink
        $menuLink = $this->menuLinkService->create($request->all());
        // check if menuLink created
        if ($menuLink) {
            // flash notification
            notifier()->success('MenuLink created successfully.');
        } else {
            // flash notification
            notifier()->error('MenuLink cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show menuLink.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // check if menuLink doesn't exists
        if (empty($menuLink)) {
            // flash notification
            notifier()->error('MenuLink not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::menu_link.show', compact('menuLink'));
    }

    /**
     * Show menuLink.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // check if menuLink doesn't exists
        if (empty($menuLink)) {
            // flash notification
            notifier()->error('MenuLink not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::menu_link.edit', compact('menuLink'));
    }

    /**
     * Update menuLink
     *
     * @param MenuLinkUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuLinkUpdateRequest $request, $id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // check if menuLink doesn't exists
        if (empty($menuLink)) {
            // flash notification
            notifier()->error('MenuLink not found!');
            // redirect back
            return redirect()->back();
        }
        // update menuLink
        $menuLink = $this->menuLinkService->update($request->all(), $id);
        // check if menuLink updated
        if ($menuLink) {
            // flash notification
            notifier()->success('MenuLink updated successfully.');
        } else {
            // flash notification
            notifier()->error('MenuLink cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete menuLink
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // check if menuLink doesn't exists
        if (empty($menuLink)) {
            // flash notification
            notifier()->error('MenuLink not found!');
            // redirect back
            return redirect()->back();
        }
        // delete menuLink
        if ($this->menuLinkService->delete($id)) {
            // flash notification
            notifier()->success('MenuLink deleted successfully.');
        } else {
            // flash notification
            notifier()->success('MenuLink cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
