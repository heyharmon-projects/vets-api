<?php

namespace DDD\Domain\Locations\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use DDD\Domain\Locations\Location;

class GetCoordinatesAction
{
    use AsAction;

    function handle(Location $location)
    {
        if (!is_null($location->latitude) && !is_null($location->longitude)) {
            return;
        }

        if (is_null($location->address_line_1)) {
            return;
        }

        try {
            $fullAddress = $location->address_line_1 . ', ' 
                . $location->address_line_2 . ', ' 
                . $location->city . ', ' 
                . $location->state . ', ' 
                . $location->zip . ', ' 
                . $location->country;
            
            $result = app('geocoder')->geocode($fullAddress)->get();
           
            if ($result->isNotEmpty()) {
                $coordinates = $result[0]->GetCoordinatesCommand();

                $location->latitude = $coordinates->getLatitude();
                $location->longitude = $coordinates->getLongitude();
                $location->save();

                return $coordinates;
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
