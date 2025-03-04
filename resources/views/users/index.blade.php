<!DOCTYPE html>
<html>
<head>
  <title>Manage Users</title>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="mb-4 text-start">
        <button 
            class="btn btn-gradient btn-lg rounded-pill shadow d-inline-flex align-items-center px-4" 
            onclick="window.history.back()"
        >
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back
        </button>
    </div>
  <h2>Manage Users</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>User</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Add Role</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $u)
      <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>
          @foreach($u->roles as $r)
            <form action="{{ route('users.detachRole',[$u->id,$r->id]) }}" method="POST" style="display:inline-block">
              @csrf
              @method('DELETE')
              <button class="btn btn-warning btn-sm mb-1">{{ $r->name }} &times;</button>
            </form>
          @endforeach
        </td>
        <td>
          <form action="{{ route('users.attachRole',$u->id) }}" method="POST">
            @csrf
            <div class="input-group">
              <select name="role_id" class="form-select">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
              <button class="btn btn-primary btn-sm">Attach</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
