<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequests\RoleStoreRequest;
use App\Http\Requests\RoleRequests\RoleUpdateRequest;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('admin.role.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $roleStoreRequest)
    {
        // dd($roleStoreRequest->validated());
        $role = Role::create(['name' => $roleStoreRequest->name]);
        $role->permissions()->sync($roleStoreRequest->permissions ?? []);

        return redirect()->route('admin.role.index')->with([
            'status' => 'success',
            'message' => "$role->name role has been successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function status(Role $role)
    {
        if ($role->status == 1) {
            $role->update(['status' => 0]);
        } else {
            $role->update(['status' => 1]);
        }
        return back()->with([
            'status' => 'success',
            'message' => "$role->name status has been changed!"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return  view('admin.role.edit', compact('role', 'permissionGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role)
    {
        $role->update(['name' => $roleUpdateRequest->name]);

        $role->permissions()->sync($roleUpdateRequest->permissions ?? []);

        return redirect()->route('admin.role.index')->with([
            'status' => 'warning',
            'message' => "$role->name role has been successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $name = ucfirst($role->name);
        $role->delete();
        return back()->with([
            'status' => 'danger',
            'message' => "$name role has been successfully deleted"
        ]);
    }
}
