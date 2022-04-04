<?php

namespace Modules\Setting\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Setting\Services\ContactService;

// requests...
use Modules\Setting\Http\Requests\ContactStoreRequest;
use Modules\Setting\Http\Requests\ContactUpdateRequest;

// resources...
use Modules\Setting\Transformers\ContactResource;

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
     * Contact list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all contacts
        $contacts = $this->contactService->all(request()->get('limit') ?? 0);
        // if no contact found
        if (!count($contacts)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Contact not available.');
        }
        // transform contacts
        $contacts = ContactResource::collection($contacts);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($contacts);
    }

    /**
     * Store a contact.
     *
     * @param ContactStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        // create contact
        $contact = $this->contactService->create($request->all());
        // check if created
        if ($contact) {
            // transform contact
            $contact = ContactResource::make($contact);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Contact created successfully.')
                ->data($contact);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Contact cannot be created.');
        }
    }

    /**
     * Show contact.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get contact
        $contact = $this->contactService->find($id);
        // if no contact found
        if (empty($contact)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Contact not found.');
        }
        // transform contact
        $contact = ContactResource::make($contact);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Contact is available.')
            ->data($contact);
    }

    /**
     * Update contact.
     *
     * @param ContactUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, $id)
    {
        // get contact
        $contact = $this->contactService->find($id);
        // if no contact found
        if (empty($contact)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Contact not found.');
        }
        // update contact
        $contact = $this->contactService->update($request->all(), $id);
        // check if updated
        if ($contact) {
            // get updated contact
            $contact = $this->contactService->find($id);
            // transform contact
            $contact = ContactResource::make($contact);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Contact updated successfully.')
                ->data($contact);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Contact cannot be updated.');
        }
    }

    /**
     * Remove contact.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get contact
        $contact = $this->contactService->find($id);
        // if no contact found
        if (empty($contact)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Contact not found.');
        }
        // delete contact
        if ($this->contactService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Contact deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Contact cannot be deleted.');
        }
    }
}
