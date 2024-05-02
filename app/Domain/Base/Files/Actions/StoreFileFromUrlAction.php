<?php

namespace DDD\Domain\Base\Files\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\File;

class StoreFileFromUrlAction
{
    use AsAction;
    
    function handle(Organization $organization, String $url)
    {
        $disk = config('filesystems.default');
        
        $name = basename($url);

        Storage::put($organization->slug . '/' . $name, file_get_contents($url));

        $path = Storage::path($organization->slug . '/' . $name);

        $file = $organization->files()->create([
            'path' => $path,
            'name' => $name,
            'filename' => basename($path),
            'extension' => pathinfo($path, PATHINFO_EXTENSION),
            'disk' => $disk,
        ]);

        return $file;
    }
}