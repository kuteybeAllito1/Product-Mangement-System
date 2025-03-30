@extends('admin.layout')

@section('content')
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
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Role Name</label>
                    <input type="text" name="name" class="form-control" placeholder="admin, manager..." value="{{ old('name') }}" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_super_admin" id="is_super_admin" class="form-check-input">
                    <label class="form-check-label" for="is_super_admin">Is Super Admin?</label>
                </div>
                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create Role</button>
            </form>
        </div>
    </div>

    <table class="table table-hover table-bordered shadow-lg">
        <thead class="table-primary text-center">
            <tr>
                <th>Role</th>
                <th>Is Super Admin?</th>
                <th>Permissions</th>
                <th>Add Permission</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($roles as $role)
            <tr>
                <td class="fw-bold">{{ $role->name }}</td>
                <td>
                    @if($role->is_super_admin)
                        <i class="fa-solid fa-check-circle text-success"></i>
                    @else
                        <i class="fa-solid fa-times-circle text-secondary"></i>
                    @endif
                </td>
                <td>
                    @foreach($role->permissions as $perm)
                        <form action="{{ route('admin.roles.detachPermission', [$role->id, $perm->id]) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning btn-sm mb-1" type="submit">
                                <i class="fa-solid fa-trash"></i> {{ $perm->name }}
                            </button>
                        </form>
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('admin.roles.attachPermission', $role->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="permission_id" class="form-select">
                                @foreach($permissions as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa-solid fa-plus"></i> Attach</button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
