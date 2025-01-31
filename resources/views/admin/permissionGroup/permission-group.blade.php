@extends('main.main')

@section('title', 'Permission Groups')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Permission Group</h3>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissionGroups as $permissionGroup)
                        <tr>
                            <td>{{ $permissionGroup->id }}</td>
                            <td>{{ $permissionGroup->name }}</td>
                            <td>
                                <button
                                    class="btn btn-secondary btn-round">{{ count($permissionGroup->permissions) }}</button>
                            </td>
                            {{-- <td>
                                @forelse ($permissionGroup->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @empty
                                    Has no permissions yet
                                @endforelse
                            </td> --}}
                            <td>{{ $permissionGroup->status }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
