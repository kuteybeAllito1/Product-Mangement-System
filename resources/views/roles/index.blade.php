<!DOCTYPE html>
<html>
<head>
    <title>Manage Roles</title>
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
    <h2>Manage Roles</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
      <div class="card-header">Create New Role</div>
      <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label>Role Name</label>
              <input type="text" name="name" class="form-control" placeholder="admin, manager..." required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" name="is_super_admin" id="is_super_admin" class="form-check-input">
              <label class="form-check-label" for="is_super_admin">Is Super Admin?</label>
            </div>
            <button class="btn btn-primary">Create Role</button>
        </form>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Role</th>
          <th>Is Super Admin?</th>
          <th>Permissions</th>
          <th>Add Permission</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
        <tr>
          <td>{{ $role->name }}</td>
          <td>
            @if($role->is_super_admin)
              <span class="badge bg-success">Yes</span>
            @else
              <span class="badge bg-secondary">No</span>
            @endif
          </td>
          <td>
            @foreach($role->permissions as $perm)
              <form action="{{ route('roles.detachPermission',[$role->id,$perm->id]) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-warning mb-1" type="submit">
                  {{ $perm->name }} &times;
                </button>
              </form>
            @endforeach
          </td>
          <td>
            <form action="{{ route('roles.attachPermission',$role->id) }}" method="POST">
              @csrf
              <div class="input-group">
                <select name="permission_id" class="form-select">
                  @foreach($permissions as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                  @endforeach
                </select>
                <button class="btn btn-primary btn-sm" type="submit">Attach</button>
              </div>
            </form>
          </td>
          <td>
            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
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
