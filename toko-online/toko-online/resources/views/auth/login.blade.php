<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Online</title>
</head>
<body>
    <h2>Login Pengguna</h2>
    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif
    @if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</body>
</html>