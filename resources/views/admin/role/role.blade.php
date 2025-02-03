@extends('main.main')

@section('title', 'Roles')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Roles</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-round">Add Role</a>
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
                        <th>Permissions</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ ucfirst($role->name) }}</td>
                            <td>
                                <button class="btn btn-secondary btn-round">{{ count($role->permissions) }}</button>
                            </td>
                            <td>
                                <a href="{{ route('admin.role.status.update', $role->id) }}"
                                    class="btn btn-{{ $role->status == 1 ? 'success' : 'danger' }} btn-round">{{ $role->status == 1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.role.edit', $role->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.role.destroy', $role->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;color: grey;">You have no roles yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
