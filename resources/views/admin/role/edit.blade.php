@extends('components.layouts.app')

@section('title', 'Role Edit')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Role Edit</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                @csrf @method('PUT')
                <label for="name">Role Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                @foreach ($permissionGroups as $group)
                    <div class="row">
                        @php
                            $allChecked = $group->permissions->every(fn($p) => $role->permissions->contains($p->id));
                        @endphp

                        <h3>
                            <input type="checkbox" class="group-checkbox" data-group="{{ $group->id }}"
                                {{ $allChecked ? 'checked' : '' }}>
                            {{ $group->name }}
                        </h3>
                        <div class="row">
                            @foreach ($group->permissions as $permission)
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="permission-checkbox" data-group="{{ $group->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr style="width: 75%;margin: 20px auto;border: 1px solid #000;">
                @endforeach
                <div class="ms-md-auto py-2 py-md-0" align='right'>
                    <button type="submimt" class="btn btn-primary btn-round">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
