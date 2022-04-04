<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\BrandStoreRequest;
use Modules\Cms\Http\Requests\BrandUpdateRequest;

// datatable...
use Modules\Cms\DataTables\BrandDataTable;

// services...
use Modules\Cms\Services\BrandService;

class BrandController extends Controller
{
    /**
     * @var $brandService
     */
    protected $brandService;

    /**
     * Constructor
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
        //$this->middleware(['permission:Cms']);
    }

    /**
     * Brand list
     *
     * @param BrandDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(BrandDataTable $datatable)
    {
        return $datatable->render('cms::brand.index');
    }

    /**
     * Create brand
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::brand.create');
    }


    /**
     * Store brand
     *
     * @param BrandStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandStoreRequest $request)
    {
        // create brand
        $brand = $this->brandService->create($request->all());
        // upload file
        $brand->uploadFiles();
        // check if brand created
        if ($brand) {
            // flash notification
            notifier()->success('Brand created successfully.');
        } else {
            // flash notification
            notifier()->error('Brand cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show brand.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get brand
        $brand = $this->brandService->find($id);
        // check if brand doesn't exists
        if (empty($brand)) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::brand.show', compact('brand'));
    }

    /**
     * Show brand.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get brand
        $brand = $this->brandService->find($id);
        // check if brand doesn't exists
        if (empty($brand)) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::brand.edit', compact('brand'));
    }

    /**
     * Update brand
     *
     * @param BrandUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        // get brand
        $brand = $this->brandService->find($id);
        // check if brand doesn't exists
        if (empty($brand)) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }
        // update brand
        $brand = $this->brandService->update($request->all(), $id);
        // upload files
        $brand->uploadFiles();
        // check if brand updated
        if ($brand) {
            // flash notification
            notifier()->success('Brand updated successfully.');
        } else {
            // flash notification
            notifier()->error('Brand cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete brand
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get brand
        $brand = $this->brandService->find($id);
        // check if brand doesn't exists
        if (empty($brand)) {
            // flash notification
            notifier()->error('Brand not found!');
            // redirect back
            return redirect()->back();
        }
        // delete brand
        if ($this->brandService->delete($id)) {
            // flash notification
            notifier()->success('Brand deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Brand cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
