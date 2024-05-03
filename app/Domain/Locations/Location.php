<?php

namespace DDD\Domain\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Locations\Actions\GetScreenshotAction;
use DDD\Domain\Locations\Actions\GetCoordinatesAction;
use DDD\Domain\Base\Files\File;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Casts\DomainCast;

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
            GetScreenshotAction::run($location);
            GetCoordinatesAction::run($location);
        });
    }

    public function screenshot()
    {
        return $this->belongsTo(File::class, 'screenshot_file_id');
    }
}
