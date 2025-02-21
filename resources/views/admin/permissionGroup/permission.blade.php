@extends('components.layouts.app')

@section('title', 'Permission ' . $permissionGroup->name)

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ $permissionGroup->name }} Permissions</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.permissionGroup.index') }}" class="btn btn-primary btn-round">Back</a>
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
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ ucfirst($permission->name) }}</td>
                            <td>
                                <a href="{{ route('admin.permission.status', $permission->id) }}"
                                    class="btn btn-{{ $permission->status == 1 ? 'success' : 'danger' }} btn-round">{{ $permission->status == 1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-round" data-bs-toggle="modal"
                                    data-bs-target="#permission{{ $permission->id }}">
                                    Edit
                                </button>

                                <div class="modal fade" id="permission{{ $permission->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.permission.update', $permission->id) }}"
                                                    method="post">
                                                    @csrf @method('PUT')
                                                    <input type="text" value="{{ $permission->name }}" name="name"
                                                        class="form-control">
                                                    @error('name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-round"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-success btn-round"
                                                            type="submit">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
