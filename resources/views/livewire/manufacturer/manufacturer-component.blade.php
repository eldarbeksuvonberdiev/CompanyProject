@extends('components.layouts.app')

@section('title', 'Manufacturer')

@section('content')

    <div class="container">
        <div class="page-inner">
            <h3 class="fw-bold mb-3">Manufacturer</h3>
            <div class="row justify-content-center mb-1">
                <div class="col-md-4 ps-md-0">
                    <h4 class="card-title  mb-3" align="center">Given tasks</h4>
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
                                        <a href="{{ route('production.manufacturer.start', $production->id) }}" class="btn btn-secondary btn-round">Start</a>
                                    </div>
                                </div>

                            @empty
                                No data
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ps-md-0 pe-md-0">
                    <h4 class="card-title  mb-3" align="center">In progress</h4>
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
                                    </div>
                                </div>
                            @empty
                                No data
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pe-md-0">
                    <h4 class="card-title  mb-3" align="center">Done</h4>
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
