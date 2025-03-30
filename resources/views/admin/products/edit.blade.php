@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center"><i class="fa-solid fa-edit"></i> Edit Product</h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (TL)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-save"></i> Update
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fa-solid fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
