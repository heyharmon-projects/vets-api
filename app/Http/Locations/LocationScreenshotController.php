<?php

namespace DDD\Http\Locations;

use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\GetScreenshotAction;
use DDD\App\Controllers\Controller;

class LocationScreenshotController extends Controller
{
    public function take(Location $location)
    {
        return GetScreenshotAction::run($location);
    }

    public function update(Location $location)
    {
        return GetScreenshotAction::run($location);
    }
}
