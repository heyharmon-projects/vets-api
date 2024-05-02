<?php

namespace DDD\Http\Base\Files;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Base\Files\Requests\StoreFileRequest;
use DDD\Domain\Base\Files\File;
use DDD\Domain\Base\Files\Actions\StoreFileAction;
use DDD\App\Controllers\Controller;

class FileController extends Controller
{
    public function index(Organization $organization, Request $request)
    {
        $file = QueryBuilder::for(File::class)
            ->where('organization_id', $organization->id)
            ->latest()
            ->get();

        return FileResource::collection($file);
    }

    public function store(Organization $organization, StoreFileRequest $request)
    {
        $file = StoreFileAction::run($organization, $request);
        // $file = $action->handle($organization, $request);

        return new FileResource($file);
    }

    public function show(Organization $organization, File $file)
    {
        return new FileResource($file);
    }

    public function destroy(Organization $organization, File $file): JsonResponse
    {
        // Remove database record
        $file->delete();

        // Remove file from storage
        Storage::delete($file->path);

        return response()->json(['message' => 'File destroyed'], 200);
    }
}
