@extends('components.layouts.app')

@section('title', 'Productions')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Productions</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#productCreation">
                        Add Productions
                    </button>

                    <div class="modal fade" id="productCreation" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Productions</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('production.production.store') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product name</label>
                                            <select class="form-select" aria-label="Default select example" name="product">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input type="number" class="form-control mt-3" id="price" name="count"
                                                required placeholder="Count">
                                            @error('count')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <h4>Materials</h4>
                                        <div id="productionMaterials"></div>

                                        <button type="button" class="btn btn-success btn-round my-2" id="machine">Add
                                            Material</button>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-round"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-round">Save changes</button>
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
                        <th>Product name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productions as $production)
                        <tr>
                            <td>{{ $production->id }}</td>
                            <td>{{ ucfirst($production->product->name) }}</td>
                            <td>
                                @switch($production->status)
                                    @case(0)
                                        <button type="button" class="btn btn-info btn-round" data-bs-toggle="modal"
                                            data-bs-target="#productionStatus{{ $production->id }}">
                                            Given
                                        </button>
                                    @break

                                    @case(1)
                                        <button type="button" class="btn btn-warning btn-round" data-bs-toggle="modal"
                                            data-bs-target="#productionStatus{{ $production->id }}">
                                            In Progess
                                        </button>
                                    @break

                                    @case(2)
                                        <button type="button" class="btn btn-success btn-round" data-bs-toggle="modal"
                                            data-bs-target="#productionStatus{{ $production->id }}">
                                            Done
                                        </button>
                                    @break

                                    @default
                                @endswitch
                                <div class="modal fade" id="productionStatus{{ $production->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Machine</th>
                                                                <th>User</th>
                                                                <th>Count</th>
                                                                <th>Defected</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($production->machineProductions as $machineProduction)
                                                                <tr>
                                                                    <td>{{ $machineProduction->machine->name }}</td>
                                                                    <td>{{ $machineProduction->user()?->name ?? 'No User' }}
                                                                    </td>
                                                                    <td>{{ $machineProduction->count }}</td>
                                                                    <td>{{ $machineProduction->defected }}</td>
                                                                    <td>
                                                                        @php
                                                                            $statusClass = match (
                                                                                $machineProduction->status
                                                                            ) {
                                                                                0 => 'info',
                                                                                1 => 'warning',
                                                                                default => 'success',
                                                                            };

                                                                            $statusText = match (
                                                                                $machineProduction->status
                                                                            ) {
                                                                                0 => 'Given',
                                                                                1 => 'In Progress',
                                                                                default => 'Done',
                                                                            };
                                                                        @endphp

                                                                        <button
                                                                            class="btn btn-{{ $statusClass }} btn-round">{{ $statusText }}</button>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6">This production has no machine and
                                                                        users</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-round"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary btn-round">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;color: grey;">You have no products yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('machine').addEventListener('click', function() {
            let container = document.getElementById("productionMaterials");
            let index = container.children.length;

            let materialRow = document.createElement('div');
            materialRow.classList.add('d-flex', 'gap-2', 'mb-2');

            materialRow.innerHTML = `
                <select name="production[${index}][id]" class="form-control" required>
                    <option value="">Select machine</option>
                    @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                    @endforeach
                </select>
                <select name="production[${index}][user]" class="form-control" required>
                    <option value="">Select user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger btn-round removeMachine">Delete</button>
            `;

            container.appendChild(materialRow);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('removeMachine')) {
                event.target.closest('div').remove();
            }
        });
    </script>
@endsection
