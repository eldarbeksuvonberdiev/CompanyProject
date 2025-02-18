@extends('main.main')

@section('title', 'Warehouse Products ' . $warehouse->name)

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ $warehouse->name }} Products</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.warehouse.index') }}" class="btn btn-primary btn-round">Back</a>
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
                        <th>Unit</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($warehouse->warehouseMaterials as $warehouseMaterial)
                        <tr>
                            <td>{{ $warehouseMaterial->id }}</td>
                            <td>{{ $warehouseMaterial->material->name }}</td>
                            <td>{{ $warehouseMaterial->material->deliveryNoteMaterials->first()->unit }}</td>
                            <td>{{ number_format($warehouseMaterial->value) }}</td>
                            <td>{{ $warehouseMaterial->material->deliveryNoteMaterials->first()->price }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                                    data-bs-target="#transfer{{ $warehouseMaterial->id }}">
                                    Transfer
                                </button>
                                <div class="modal fade" id="transfer{{ $warehouseMaterial->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Transfer</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('warehouse.warehouseMaterial.transfer', $warehouseMaterial->material_id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="">
                                                        <select class="form-control" name="to_id"
                                                            aria-label="Default select example">
                                                            @foreach ($warehouses as $warehousee)
                                                                <option value="{{ $warehousee->id }}">
                                                                    {{ $warehousee->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('to_id')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="">
                                                        <input type="number" name="amount" class="form-control mt-3"
                                                            placeholder="Enter the amount"
                                                            max="{{ (int) $warehouseMaterial->value }}" min="0">
                                                        @error('amount')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <span class="text-danger" style="margin-top: 0%;">The max amount
                                                            should be greater than
                                                            {{ number_format($warehouseMaterial->value) }}</span>
                                                        <input type="hidden" name="from_id" value="{{ $warehouse->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-round"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-round">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;color: grey;">You have no products yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
