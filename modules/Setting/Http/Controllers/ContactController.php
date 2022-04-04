<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Setting\Http\Requests\ContactUpdateRequest;

// services...
use Modules\Setting\Services\ContactService;

class ContactController extends Controller
{
    /**
     * @var $contactService
     */
    protected $contactService;

    /**
     * Constructor
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Contact list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // get contact data
        $contact = $this->contactService->firstOrCreate([]);
        // return view
        return view('setting::contact.index', compact('contact'));
    }

    /**
     * Update contact
     *
     * @param ContactUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactUpdateRequest $request, $id)
    {
        // get contact
        $contact = $this->contactService->find($id);
        // check if contact doesn't exists
        if (empty($contact)) {
            // flash notification
            notifier()->error('Contact not found!');
            // redirect back
            return redirect()->back();
        }
        // update contact
        $contact = $this->contactService->update($request->all(), $id);
        // check if contact updated
        if ($contact) {
            // flash notification
            notifier()->success('Contact updated successfully.');
        } else {
            // flash notification
            notifier()->error('Contact cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
