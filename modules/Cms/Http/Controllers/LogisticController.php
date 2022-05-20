<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cms\Http\Requests\LogisticStoreRequest;
use Modules\Cms\DataTables\LogisticDataTable;
use Modules\Cms\Services\LogisticService;
use Modules\Cms\Services\ProductService;
use Modules\Ums\Services\UserService;

class LogisticController extends Controller
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
     * @var $logisticService
     */
    protected $logisticService;

    /**
     * Constructor
     *
     * @param ProductService $productService
     * @param UserService $userService
     * @param LogisticService $logisticService
     */

    public function __construct
    (
        ProductService $productService,
        UserService $userService,
        LogisticService $logisticService
    )
    {
        $this->productService = $productService;
        $this->userService = $userService;
        $this->logisticService = $logisticService;
        $this->middleware(['permission:Logistics']);
    }

    /**
     * Logistic list
     *
     * @return \Illuminate\View\View
     */
    public function index(LogisticDataTable $datatable)
    {
        return $datatable->render('cms::logistic.index');
    }

    /**
     * Create logistic
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $influencers = $this->userService->influencers();

        $products = $this->productService->all();

        // return view
        return view('cms::logistic.create', compact('influencers', 'products'));
    }


    /**
     * Store logistic
     *
     * @param LogisticStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LogisticStoreRequest $request)
    {
        $data = $request->all();

        $influencer = $this->userService->find($data['influencer_id']);
        $product = $this->productService->find($data['product_id']);

        $data['first_name'] = $influencer->shippingInfo->first_name ?? null;
        $data['last_name'] = $influencer->shippingInfo->last_name ?? null;
        $data['shipping_address'] = $influencer->shippingInfo->address ?? null;
        $data['zip'] = $influencer->shippingInfo->zip_code ?? null;
        $data['city'] = $influencer->shippingInfo->city ?? null;
        $data['country_code'] = $influencer->shippingInfo->country_code ?? null;
        $data['email'] = $influencer->email ?? null;
        $data['product_name'] = $product->title ?? null;
        $data['product_order'] = $product->priority ?? null;

        // create logistic
        $logistic = $this->logisticService->create($data);

        // check if logistic created
        if ($logistic) {
            // flash notification
            notifier()->success('Warehouse product added successfully.');
        } else {
            // flash notification
            notifier()->error('Warehouse product cannot be added.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete logistic
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get logistic
        $logistic = $this->logisticService->find($id);
        // check if logistic doesn't exists
        if (empty($logistic)) {
            // flash notification
            notifier()->error('Warehouse product not found!');
            // redirect back
            return redirect()->back();
        }
        // delete logistic
        if ($this->logisticService->delete($id)) {
            // flash notification
            notifier()->success('Warehouse product deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Warehouse product cannot be deleted.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Update user
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateShippingStatus(Request $request, $id)
    {
        $data = $request->all();

        $logistic = $this->logisticService->find($id);

        logger($logistic);

        if (empty($logistic)) {
            return response()->json(['status' => 'success', 'updated' => false]);
        }

        $logistic = $this->logisticService->update($data, $id);

        if ($logistic) {
            return response()->json(['status' => 'success', 'updated' => true]);
        } else {
            return response()->json(['status' => 'success', 'updated' => false]);
        }
    }
}
