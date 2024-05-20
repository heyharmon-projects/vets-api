<?php

namespace DDD\Domain\Locations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Contacts\Resources\ContactResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'phone' => $this->phone,
            'phone_owner' => $this->phone_owner,
            'website' => $this->website,
            'description' => $this->description,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'employees' => $this->employees,
            'yelp_url' => $this->yelp_url,
            'screenshot' => new FileResource($this->screenshot),
            'favicon' => new FileResource($this->favicon),
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
            'favorite' => $this->favorite,
        ];
    }
}
