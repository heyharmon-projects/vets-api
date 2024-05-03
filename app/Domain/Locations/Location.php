<?php

namespace DDD\Domain\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Locations\Actions\TakeLocationScreenshotAction;
use DDD\Domain\Base\Files\File;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Casts\DomainCast;
use DDD\Domain\Locations\Actions\GetCoordinatesAction;

class Location extends Model
{
    use HasFactory,
        HasSlug,
        BelongsToOrganization,
        BelongsToUser;

    protected $guarded = ['id', 'slug'];

    protected $casts = [
        'website' => DomainCast::class,
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function (Location $location) {
            GetCoordinatesAction::dispatch($location);
            TakeLocationScreenshotAction::dispatch($location);
        });
    }

    public function screenshot()
    {
        return $this->belongsTo(File::class, 'screenshot_file_id');
    }
}
