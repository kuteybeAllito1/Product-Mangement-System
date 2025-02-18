<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Account</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-user-plus"></i> Create a New Account</h4>
        </div>
        <div class="card-body">
            
            <!-- عرض الأخطاء في حال وجودها -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                </script>
            @endif

            <form action="{{ route('register') }}" method="post">
                {!! csrf_field() !!}

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Enter your name" 
                            value="{{ old('name') }}" 
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="Enter your email address" 
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control" 
                            placeholder="••••••••" 
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign Up</button>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
