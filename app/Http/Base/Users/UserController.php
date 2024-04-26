<?php

namespace DDD\Http\Base\Users;

use Illuminate\Http\Request;
use DDD\Domain\Base\Users\User;
use DDD\Domain\Base\Users\Resources\UserResource;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

class UserController extends Controller
{
    public function index(Organization $organization)
    {
        $users = $organization->users()->latest()->get();

        return UserResource::collection($users);
    }

    // public function show(Organization $organization, User $user)
    // {
    //     return new UserResource($user);
    // }

    // public function update(Organization $organization, User $user, Request $request)
    // {
    //     $user->update($request->all());
    //
    //     return response()->json($user);
    // }

    // public function destroy(Organization $organization, User $user)
    // {
    //     $user->delete();
    //
    //     return new UserResource($user);
    // }
}
