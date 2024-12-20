@extends('productlayout')
@section('content')
    <div>
        <h3 align="center" class="mt-5">Edit Product</h3>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-area">
                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="productname" value="{{ old('productname', $product->productname) }}">
                            </div>

                            <div class="col-md-6">
                                <label>Category</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" {{ $product->cat_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description', $product->description) }}">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Stock</label>
                                <input type="number" class="form-control" name="stock" value="{{ old('stock', $product->stock) }}" min="0">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Size</label>
                                <input type="text" class="form-control" name="size" value="{{ old('size', $product->size) }}">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="photo">
                                @if($product->photo)
                                    <img src="{{ asset('images/' . $product->photo) }}" alt="Product Image" width="100" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection