<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="container-fluid mt-5">

    <div class="container">

    @if(Auth::check() && Auth::user()->isSuperAdmin())
    <div class="mb-3 text-end">
        <a href="{{ route('users.index') }}" class="btn btn-info">
            <i class="fa-solid fa-users"></i> Manage Users
        </a>

        <a href="{{ route('roles.index') }}" class="btn btn-primary">
            <i class="fa-solid fa-shield-halved"></i> Manage Roles
        </a>

        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-key"></i> Manage Permissions
        </a>
    </div>
@endif
        <!-- زر "Manage Users" لمن يملك إذن معين (مثلاً "promote_user") أو هو Super Admin -->
        <!-- @if(Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->hasPermission('promote_user')))
            <div class="mb-3 text-end">
                <a href="{{ route('users.index') }}" class="btn btn-info">
                    <i class="fa-solid fa-users"></i> Manage Users
                </a>
            </div>
        @endif -->

        <h2 class="text-center mb-4"><i class="fa-solid fa-boxes"></i> Product Management</h2>

        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex w-50">
                <input type="text" name="search" class="form-control me-2 text-center"
                       placeholder="Search by product name or description..." value="{{ request()->search }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-search"></i> Search
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-end mb-4">
            @if(Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->hasPermission('create_product')))
                <a href="{{ route('products.create') }}" class="btn btn-success btn-lg px-4">
                    <i class="fa-solid fa-plus"></i> Add Product
                </a>
            @endif
        </div>

        <div class="table-responsive-lg">
            <table class="table table-hover table-bordered shadow-lg">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($products as $product)
                        <tr>
                            <td class="fw-bold">{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><span>{{ $product->price }} TL</span></td>
                            <td>{{ $product->description }}</td>
                            <td>
                                @if(Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->hasPermission('edit_product')))
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-lg me-2">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                @endif

                                @if(Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->hasPermission('delete_product')))
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-lg delete-btn">
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

</body>
</html>
