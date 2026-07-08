<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {
    }

    public function index()
    {
        return $this->success(
            UserResource::collection(
                $this->service->all()
            ),
            'Users retrieved successfully'
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new UserResource($user),
            'User created successfully'
        );
    }

    public function show(int $id)
    {
        $user = $this->service->find($id);

        return $this->success(
            new UserResource($user),
            'User retrieved successfully'
        );
    }

    public function update(
        StoreUserRequest $request,
        int $id
    ) {
        $user = $this->service->find($id);

        $user = $this->service->update(
            $user,
            $request->validated()
        );

        return $this->success(
            new UserResource($user),
            'User updated successfully'
        );
    }

    public function destroy(int $id)
    {
        $user = $this->service->find($id);

        $this->service->delete($user);

        return $this->success(
            null,
            'User deleted successfully'
        );
    }
}
