<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserController extends Controller
{
    protected User $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->all();
        if (empty($users)) {
            return response()->json(['msg' => 'Not Found Data']);
        }
        return response()->json([
            'status' => 'sucess',
            "all" => $users,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validate = $request->validated();
        $validate['password'] = bcrypt($validate['password']);
        $validate['confirmed'] = bcrypt($validate['confirmed']);
        $user = $this->user->create($validate);
        return response()->json([
            'status' => 'active',
            'data' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $user = $this->user->find($uuid);
        if (empty($user)) {
            return response()->json(["error" => "Not Found",], 404);
        }
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $uuid)
    {
        $user = $this->user->find($uuid);
        if (empty($user)) {
            return response()->json(["error" => "Not Found",], 404);
        }
        $validate = $request->validated();
        if ($request->getPassword()) {
            $validate['password'] = bcrypt($validate['password']);
        }
        $user->update($validate);
        return response()->json([
            'status' => 'updated successfully',
            "data" => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $uuid)
    {
        $user = $this->user->find($uuid);
        if (empty($user)) {
            return response()->json(["error" => "Not Found",], 404);
        }
        $user->delete();
        return response()->json([
            'status' => 'inactive',
            "data" => $user,
        ], 202);
    }
    public function restore(string $uuid)
    {
        $user = $this->user->withTrashed()->find($uuid);
        if (empty($user)) {
            return response()->json(["error" => "Not Found",], 404);
        }
        $user->restore();
        return response()->json([
            'status' => 'active',
            "data" => $user,
        ], 200);
    }
}
