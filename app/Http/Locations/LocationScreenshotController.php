<?php

namespace DDD\Http\Locations;

use Illuminate\Http\Request;
use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\GetScreenshotAction;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Base\Files\Actions\UpdateFileAction;
use DDD\Domain\Base\Files\Actions\StoreFileAction;
use DDD\App\Controllers\Controller;

class LocationScreenshotController extends Controller
{
    public function takeScreenshot(Location $location)
    {
        return GetScreenshotAction::run($location);
    }

    // public function store(Location $location, Request $request)
    // {
    //     $file = StoreFileAction::run($request->file, 'screenshots');

    //     $location->update([
    //         'screenshot_id' => $file->id,
    //     ]);

    //     return new FileResource($file);
    // }

    // public function update(Location $location, Request $request)
    // {
    //     return 'Yolo fam';
    //     $file = UpdateFileAction::run($location->screenshot, $request->file);

    //     return new FileResource($file);
    // }
}
