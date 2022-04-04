<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\FaqStoreRequest;
use Modules\Cms\Http\Requests\FaqUpdateRequest;

// datatable...
use Modules\Cms\DataTables\FaqDataTable;

// services...
use Modules\Cms\Services\FaqService;

class FaqController extends Controller
{
    /**
     * @var $faqService
     */
    protected $faqService;

    /**
     * Constructor
     *
     * @param FaqService $faqService
     */
    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * Faq list
     *
     * @param FaqDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(FaqDataTable $datatable)
    {
        return $datatable->render('cms::faq.index');
    }

    /**
     * Create faq
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::faq.create');
    }


    /**
     * Store faq
     *
     * @param FaqStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FaqStoreRequest $request)
    {
        // create faq
        $faq = $this->faqService->create($request->all());
        // check if faq created
        if ($faq) {
            // flash notification
            notifier()->success('Faq created successfully.');
        } else {
            // flash notification
            notifier()->error('Faq cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show faq.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // check if faq doesn't exists
        if (empty($faq)) {
            // flash notification
            notifier()->error('Faq not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::faq.show', compact('faq'));
    }

    /**
     * Show faq.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // check if faq doesn't exists
        if (empty($faq)) {
            // flash notification
            notifier()->error('Faq not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::faq.edit', compact('faq'));
    }

    /**
     * Update faq
     *
     * @param FaqUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqUpdateRequest $request, $id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // check if faq doesn't exists
        if (empty($faq)) {
            // flash notification
            notifier()->error('Faq not found!');
            // redirect back
            return redirect()->back();
        }
        // update faq
        $faq = $this->faqService->update($request->all(), $id);
        // check if faq updated
        if ($faq) {
            // flash notification
            notifier()->success('Faq updated successfully.');
        } else {
            // flash notification
            notifier()->error('Faq cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete faq
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // check if faq doesn't exists
        if (empty($faq)) {
            // flash notification
            notifier()->error('Faq not found!');
            // redirect back
            return redirect()->back();
        }
        // delete faq
        if ($this->faqService->delete($id)) {
            // flash notification
            notifier()->success('Faq deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Faq cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
