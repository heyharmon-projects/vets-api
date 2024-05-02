<?php

namespace DDD\Http\Locations;

use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\TakeLocationScreenshotAction;
use DDD\App\Controllers\Controller;

class LocationScreenshotController extends Controller
{
    public function take(Location $location)
    {
        return TakeLocationScreenshotAction::run($location);
    }
}
