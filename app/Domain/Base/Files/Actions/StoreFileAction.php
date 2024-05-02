<?php

namespace DDD\Domain\Base\Files\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use DDD\Domain\Base\Organizations\Organization;

class StoreFileAction
{
    use AsAction;
    
    function handle(Organization $organization, Request $request)
    {
        $disk = config('filesystems.default');
        
        $path = $request->file->store($organization->slug, $disk);

        $file = $organization->files()->create([
            'path' => $path,
            'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME),
            'filename' => basename($path),
            'extension' => $request->file->getClientOriginalExtension(),
            'disk' => $disk,
        ]);

        return $file;
    }
}