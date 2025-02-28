@extends('components.layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Customers</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.customer.create') }}" class="btn btn-primary btn-round">Add Customers</a>
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
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ ucfirst($customer->name) }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>Longitude: {{ $customer->longitude }} <br> Latitude: {{ $customer->latitude }}</td>
                            <td>
                                <a href="{{ route('hr.customer.edit', $customer->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('hr.customer.destroy', $customer->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;color: grey;">You have no customers yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
