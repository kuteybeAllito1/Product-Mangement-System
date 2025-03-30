<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { display: flex; height: 100vh; }
        .sidebar { width: 250px; background: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; padding: 15px; display: block; }
        .sidebar a:hover { background: #495057; }
        .content { flex: 1; padding: 20px; }
    </style>
</head>
<body>


    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>

        <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-home"></i> Dashboard</a>

        @if(Auth::user()->hasPermission('promote_user') || Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Manage Users</a>
        @endif

        @if(Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.roles.index') }}"><i class="fa-solid fa-shield-halved"></i> Manage Roles</a>
        @endif

        @if( Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.permissions.index') }}"><i class="fa-solid fa-key"></i> Manage Permissions</a>
        @endif

        @if(Auth::user()->hasPermission('manage_products') || 
            Auth::user()->hasPermission('create_product') || 
            Auth::user()->hasPermission('edit_product') || 
            Auth::user()->hasPermission('delete_product'))
            <a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box"></i> Manage Products</a>
        @endif

        <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
