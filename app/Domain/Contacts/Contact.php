<?php

namespace DDD\Domain\Contacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Phones\Phone;
use DDD\Domain\Locations\Location;
use DDD\App\Traits\BelongsToUser;

class Contact extends Model
{
    use HasFactory,
        BelongsToUser;

    protected $guarded = ['id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
