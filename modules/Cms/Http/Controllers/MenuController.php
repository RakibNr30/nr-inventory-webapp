<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\MenuStoreRequest;
use Modules\Cms\Http\Requests\MenuUpdateRequest;

// datatable...
use Modules\Cms\DataTables\MenuDataTable;

// services...
use Modules\Cms\Services\MenuService;

class MenuController extends Controller
{
    /**
     * @var $menuService
     */
    protected $menuService;

    /**
     * Constructor
     *
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Menu list
     *
     * @param MenuDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(MenuDataTable $datatable)
    {
        return $datatable->render('cms::menu.index');
    }

    /**
     * Create menu
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::menu.create');
    }


    /**
     * Store menu
     *
     * @param MenuStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuStoreRequest $request)
    {
        // create menu
        $menu = $this->menuService->create($request->all());
        // check if menu created
        if ($menu) {
            // flash notification
            notifier()->success('Menu created successfully.');
        } else {
            // flash notification
            notifier()->error('Menu cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show menu.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // check if menu doesn't exists
        if (empty($menu)) {
            // flash notification
            notifier()->error('Menu not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::menu.show', compact('menu'));
    }

    /**
     * Show menu.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // check if menu doesn't exists
        if (empty($menu)) {
            // flash notification
            notifier()->error('Menu not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::menu.edit', compact('menu'));
    }

    /**
     * Update menu
     *
     * @param MenuUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuUpdateRequest $request, $id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // check if menu doesn't exists
        if (empty($menu)) {
            // flash notification
            notifier()->error('Menu not found!');
            // redirect back
            return redirect()->back();
        }
        // update menu
        $menu = $this->menuService->update($request->all(), $id);
        // check if menu updated
        if ($menu) {
            // flash notification
            notifier()->success('Menu updated successfully.');
        } else {
            // flash notification
            notifier()->error('Menu cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete menu
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // check if menu doesn't exists
        if (empty($menu)) {
            // flash notification
            notifier()->error('Menu not found!');
            // redirect back
            return redirect()->back();
        }
        // delete menu
        if ($this->menuService->delete($id)) {
            // flash notification
            notifier()->success('Menu deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Menu cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
