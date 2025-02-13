<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center"><i class="fa-solid fa-edit"></i> Edit Product</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
                        <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save"></i> Update</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg"><i class="fa-solid fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
