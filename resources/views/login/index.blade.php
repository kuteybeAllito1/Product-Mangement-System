<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-header text-center bg-primary text-white">
            <h4><i class="fa-solid fa-sign-in-alt"></i> Login</h4>
        </div>
        <div class="card-body"> 

            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

                    @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
             @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('check') }}" method="post">
                {!! csrf_field() !!}  

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="Enter your email" 
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
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

                        <div class="mb-3">
                <label for="otp" class="form-label">Verification Code</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input 
                        type="text" 
                        name="otp" 
                        id="otp" 
                        class="form-control" 
                        placeholder="Enter verification code"
                    >
                </div>
                <small class="form-text text-muted">
                    If your account is not activated, enter the code we sent to your email.
                </small>
            </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-sign-in-alt"></i> Login
                </button>

                <p class="text-center mt-3">
                    Don't have an account?  
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                        <i class="fa-solid fa-user-plus"></i> Create an Account
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
