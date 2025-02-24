<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 400px;">
        <h4 class="text-center mb-3">Reset Password</h4>
        @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="text" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-success w-100">Reset Password</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ url('login') }}">Kembali ke Login</a>
        </div>
    </div>
</body>

</html>
