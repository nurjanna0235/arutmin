<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 400px;">
        <h4 class="text-center mb-3">Lupa Password</h4>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ url('login') }}">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
