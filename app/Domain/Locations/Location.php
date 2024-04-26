<?php

namespace DDD\Domain\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;

class Location extends Model
{
    use HasFactory,
        HasSlug,
        BelongsToOrganization,
        BelongsToUser;

    protected $guarded = ['id', 'slug'];
}
