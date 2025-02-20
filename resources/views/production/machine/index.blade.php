@extends('main.main')

@section('title', 'Machines')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Machines</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#machineCreate">
                        Add Machine
                    </button>

                    <div class="modal fade" id="machineCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Machine creation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('production.machine.store') }}" method="post">
                                        @csrf
                                        <input type="text" class="form-control" placeholder="Name" name="name">
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
                        <th>Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($machines as $machine)
                        <tr>
                            <td>{{ $machine->id }}</td>
                            <td>{{ ucfirst($machine->name) }}</td>
                            <td> <a href="{{ route('production.machine.status', $machine->id) }}"
                                    class="btn btn-{{ $machine->status == 1 ? 'success' : 'danger' }} btn-round">{{ $machine->status == 1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-round" data-bs-toggle="modal"
                                    data-bs-target="#machineEdit{{ $machine->id }}">
                                    Edit
                                </button>

                                <div class="modal fade" id="machineEdit{{ $machine->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Machine creation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('production.machine.update', $machine->id) }}"
                                                    method="post">
                                                    @csrf @method('PUT')
                                                    <input type="text" class="form-control" value={{ $machine->name }}
                                                        name="name">
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
                            <td>
                                <form action="{{ route('production.machine.destroy', $machine->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;color: grey;">You have no machines yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
