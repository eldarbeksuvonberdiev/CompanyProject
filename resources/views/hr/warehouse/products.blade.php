@extends('main.main')

@section('title', 'Warehouse Products ' . $warehouse->name)

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Delivery Notes {{ $warehouse->name }}</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('warehouse.delivery-notes.index') }}" class="btn btn-primary btn-round">Back</a>
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
                        <th>Material name</th>
                        <th>Deliery Note Company name</th>
                        <th>Unit</th>
                        <th>Amount</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($deliveryNoteMaterials->materialDeliveryNotes as $deliveryNoteMaterial)
                        <tr>
                            <td>{{ $deliveryNoteMaterial->id }}</td>
                            <td>{{ $deliveryNoteMaterial->material->name }}</td>
                            <td>{{ $deliveryNote->company_name }}</td>
                            <td>{{ $deliveryNoteMaterial->unit }}</td>
                            <td>{{ $deliveryNoteMaterial->amount }}</td>
                            <td>{{ $deliveryNoteMaterial->price }}</td>
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
