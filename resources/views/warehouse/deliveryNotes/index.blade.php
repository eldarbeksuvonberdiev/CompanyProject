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
                                    <form action="{{ route('warehouse.delivery-notes.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mt-2">
                                            <label for="Select warehouse" class="form-label">Select warehouse</label>
                                            <select class="form-control" id="Select warehouse"
                                                aria-label="Default select example" name="warehouse_id">
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('warehouse_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-2">
                                            <label for="file" class="form-label">Upload Excel file
                                                here</label>
                                            <input type="file" class="form-control" name="file" id="file"
                                                accept=".xls, .xlsx, .csv">
                                            @error('file')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-round"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-round">Save</button>
                                        </div>
                                    </form>
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
                        <th>Date</th>
                        <th>Delivery Note Products</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deliveryNotes as $deliveryNote)
                        <tr>
                            <td>{{ $deliveryNote->id }}</td>
                            <td>{{ ucfirst($deliveryNote->company_name) }}</td>
                            <td>{{ \Carbon\Carbon::parse($deliveryNote->date)->format('F d, Y') }}</td>
                            <td>
                                <a href="{{ route('warehouse.delivery-notes.show', $deliveryNote->id) }}"
                                    class="btn btn-warning btn-round"><i class="bi bi-eye"></i> See</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;color: grey;">You have no Delivery Notes yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
