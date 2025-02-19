@extends('main.main')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Products</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                        data-bs-target="#productCreation">
                        Add Product
                    </button>

                    <div class="modal fade" id="productCreation" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('production.product.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required placeholder="Name">
                                            @error('name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input type="number" class="form-control mt-3" id="price" name="price"
                                                required placeholder="Price">
                                            @error('price')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input type="file" class="form-control mt-3" id="image" name="image"
                                                required>
                                            @error('image')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <h4>Materials</h4>
                                        <div id="materialsContainer"></div>

                                        <button type="button" class="btn btn-success btn-round my-2" id="addMaterial">Add
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
                        <th>Name</th>
                        <th>Image</th>
                        <th>Ingredients</th>
                        <th>Update</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ ucfirst($product->name) }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>
                                <a href="{{ route('hr.product.status', $product->id) }}"
                                    class="btn btn-{{ $product->status == 1 ? 'success' : 'danger' }} btn-round">{{ $product->status == '1' ? 'Active' : 'Inactive' }}</a>
                            </td>


                            </td>
                            <td>
                                <a href="{{ route('hr.warehouse.edit', $product->id) }}"
                                    class="btn btn-warning btn-round">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('hr.warehouse.destroy', $product->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;color: grey;">You have no products yet!</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('addMaterial').addEventListener('click', function() {
            let container = document.getElementById("materialsContainer");
            let index = container.children.length;

            let materialRow = document.createElement('div');
            materialRow.classList.add('d-flex', 'gap-2', 'mb-2');

            materialRow.innerHTML = `
                <select name="materials[${index}][id]" class="form-control" required>
                    <option value="">Material tanlang</option>
                    @foreach ($materials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="materials[${index}][quantity]" class="form-control" placeholder="Miqdor" min="1" required>
                <button type="button" class="btn btn-danger btn-round removeMaterial">O'chirish</button>
            `;

            container.appendChild(materialRow);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('removeMaterial')) {
                event.target.closest('div').remove();
            }
        });
    </script>
@endsection
