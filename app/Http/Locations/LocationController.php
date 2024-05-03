<?php

namespace DDD\Http\Locations;

use Spatie\Url\Url;
use Illuminate\Http\Request;
use DDD\Domain\Locations\Resources\LocationResource;
use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Jobs\TakeLocationScreenshotJob;
use DDD\Domain\Locations\Actions\TakeLocationScreenshotAction;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\Actions\StoreFileFromUrlAction;
use DDD\App\Services\Screenshot\ScreenshotInterface;
use DDD\App\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return LocationResource::collection($locations);
    }

    public function store(Request $request)
    {
        $location = Location::create($request->all());

        return new LocationResource($location);
    }

    public function show(Location $location)
    {
        return new LocationResource($location);
    }
}
