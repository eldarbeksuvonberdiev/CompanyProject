@extends('components.layouts.app')

@section('title', 'Salary Create')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Salary Creation</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('hr.salary.index') }}" class="btn btn-primary btn-round">Back</a>
                </div>
            </div>
        </div>
        <div class="page-inner">
            <form action="{{ route('hr.salary.update', $salary->id) }}" method="post">
                @csrf @method('PUT')
                <div class="row">
                    <label for="name" class="mb-2"><strong>
                            <h5>Salary Name:</h5>
                        </strong></label>
                    <input type="text" name="name" id="name" class="form-control mb-3"
                        value="{{ $salary->name }}">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="ms-md-auto py-2 py-md-0" align='right'>
                    <button type="submimt" class="btn btn-primary btn-round">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
