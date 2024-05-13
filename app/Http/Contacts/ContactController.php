<?php

namespace DDD\Http\Contacts;

use Illuminate\Http\Request;
use DDD\Domain\Locations\Location;
use DDD\Domain\Contacts\Resources\ContactResource;
use DDD\Domain\Contacts\Contact;
use DDD\App\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Location $location, Request $request)
    {
        $contacts = $location->contacts()->get();

        return ContactResource::collection($contacts);
    }

    public function store(Location $location, Request $request)
    {
        $contact = $location->contacts()->create($request->all());

        return new ContactResource($contact);
    }

    public function update(Location $location, Contact $contact, Request $request)
    {
        $contact->update($request->all());

        return new ContactResource($contact);
    }

    public function show(Location $location, Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function destroy(Location $location, Contact $contact)
    {
        $contact->delete();

        return new ContactResource($contact);
    }
}
