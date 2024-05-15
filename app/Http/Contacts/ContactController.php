<?php

namespace DDD\Http\Contacts;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use DDD\Domain\Contacts\Resources\ContactResource;
use DDD\Domain\Contacts\Contact;
use DDD\App\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // $contacts = Contact::all();

        $contacts = QueryBuilder::for(Contact::class)
            ->allowedFilters(['location_id'])
            ->get();

        return ContactResource::collection($contacts);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());

        return new ContactResource($contact);
    }

    public function update(Contact $contact, Request $request)
    {
        $contact->update($request->all());

        return new ContactResource($contact);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return new ContactResource($contact);
    }
}
