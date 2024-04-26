<?php

namespace DDD\Http\Locations;

use DDD\Domain\Locations\Location;
use DDD\App\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function show(Location $location)
    {
        return $location;
    }
}
