@extends('productlayout')

@section('content')
    <div>
        <h3 align="center" class="mt-5">Products</h3>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-area">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="productname">Product Name</label>
                                <input type="text" id="productname" class="form-control" name="productname">
                            </div>

                            <div class="col-md-6">
                                <label for="cat_id">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="description">Description</label>
                                <input type="text" id="description" class="form-control" name="description">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" class="form-control" name="stock" min="0">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="price">Price</label>
                                <input type="text" id="price" class="form-control" name="price">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="photo">Image</label>
                                <input type="file" id="photo" class="form-control" name="photo">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="size">Size</label>
                                <input type="text" id="size" class="form-control" name="size">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->productname }}</td>
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->size }}</td>
                                    <td>
                                        <img src="{{ $product->photo ? asset('images/' . $product->photo) : asset('images/default.jpg') }}" 
                                            alt="Product Image" width="100">
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .form-area {
        padding: 20px;
        margin-top: 70px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .btn-sm {
        font-size: 14px;
        margin: 0 5px;
    }
</style>
@endpush