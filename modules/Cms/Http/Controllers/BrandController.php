<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Illuminate\Support\Facades\Hash;
use Modules\Cms\Http\Requests\BrandStoreRequest;
use Modules\Cms\Http\Requests\BrandUpdateRequest;

// datatable...
use Modules\Cms\DataTables\BrandDataTable;

// services...
use Modules\Cms\Services\BrandService;
use Modules\Ums\Services\UserService;

class BrandController extends Controller
{
    /**
     * @var $brandService
     */
    protected $brandService;

    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param BrandService $brandService
     * @param UserService $userService
     */
    public function __construct(BrandService $brandService, UserService $userService)
    {
        $this->brandService = $brandService;
        $this->userService = $userService;
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
        $data = $request->all();
        // create brand
        $brand = $this->brandService->create($data);
        // upload file
        $brand->uploadFiles();
        // check if brand created
        if ($brand) {
            $user_data['first_name'] = $data['first_name'];
            $user_data['last_name'] = $data['last_name'];
            $user_data['email'] = $data['email'];
            $user_data['phone'] = $data['phone'];
            $user_data['password'] = Hash::make($data['password']);
            $user_data['is_brand'] = true;
            $user_data['user_brand_id'] = $brand->id;

            $user = $this->userService->create($user_data);

            if ($user) {
                $user->assignRole(['Brand']);
                $this->brandService->update(['user_id' => $user->id], $brand->id);

                $user_data['user_id'] = $user->id;

                $user->additionalInfo()->create($user_data);

                // email sending section
                /*try {
                    MailManager::send($user->email, "");
                } catch (\Exception $e) {}*/
            }

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
        $data = $request->all();

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
        $brand = $this->brandService->update($data, $id);
        // upload files
        $brand->uploadFiles();
        // check if brand updated
        if ($brand) {
            $user_data['first_name'] = $data['first_name'];
            $user_data['last_name'] = $data['last_name'];
            $user_data['email'] = $data['email'];
            $user_data['phone'] = $data['phone'];

            $user_additional_data['first_name'] = $user_data['first_name'];
            $user_additional_data['last_name'] = $user_data['last_name'];

            $user = $this->userService->update($user_data, $brand->user_id);

            if ($user) {
                $user_data['user_id'] = $user->id;

                $user->additionalInfo()->update($user_additional_data);

                // email sending section
                /*try {
                    MailManager::send($user->email, "");
                } catch (\Exception $e) {}*/
            }

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
