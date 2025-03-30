@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4"><i class="fa-solid fa-box"></i> Manage Products</h2>

    <div class="mb-3">
        @if(Auth::user()->hasPermission('create_product'))
            <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-lg">
                <i class="fa-solid fa-plus"></i> Add Product
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive-lg">
        <table class="table table-hover table-bordered shadow-lg">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($products as $product)
                <tr>
                    <td class="fw-bold">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><span class="badge bg-info text-dark">{{ $product->price }} TL</span></td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td class="text-center">
                        @if(Auth::user()->hasPermission('edit_product'))
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>
                        @endif
                        
                        @if(Auth::user()->hasPermission('delete_product'))
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
