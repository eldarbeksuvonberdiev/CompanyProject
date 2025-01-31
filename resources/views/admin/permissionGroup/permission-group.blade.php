@extends('main.main')

@section('title', 'Permission Groups')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Permission Group</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-round">Add User</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>#</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
