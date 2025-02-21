@extends('components.layouts.app')

@section('title', 'Employees')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Employees</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.employee.create') }}" class="btn btn-primary btn-round">Add Employee</a>
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
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Work Hours</th>
                        <th>Salary</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>Name: {{ $employee->name }} <br>Surname: {{ $employee->surname }}
                                <br>Father's name: {{ $employee->father_name }}
                            </td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->start_time }} <br> {{ $employee->end_time }}</td>
                            <td>{{ $employee->salary->name }}</td>
                            <td>
                                <a href="{{ route('hr.employee.edit', $employee->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('hr.employee.destroy', $employee->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="color: grey;" align="center">No employees yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
