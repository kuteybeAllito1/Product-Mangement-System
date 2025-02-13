<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Ürün Ekle</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center"><i class="fa-solid fa-plus"></i> Yeni Ürün Ekle</h2>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Ürün Adı</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="Ürün adını girin" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fiyat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                        <input type="number" name="price" class="form-control" placeholder="Ürün fiyatını girin" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Açıklama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
                        <textarea name="description" class="form-control" placeholder="Ürün açıklaması girin"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg"><i class="fa-solid fa-save"></i> Kaydet</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
