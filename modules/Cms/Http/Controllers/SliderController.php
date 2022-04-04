<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\SliderStoreRequest;
use Modules\Cms\Http\Requests\SliderUpdateRequest;

// datatable...
use Modules\Cms\DataTables\SliderDataTable;

// services...
use Modules\Cms\Services\SliderService;

class SliderController extends Controller
{
    /**
     * @var $sliderService
     */
    protected $sliderService;

    /**
     * Constructor
     *
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Slider list
     *
     * @param SliderDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(SliderDataTable $datatable)
    {
        return $datatable->render('cms::slider.index');
    }

    /**
     * Create slider
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::slider.create');
    }


    /**
     * Store slider
     *
     * @param SliderStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderStoreRequest $request)
    {
        // create slider
        $slider = $this->sliderService->create($request->all());
        // upload files
        $slider->uploadFiles();
        // check if slider created
        if ($slider) {
            // flash notification
            notifier()->success('Slider created successfully.');
        } else {
            // flash notification
            notifier()->error('Slider cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show slider.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // check if slider doesn't exists
        if (empty($slider)) {
            // flash notification
            notifier()->error('Slider not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::slider.show', compact('slider'));
    }

    /**
     * Show slider.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // check if slider doesn't exists
        if (empty($slider)) {
            // flash notification
            notifier()->error('Slider not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::slider.edit', compact('slider'));
    }

    /**
     * Update slider
     *
     * @param SliderUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SliderUpdateRequest $request, $id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // check if slider doesn't exists
        if (empty($slider)) {
            // flash notification
            notifier()->error('Slider not found!');
            // redirect back
            return redirect()->back();
        }
        // upload files
        $slider->uploadFiles();
        // update slider
        $slider = $this->sliderService->update($request->all(), $id);
        // check if slider updated
        if ($slider) {
            // flash notification
            notifier()->success('Slider updated successfully.');
        } else {
            // flash notification
            notifier()->error('Slider cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete slider
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get slider
        $slider = $this->sliderService->find($id);
        // check if slider doesn't exists
        if (empty($slider)) {
            // flash notification
            notifier()->error('Slider not found!');
            // redirect back
            return redirect()->back();
        }
        // delete slider
        if ($this->sliderService->delete($id)) {
            // flash notification
            notifier()->success('Slider deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Slider cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
