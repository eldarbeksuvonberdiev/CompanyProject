@extends('components.layouts.app')

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
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ ucfirst($product->name) }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="" style="width: 75px;">
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                                    data-bs-target="#ingredient{{ $product->id }}">
                                    Ingredients
                                </button>

                                <div class="modal fade" id="ingredient{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Product Ingredients</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($product->materials as $material)
                                                    <li>{{ ucfirst($material->name) }} - {{ $material->pivot->value }}
                                                        {{ $material->pivot->unit }}</li>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>

                                <button type="button" class="btn btn-warning btn-round" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $product->id }}">
                                    Edit
                                </button>

                                <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('production.product.update', $product->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Product name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required value="{{ $product->name }}">
                                                        @error('name')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                        <label for="price" class="form-label mt-3">Price</label>
                                                        <input type="number" class="form-control" id="price"
                                                            name="price" required value="{{ $product->price }}">
                                                        @error('price')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                        <div class="row mt-3">
                                                            <div class="col-4">
                                                                <img src="{{ asset($product->image) }}" alt=""
                                                                    style="width: 55px;">
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="file" class="form-control mt-3"
                                                                    id="image" name="image">
                                                                @error('image')
                                                                    <div class="text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4 class="mt-4">Materials</h4>
                                                    <div id="materialsContainerEdit">
                                                        @foreach ($product->materials as $index => $material)
                                                            <div
                                                                class="material-item d-flex align-items-center gap-2 mt-2">
                                                                <select name="materials[{{ $index }}][id]"
                                                                    class="form-control" required>
                                                                    <option value="">Material tanlang</option>
                                                                    @foreach ($materials as $mat)
                                                                        <option value="{{ $mat->id }}"
                                                                            {{ $mat->id == $material->id ? 'selected' : '' }}>
                                                                            {{ $mat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                <input type="number"
                                                                    name="materials[{{ $index }}][quantity]"
                                                                    class="form-control"
                                                                    value="{{ $material->pivot->value }}" required>

                                                                <button type="button"
                                                                    class="btn btn-danger btn-round removeMaterial">O'chirish</button>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button type="button" class="btn btn-success btn-round my-2"
                                                        id="addComponent">Add Material</button>

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
                                <form action="{{ route('production.product.destroy', $product->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-round">Delete</button>
                                </form>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let materialIndex = document.querySelectorAll("#materialsContainerEdit .material-item").length || 0;
            const addComponentBtn = document.getElementById("addComponent");
            const materialsContainer = document.getElementById("materialsContainerEdit");

            addComponentBtn.addEventListener("click", function() {
                materialIndex++;
                const materialHtml = `
            <div class="material-item d-flex align-items-center gap-2 mt-2">
                <select name="materials[${materialIndex}][id]" class="form-control" required>
                    <option value="">Material tanlang</option>
                    ${materialsOptions()}
                </select>
                <input type="number" name="materials[${materialIndex}][quantity]" class="form-control" placeholder="Value" min="1" required>
                <button type="button" class="btn btn-danger btn-round removeMaterial">O'chirish</button>
            </div>
        `;
                materialsContainer.insertAdjacentHTML("beforeend", materialHtml);
            });

            materialsContainer.addEventListener("click", function(event) {
                if (event.target.classList.contains("removeMaterial")) {
                    event.target.closest(".material-item").remove();
                }
            });

            function materialsOptions() {
                let options = "";
                const materialsSelect = document.querySelector("#materialsContainerEdit select");
                if (materialsSelect) {
                    materialsSelect.querySelectorAll("option").forEach(option => {
                        if (option.value !== "") {
                            options += `<option value="${option.value}">${option.textContent}</option>`;
                        }
                    });
                }
                return options;
            }
        });
    </script>
@endsection
