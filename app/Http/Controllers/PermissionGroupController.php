<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $response = Http::get('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');
        // if ($response->successful()) {
        //     $data = $response->json();
        //     dd($data);
        // }
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('admin.permissionGroup.permission-group', compact('permissionGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function permissions(PermissionGroup $permissionGroup)
    {
        $permissions = $permissionGroup->permissions()->get();
        // dd($permissionGroup, $permissions);
        return view('admin.permissionGroup.permission', compact('permissionGroup', 'permissions'));
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
    public function show(PermissionGroup $permissionGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermissionGroup $permissionGroup)
    {
        if ($permissionGroup->status == 1) {
            $permissionGroup->update(['status' => 0]);
            $permissionGroup->permissions()->update(['status' => 0]);
        } else {
            $permissionGroup->update(['status' => 1]);
            $permissionGroup->permissions()->update(['status' => 1]);
        }
        return back()->with([
            'status' => 'success',
            'message' => "$permissionGroup->name status has been changed!"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PermissionGroup $permissionGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermissionGroup $permissionGroup)
    {
        //
    }
}
