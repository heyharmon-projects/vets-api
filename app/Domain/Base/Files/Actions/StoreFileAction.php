<?php

namespace DDD\Domain\Base\Files\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\File;

class StoreFileAction
{
    use AsAction;
    
    function handle(Request $request)
    {
        $disk = config('filesystems.default');
        
        $path = $request->file->store($request->folder, $disk);

        $file = File::create([
            'path' => $path,
            'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME),
            'filename' => basename($path),
            'extension' => $request->file->getClientOriginalExtension(),
            'disk' => $disk,
        ]);

        return $file;
    }
}