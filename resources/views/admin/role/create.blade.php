@extends('main.main')

@section('title', 'Role Create')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Role Creation</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('admin.role.store') }}" method="post">
                @csrf
                <div class="row">
                    <label for="name" class="mb-2"><strong>
                            <h5>Role Name:</h5>
                        </strong></label>
                    <input type="text" name="name" id="name" class="form-control mb-3" placeholder="Role name">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @foreach ($permissionGroups as $group)
                        <h3>
                            <input type="checkbox" class="group-checkbox" data-group="{{ $group->id }}">
                            {{ $group->name }}
                        </h3>
                        <div class="row">
                            @foreach ($group->permissions as $permission)
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="permission-checkbox" data-group="{{ $group->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="ms-md-auto py-2 py-md-0" align='right'>
                    <button type="submimt" class="btn btn-primary btn-round">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
