@extends('main.main')

@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Users</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-round">Add User</a>
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
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->roles->first()->name ?? 'Has no role yet' }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
