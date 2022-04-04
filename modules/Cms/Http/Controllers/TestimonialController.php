<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\TestimonialStoreRequest;
use Modules\Cms\Http\Requests\TestimonialUpdateRequest;

// datatable...
use Modules\Cms\DataTables\TestimonialDataTable;

// services...
use Modules\Cms\Services\TestimonialService;

class TestimonialController extends Controller
{
    /**
     * @var $testimonialService
     */
    protected $testimonialService;

    /**
     * Constructor
     *
     * @param TestimonialService $testimonialService
     */
    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    /**
     * Testimonial list
     *
     * @param TestimonialDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(TestimonialDataTable $datatable)
    {
        return $datatable->render('cms::testimonial.index');
    }

    /**
     * Create testimonial
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::testimonial.create');
    }


    /**
     * Store testimonial
     *
     * @param TestimonialStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TestimonialStoreRequest $request)
    {
        // create testimonial
        $testimonial = $this->testimonialService->create($request->all());
        // upload files
        $testimonial->uploadFiles();
        // check if testimonial created
        if ($testimonial) {
            // flash notification
            notifier()->success('Testimonial created successfully.');
        } else {
            // flash notification
            notifier()->error('Testimonial cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show testimonial.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // check if testimonial doesn't exists
        if (empty($testimonial)) {
            // flash notification
            notifier()->error('Testimonial not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::testimonial.show', compact('testimonial'));
    }

    /**
     * Show testimonial.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // check if testimonial doesn't exists
        if (empty($testimonial)) {
            // flash notification
            notifier()->error('Testimonial not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::testimonial.edit', compact('testimonial'));
    }

    /**
     * Update testimonial
     *
     * @param TestimonialUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TestimonialUpdateRequest $request, $id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // check if testimonial doesn't exists
        if (empty($testimonial)) {
            // flash notification
            notifier()->error('Testimonial not found!');
            // redirect back
            return redirect()->back();
        }
        // update testimonial
        $testimonial = $this->testimonialService->update($request->all(), $id);
        // upload files
        $testimonial->uploadFiles();
        // check if testimonial updated
        if ($testimonial) {
            // flash notification
            notifier()->success('Testimonial updated successfully.');
        } else {
            // flash notification
            notifier()->error('Testimonial cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete testimonial
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get testimonial
        $testimonial = $this->testimonialService->find($id);
        // check if testimonial doesn't exists
        if (empty($testimonial)) {
            // flash notification
            notifier()->error('Testimonial not found!');
            // redirect back
            return redirect()->back();
        }
        // delete testimonial
        if ($this->testimonialService->delete($id)) {
            // flash notification
            notifier()->success('Testimonial deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Testimonial cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
