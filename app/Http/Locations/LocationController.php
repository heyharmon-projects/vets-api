<?php

namespace DDD\Http\Locations;

use Illuminate\Http\Request;
use DDD\Domain\Locations\Resources\LocationResource;
use DDD\Domain\Locations\Location;
use DDD\App\Controllers\Controller;
use DDD\Domain\Locations\Actions\GetFaviconAction;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        // $north = $lat1_ne || 90;
        // $east = $lng1_ne;
        // $south = $lat2_sw || -90;
        // $west = $lng2_sw;

        // $locations = Location::whereBetween('lat', [$south, $north])
        //     ->where(function($query) use ($west, $east){
        //         if ($west < $east){
        //             $query->whereBetween('lon', [$west, $east]);
        //         }else{
        //             $query->whereBetween('lon', [$west, 180])
        //                 ->orWhereBetween('lon', [-180, $east]);
        //         }
        // })
        // ->get();

        $locations = Location::all();

        return LocationResource::collection($locations);
    }

    public function store(Request $request)
    {
        $location = Location::create($request->all());

        return new LocationResource($location);
    }

    public function update(Location $location, Request $request)
    {
        $location->update($request->all());

        return new LocationResource($location);
    }

    public function show(Location $location)
    {
        $location = $location->load('contacts');
        
        return new LocationResource($location);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return new LocationResource($location);
    }
}
