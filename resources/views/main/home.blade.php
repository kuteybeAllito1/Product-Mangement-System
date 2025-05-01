<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <div class="container-fluid p-4">
    <div class="card w-100 shadow-sm">
      <div class="card-header bg-primary text-white">
        <nav class="navbar navbar-expand-lg p-0">
          <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('home') }}">MyApp</a>
            <div class="collapse navbar-collapse">
              <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                  <li class="nav-item me-3">
                    <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                      <i class="fa-solid fa-user"></i> Edit Profile
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm">
                      <i class="fa fa-shopping-cart"></i> Cart
                    </a>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <div class="card-body">
        <h2 class="text-center mb-4"><i class="fa-solid fa-boxes"></i> Product List</h2>

        <div class="mb-4">
          <form action="{{ route('home') }}" method="GET" class="d-flex w-100">
            <input type="text" name="search" class="form-control me-2"
               placeholder="Search by product name or description..." value="{{ request()->search }}">
            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-search"></i> Search
            </button>
          </form>
        </div>

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <div class="table-responsive">
          <table class="table table-hover table-bordered shadow-sm text-center mb-0 w-100">
            <thead class="table-primary">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
                <tr>
                  <td class="fw-bold">{{ $product->id }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ number_format($product->price,2) }} TL</td>
                  <td>{{ $product->description }}</td>
                  <td>
                    <form action="{{ route('cart.add') }}" method="POST">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-cart-plus"></i> Add
                      </button>
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
</body>

</html>