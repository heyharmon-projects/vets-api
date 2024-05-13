<?php

namespace DDD\Domain\Base\Files\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\File;

class UpdateFileAction
{
    use AsAction;
    
    function handle(File $file, Request $request)
    {
        $disk = config('filesystems.default');
        
        // Store new file in storage
        $newPath = $request->file->store($file->folder, $disk);

        // Remove old file storage
        Storage::disk($disk)->delete($file->path);
        
        // Update file
        $file->update([
            'path' => $newPath,
            'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME),
            'filename' => basename($newPath),
            'extension' => $request->file->getClientOriginalExtension(),
            'disk' => $disk,
        ]);

        return $file;
    }
}