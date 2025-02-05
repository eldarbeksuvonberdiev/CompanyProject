@extends('main.main')

@section('title', 'Warehouse Create')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Warehouse Creation</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.warehouse.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('hr.warehouse.store') }}" method="post">
                @csrf
                <div>
                    <label for="name" class="mb-2"><strong>
                            <h5>Warehouse Name:</h5>
                        </strong></label>
                    <input type="text" name="name" id="name" class="form-control mb-3"
                        placeholder="warehouse name">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user_id" class="mb-2"><strong>
                            <h5>User</h5>
                        </strong></label>
                    <select class="form-control" id="user_id" aria-label="Default select example" name="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
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
