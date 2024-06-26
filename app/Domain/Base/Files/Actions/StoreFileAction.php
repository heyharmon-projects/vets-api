<?php

namespace DDD\Domain\Base\Files\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use DDD\Domain\Base\Files\File;

class StoreFileAction
{
    use AsAction;
    
    function handle($file, String $folder)
    {
        $disk = config('filesystems.default');
        
        $path = $file->store($folder, $disk);

        $newFile = File::create([
            'path' => $path,
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'filename' => basename($path),
            'extension' => $file->getClientOriginalExtension(),
            'disk' => $disk,
        ]);

        return $newFile;
    }
}