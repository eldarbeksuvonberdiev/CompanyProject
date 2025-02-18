@extends('main.main')

@section('title', 'Warehouses')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Warehouses</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.warehouse.create') }}" class="btn btn-primary btn-round">Add Warehouse</a>
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
                        <th>User</th>
                        <th>Status</th>
                        <th>Products</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->id }}</td>
                            <td>{{ ucfirst($warehouse->name) }}</td>
                            <td>{{ $warehouse->user->name }}</td>
                            <td>
                                <a href="{{ route('hr.warehouse.status', $warehouse->id) }}"
                                    class="btn btn-{{ $warehouse->status == 1 ? 'success' : 'danger' }} btn-round">{{ $warehouse->status == '1' ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td>
                                <a href="{{ $warehouse->status == 1 ? route('hr.warehouse.products', $warehouse->id) : '#' }}"
                                    class="btn btn-round btn-{{ $warehouse->status == 1 ? 'success' : 'danger' }}"
                                    style="{{ $warehouse->status == 1 ? '' : 'pointer-events: none; opacity: 0.6;' }}">
                                    {{ $warehouse->warehouseMaterials->count() }}
                                </a>

                            </td>
                            <td>
                                <a href="{{ route('hr.warehouse.edit', $warehouse->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('hr.warehouse.destroy', $warehouse->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;color: grey;">You have no warehouse yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
