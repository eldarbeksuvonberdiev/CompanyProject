@extends('main.main')

@section('title', 'User Create')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">User Create</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
