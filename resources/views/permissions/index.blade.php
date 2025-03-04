<!DOCTYPE html>
<html>
<head>
    <title>Manage Permissions</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

    <h2 class="mb-4">Manage Permissions</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Create New Permission</div>
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Permission Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. edit_orders" required>
                </div>
                <button class="btn btn-primary">Create Permission</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Permission</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $perm)
            <tr>
                <td>{{ $perm->name }}</td>
                <td>
                    <form action="{{ route('permissions.destroy', $perm->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
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
