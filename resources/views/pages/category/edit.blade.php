@extends('categorylayout')

@section('content')
    <div class="container mt-5">
        <h3>Edit Category</h3>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('category.update', $category['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $category['name']) }}" 
                            required
                        >
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="1" {{ $category['status'] ? 'selected' : '' }}>True</option>
                            <option value="0" {{ !$category['status'] ? 'selected' : '' }}>FALSE</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection