@extends('main.main')

@section('title', 'Delivery Notes')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Delivery Notes</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#deliveryNote">
                        Add Delivery Note
                    </button>

                    <div class="modal fade" id="deliveryNote" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delivery Note</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="mt-2">
                                            <label for="Select warehouse" class="form-label">Select warehouse  btn-round</label>
                                            <select class="form-control" id="Select warehouse" aria-label="Default select example">
                                                <option>menu</option>
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <label for="file" class="form-label">Upload Excel file
                                                here</label>
                                            <input type="file" class="form-control" id="file"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary btn-round">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    {{-- @forelse ($salaries as $salary)
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
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
