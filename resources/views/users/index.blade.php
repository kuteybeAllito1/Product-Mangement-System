<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Management</title>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="users-management-container">
    <h2>Users Management</h2>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $usr)
          <tr>
            <td>{{ $usr->id }}</td>
            <td>{{ $usr->name }}</td>
            <td>{{ $usr->email }}</td>
            <td>{{ $usr->role }}</td>
            <td class="text-center">
              @if($usr->role === 'user')
                <form action="{{ route('users.makeSeller', $usr->id) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-primary btn-sm">Make Seller</button>
                </form>
              @endif
              
              @if($usr->role === 'seller')
                <form action="{{ route('users.makeUser', $usr->id) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-warning btn-sm">Revoke Seller</button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
