<!-- resources/views/users/index.blade.php (أو أي اسم آخر) -->
@extends('admin.layout')

@section('content')
<div class="container mt-5">

    <h2>Manage Users</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-hover table-bordered shadow-lg">
        <thead class="table-primary text-center">
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Admin Access?</th> 
                <th>Add Role</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($users as $u)
            <tr>
                <td class="fw-bold">{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    @foreach($u->roles as $r)
                        <form action="{{ route('admin.users.detachRole', [$u->id, $r->id]) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning btn-sm mb-1" onclick="return confirm('Are you sure you want to remove this role?');">
                                <i class="fa-solid fa-trash"></i> {{ $r->name }}
                            </button>
                        </form>
                    @endforeach
                </td>

                <td>
                    @if($u->can_access_admin)
                        <form action="{{ route('admin.users.revokeAdminAccess', $u->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Revoke</button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.grantAdminAccess', $u->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">Grant</button>
                        </form>
                    @endif
                </td>

                <td>
                    <form action="{{ route('admin.users.attachRole', $u->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="role_id" class="form-select" required>
                                <option value="" disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus"></i> Attach
                            </button>
                        </div>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
