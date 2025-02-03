<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequests\PermissionUpdateRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function status(Permission $permission)
    {
        if ($permission->status == 1) {
            $permission->update(['status' => 0]);
        } else {
            $permission->update(['status' => 1]);
        }
        return back()->with([
            'status' => 'success',
            'message' => "$permission->name status has been changed!"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest, Permission $permission)
    {
        $permission->update($permissionUpdateRequest->validated());

        return back()->with([
            'status' => 'success',
            'message' => "$permission->name name has been changed!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
