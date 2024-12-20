@extends('categorylayout')
@section('content')

<div class="container">
    <h3 align="center">Category</h3>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">     
            <div class="form-area">
                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value="" selected>Select Status</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>True</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>False</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td scope="col">{{ $loop->iteration }}</td>
                            <td scope="col">{{ $category['name'] ?? $category->name }}</td>  <!-- Cek apakah data adalah array atau objek -->
                            <td scope="col">{{ isset($category['status']) ? ($category['status'] ? 'Active' : 'Inactive') : ($category->status ? 'Active' : 'Inactive') }}</td>  <!-- Cek status dengan cara yang benar -->
                            <td scope="col">
                                <a href="{{ route('category.edit', $category['id'] ?? $category->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </a>
                                <form action="{{ route('category.destroy', $category['id'] ?? $category->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center" class="text-muted">No categories found. <a href="{{ route('category.create') }}" class="text-primary">Create a new category</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('css')
<style>
    .form-area {
        padding: 20px;
        margin-top: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
</style>
@endpush
@endsection
