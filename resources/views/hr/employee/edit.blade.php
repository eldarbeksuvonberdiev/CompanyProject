@extends('components.layouts.app')

@section('title', 'Employee Edit')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Employee Edit</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.employee.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('hr.employee.update', $employee->id) }}" method="post">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div>
                            <label for="name" class="mb-2"><strong>
                                    <h5>Name</h5>
                                </strong></label>
                            <input type="text" name="name" id="name" class="form-control mb-3"
                                value="{{ $employee->name }}">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="surname" class="mb-2"><strong>
                                    <h5>Surname</h5>
                                </strong></label>
                            <input type="text" name="surname" id="surname" class="form-control mb-3"
                                value="{{ $employee->surname }}">
                            @error('surname')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="father_name" class="mb-2"><strong>
                                    <h5>Father's name</h5>
                                </strong></label>
                            <input type="text" name="father_name" id="father_name" class="form-control mb-3"
                                value="{{ $employee->father_name }}">
                            @error('father_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="user_id" class="mb-2"><strong>
                                    <h5>User for employee</h5>
                                </strong></label>
                            <select class="form-control" aria-label="Default select example">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $employee->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <label for="phone" class="mb-2"><strong>
                                    <h5>Phone</h5>
                                </strong></label>
                            <input type="integer" name="phone" id="phone" class="form-control mb-3"
                            value="{{ $employee->phone }}">
                            @error('phone')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="mb-2"><strong>
                                    <h5>Address</h5>
                                </strong></label>
                            <input type="text" name="address" id="address" class="form-control mb-3"
                            value="{{ $employee->address }}">
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="start_time" class="mb-2"><strong>
                                        <h5>Work start time</h5>
                                    </strong></label>
                                <input type="time" name="start_time" id="start_time" class="form-control mb-3" value="{{ $employee->start_time }}">
                                @error('start_time')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="end_time" class="mb-2"><strong>
                                        <h5>Work end time</h5>
                                    </strong></label>
                                <input type="time" name="end_time" id="end_time" class="form-control mb-3" value="{{ $employee->end_time }}">
                                @error('end_time')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="salary_id" class="mb-2"><strong>
                                    <h5>Emlployee salary type</h5>
                                </strong></label>
                            <select class="form-control" id="salary_id" aria-label="Default select example"
                                name="salary_id">
                                <option></option>
                                @foreach ($salaries as $salary)
                                    <option value="{{ $salary->id }}"
                                        {{ $employee->salary_id == $salary->id ? 'selected' : '' }}>{{ $salary->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('salary_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="ms-md-auto py-2 py-md-0 mt-3" align='right'>
                    <button type="submimt" class="btn btn-primary btn-round">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
