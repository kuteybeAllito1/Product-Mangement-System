<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

  <div class="card mx-auto my-5" style="max-width: 800px; width: 90%;">

    <div class="card-header bg-primary text-white">
      <h2 class="mb-0"><i class="fa-solid fa-shopping-cart"></i> My Shopping Cart</h2>
    </div>

    <div class="card-body">

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if($cart->items->isEmpty())
        <p class="text-center">Your cart is empty.</p>
      @else
        <div class="table-responsive-lg">
          <table class="table table-hover table-bordered shadow-sm text-center mb-0">
            <thead class="table-primary">
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cart->items as $item)
                <tr>
                  <td>{{ $item->product->name }}</td>
                  <td>{{ number_format($item->product->price, 2) }} TL</td>
                  <td>
                    <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline-flex">
                      @csrf
                      @method('PATCH')
                      <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                      class="form-control form-control-sm me-2" style="width: 80px;">
                      <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                  </td>
                  <td>{{ number_format($item->product->price * $item->quantity, 2) }} TL</td>
                  <td>
                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      <div class="text-end mt-3">
        <a href="{{ route('home') }}" class="btn btn-secondary">
          <i class="fa-solid fa-arrow-left"></i> Back to Products
        </a>
      </div>

    </div>

  </div>

</body>
</html>
