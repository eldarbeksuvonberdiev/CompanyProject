@extends('main.main')

@section('title', 'Permission Groups')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Permission Groups</h3>
                </div>
            </div>
            @if (session('status') && session('message'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="page-inner">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissionGroups as $permissionGroup)
                        <tr>
                            <td>{{ $permissionGroup->id }}</td>
                            <td>{{ ucfirst($permissionGroup->name) }}</td>
                            <td>
                                <a href="{{ route('admin.permission.permissions', $permissionGroup->id) }}"
                                    class="btn btn-secondary btn-round">{{ count($permissionGroup->permissions) }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.permissionGroup.edit', $permissionGroup->id) }}"
                                    class="btn btn-{{ $permissionGroup->status == 1 ? 'success' : 'danger' }} btn-round">{{ $permissionGroup->status == 1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="color:grey;" align="center">No permission groups here</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
