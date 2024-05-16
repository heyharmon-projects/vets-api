<?php

namespace DDD\Domain\Locations\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use DDD\Domain\Locations\Location;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Base\Files\Actions\StoreFileFromUrlAction;
use DDD\App\Services\Favicon\FaviconInterface;

class GetFaviconAction
{
    use AsAction;

    public function __construct(
        protected FaviconInterface $favicon,
    ) {}

    function handle(Location $location)
    {
        if (is_null($location->website)) {
            return;
        }

        try {
            $url = $this->favicon->take($location->website, 'small');

            $file = StoreFileFromUrlAction::run($url, 'favicons');

            if ($location->favicon()->exists()) {
                $location->favicon()->delete();
            }
    
            $location->favicon_file_id = $file->id;

            $location->save();
    
            return new FileResource($file);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
