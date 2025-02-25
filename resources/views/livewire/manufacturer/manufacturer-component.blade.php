@extends('components.layouts.app')

@section('title', 'Manufacturer')

@section('content')

    <div class="container">
        <div class="page-inner">
            <h3 class="fw-bold mb-3">Manufacturer</h3>
            @if (session('status') && session('message'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center mb-1">
                <div class="col-md-4 ps-md-0">
                    <h4 class="card-title  mb-5" align="center">Given tasks</h4>
                    <div class="card card-row card-secondary">
                        <div class="card-header">
                            <div class="card-price mb-3">
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse ($userProductions[0] ?? [] as $production)
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        {{ $production->id }}
                                    </div>
                                    <div class="card-body">
                                        <span>{{ $production->production->product->name }}</span> <br>
                                        <span>Given count: {{ $production->production->count }}</span> <br>
                                        <span>Defected: {{ $production->production->defected }}</span>
                                        <div class="text-end">
                                            <a href="{{ route('production.manufacturer.start', [$production->id, $production->production->id]) }}"
                                                class="btn btn-secondary btn-round">Start</a>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                No data
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ps-md-0 pe-md-0">
                    <h4 class="card-title  mb-5" align="center">In progress</h4>
                    <div class="card card-row card-info">
                        <div class="card-header">
                            <div class="card-price mb-3">
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse ($userProductions[1] ?? [] as $production)
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        {{ $production->id }}
                                    </div>
                                    <div class="card-body">
                                        <span>{{ $production->production->product->name }}</span> <br>
                                        <span>Given count: {{ $production->production->count }}</span> <br>
                                        <span>Defected: {{ $production->production->defected }}</span>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                                                data-bs-target="#production{{ $production->id }}">
                                                End Task
                                            </button>

                                            <div class="modal fade" id="production{{ $production->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $production->production->product->name }}
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('production.manufacturer.inProgress', [$production->id, $production->production->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="number" class="form-control"
                                                                    placeholder="Count of defected products" name="defect" max="{{ $production->production->count }}">
                                                            </form>
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
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No data
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pe-md-0">
                    <h4 class="card-title  mb-5" align="center">Done</h4>
                    <div class="card card-row card-success">
                        <div class="card-header">
                            <div class="card-price mb-3">
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse ($userProductions[2] ?? [] as $production)
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        {{ $production->id }}
                                    </div>
                                    <div class="card-body">
                                        <span>{{ $production->production->product->name }}</span> <br>
                                        <span>Given count: {{ $production->production->count }}</span> <br>
                                        <span>Defected: {{ $production->production->defected }}</span>
                                    </div>
                                </div>
                            @empty
                                No data
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
