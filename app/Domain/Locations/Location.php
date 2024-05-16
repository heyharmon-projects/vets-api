<?php

namespace DDD\Domain\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Locations\Actions\GetScreenshotAction;
use DDD\Domain\Locations\Actions\GetFaviconAction;
use DDD\Domain\Locations\Actions\GetCoordinatesAction;
use DDD\Domain\Contacts\Contact;
use DDD\Domain\Base\Files\File;
use DDD\Domain\Base\Files\Actions\UpdateFileAction;
use DDD\Domain\Base\Files\Actions\StoreFileAction;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Casts\DomainCast;

class Location extends Model
{
    use HasFactory,
        HasSlug,
        BelongsToUser;

    protected $guarded = ['id', 'slug'];

    protected $casts = [
        'website' => DomainCast::class,
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function (Location $location) {
            GetScreenshotAction::dispatch($location);
            GetFaviconAction::dispatch($location);
            GetCoordinatesAction::dispatch($location);
        });

        self::deleted(function (Location $location) {
            $location->screenshot()->delete();
            $location->favicon()->delete();
            $location->contacts()->delete();
        });

        // self::updated(function (Location $location) {
        //     if (request()->screenshot) {
        //         if ($location->screenshot) {
        //             UpdateFileAction::run($location->screenshot, request()->file);
        //         } else {
        //             $file = StoreFileAction::run(request()->file, 'screenshots');
        //             $location->update(['screenshot_file_id' => $file->id]);
        //         }
        //     }
        // });
    }

    public function screenshot()
    {
        return $this->belongsTo(File::class, 'screenshot_file_id');
    }

    public function favicon()
    {
        return $this->belongsTo(File::class, 'favicon_file_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
