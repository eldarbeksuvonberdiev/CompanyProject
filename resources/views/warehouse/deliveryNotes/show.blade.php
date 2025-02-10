@extends('main.main')

@section('title', 'Delivery Notes ' . $deliveryNote->company_name)

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Delivery Notes {{ $deliveryNote->company_name }}</h3>
                </div>
            </div>
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
                    {{-- @forelse ($deliveryNotes as $deliveryNote)
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
                            <td colspan="5" style="text-align: center;color: grey;">You have no DeliveryNotes yet!</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
