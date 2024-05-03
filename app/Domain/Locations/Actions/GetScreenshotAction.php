<?php

namespace DDD\Domain\Locations\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use DDD\Domain\Locations\Location;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Base\Files\Actions\StoreFileFromUrlAction;
use DDD\App\Services\Screenshot\ScreenshotInterface;

class GetScreenshotAction
{
    use AsAction;

    public function __construct(
        protected ScreenshotInterface $screenshotter,
    ) {}

    function handle(Location $location)
    {
        if (!$location->website) {
            return;
        }

        try {
            $url = $this->screenshotter->take($location->website, '1200', '1200');

            $file = StoreFileFromUrlAction::run($location->organization, $url);

            if ($location->screenshot()->exists()) {
                $location->screenshot()->delete();
            }
    
            $location->update([
                'screenshot_file_id' => $file->id,
            ]);
    
            return new FileResource($file);
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
