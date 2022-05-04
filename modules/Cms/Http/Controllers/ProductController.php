<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\ProductStoreRequest;
use Modules\Cms\Http\Requests\ProductUpdateRequest;

// datatable...
use Modules\Cms\DataTables\ProductDataTable;

// services...
use Modules\Cms\Services\ProductService;
use Modules\Ums\Services\UserService;

class ProductController extends Controller
{
    /**
     * @var $productService
     */
    protected $productService;

    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param ProductService $productService
     * @param UserService $userService
     */
    public function __construct(ProductService $productService, UserService $userService)
    {
        $this->productService = $productService;
        $this->userService = $userService;
        $this->middleware(['permission:Products']);
    }

    /**
     * Product list
     *
     * @param ProductDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('cms::product.index');
    }

    /**
     * Create product
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // brand lists
        $brands = $this->userService->brands();
        // return view
        return view('cms::product.create', compact('brands'));
    }


    /**
     * Store product
     *
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request)
    {
        // create product
        $product = $this->productService->create($request->all());
        // upload file
        $product->uploadFiles();
        // check if product created
        if ($product) {
            // flash notification
            notifier()->success('Product created successfully.');
        } else {
            // flash notification
            notifier()->error('Product cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show product.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get product
        $product = $this->productService->find($id);
        // check if product doesn't exists
        if (empty($product)) {
            // flash notification
            notifier()->error('Product not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::product.show', compact('product'));
    }

    /**
     * Show product.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // brand lists
        $brands = $this->userService->brands();
        // get product
        $product = $this->productService->find($id);
        // check if product doesn't exists
        if (empty($product)) {
            // flash notification
            notifier()->error('Product not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::product.edit', compact('product', 'brands'));
    }

    /**
     * Update product
     *
     * @param ProductUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        // get product
        $product = $this->productService->find($id);
        // check if product doesn't exists
        if (empty($product)) {
            // flash notification
            notifier()->error('Product not found!');
            // redirect back
            return redirect()->back();
        }
        // update product
        $product = $this->productService->update($request->all(), $id);
        // upload files
        $product->uploadFiles();
        // check if product updated
        if ($product) {
            // flash notification
            notifier()->success('Product updated successfully.');
        } else {
            // flash notification
            notifier()->error('Product cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete product
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get product
        $product = $this->productService->find($id);
        // check if product doesn't exists
        if (empty($product)) {
            // flash notification
            notifier()->error('Product not found!');
            // redirect back
            return redirect()->back();
        }
        // delete product
        if ($this->productService->delete($id)) {
            // flash notification
            notifier()->success('Product deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Product cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
