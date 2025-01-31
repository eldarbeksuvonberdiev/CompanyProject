<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Requests\UserRequests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.user.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.user-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $userStoreRequest)
    {
        $user = User::create($userStoreRequest->validated());
        return redirect()->route('admin.user.index')->with([
            'status' => 'success',
            'message' => "$user->name user has been successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function status(User $user)
    {
        if ($user->status == 1) {
            $user->update(['status' => 0]);
        } else {
            $user->update(['status' => 1]);
        }
        return back()->with([
            'status' => 'success',
            'message' => "$user->name status has been changed!"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        $validatedData = $userUpdateRequest->validated();

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('admin.user.index')->with([
            'status' => 'success',
            'message' => 'User has been successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.user.index')->with([
            'status' => 'danger',
            'message' => "$name user has been successfully deleted"
        ]);
    }
}
