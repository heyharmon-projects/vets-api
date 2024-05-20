<?php

namespace DDD\Domain\Phones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Phones\Casts\PhoneCast;
use DDD\Domain\Contacts\Contact;

class Phone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'number' => PhoneCast::class,
    ];

    public function contact()
    {
        return $this->belongsTo(contact::class);
    }
}
