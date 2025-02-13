<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-header text-center bg-primary text-white">
            <h4><i class="fa-solid fa-sign-in-alt"></i> Giriş Yap</h4>
        </div>
        <div class="card-body"> 

            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('check') }}" method="post">
                {!! csrf_field() !!}  

                <div class="mb-3">
                    <label for="email" class="form-label">E-posta Adresi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-posta adresinizi girin" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-sign-in-alt"></i> Giriş Yap
                </button>

                <p class="text-center mt-3">
                    Hesabınız yok mu?  
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                        <i class="fa-solid fa-user-plus"></i> Yeni Hesap Oluştur
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
