@extends('components.layouts.app')

@section('title', 'User Edit')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">User Edit</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                @csrf @method('PUT')
                <div>
                    <label for="name" class="mb-2"><strong>
                            <h5>Name</h5>
                        </strong></label>
                    <input type="text" name="name" id="name" class="form-control mb-3" value={{ $user->name }}>
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="email" class="mb-2"><strong>
                            <h5>Email</h5>
                        </strong></label>
                    <input type="email" name="email" id="email" class="form-control mb-3" value={{ $user->email }}>
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="mb-2"><strong>
                            <h5>Password</h5>
                        </strong></label>
                    <input type="password" name="password" id="password" class="form-control mb-3" placeholder="New Password">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="ms-md-auto py-2 py-md-0" align='right'>
                    <button type="submimt" class="btn btn-primary btn-round">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
