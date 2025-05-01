<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

  <div class="card mx-auto my-5" style="max-width: 600px; width: 90%;">

    <div class="card-header bg-primary text-white">
      <h2 class="mb-0"><i class="fa-solid fa-user-edit"></i> Edit Profile</h2>
    </div>

    <div class="card-body">

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">New Password <span class="text-muted">(optional)</span></label>
          <input type="password" name="password" id="password" class="form-control">
          @error('password')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Cancel
          </a>
          <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-save"></i> Save Changes
          </button>
        </div>
      </form>

    </div>
  </div>

</body>
</html>
