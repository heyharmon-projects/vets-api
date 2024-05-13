<?php

namespace DDD\Domain\Contacts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use DDD\Domain\Base\Files\Resources\FileResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin_url' => $this->linkedin_url,
        ];
    }
}
