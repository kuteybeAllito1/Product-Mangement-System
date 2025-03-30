@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center"><i class="fa-solid fa-plus"></i> Add New Product</h2>

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                    <input type="number" name="price" class="form-control" placeholder="Enter product price" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
                    <textarea name="description" class="form-control" placeholder="Enter product description"></textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg"><i class="fa-solid fa-save"></i> Save</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
