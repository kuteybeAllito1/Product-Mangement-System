<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Edit Profile</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
    <form action="{{ route('profile.update') }}" method="POST">
      @csrf<div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        @error('name')
      <div class="text-danger">{{ $message }}</div>
    @enderror
      </div><div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"
          required>
        @error('email')<div class="text-danger">{{ $message }}</div>
    @enderror
      </div><div class="mb-3">
        <label for="password" class="form-label">New Password (optional)</label>
        <input type="password" name="password" id="password" class="form-control">
        @error('password')
      <div class="text-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
  </div>
</body>

</html>