@extends('components.layouts.app')

@section('title', 'Salaries')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Salaries</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.salary.create') }}" class="btn btn-primary btn-round">Add Salary type</a>
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
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->id }}</td>
                            <td>{{ ucfirst($salary->name) }}</td>
                            <td>
                                <a href="{{ route('hr.salary.edit', $salary->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('hr.salary.destroy', $salary->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;color: grey;">You have no salarys yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
