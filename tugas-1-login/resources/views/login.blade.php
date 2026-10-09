<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tugas 1 Data Storage</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 320px; }
        .login-card h2 { margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { width: 100%; padding: 10px; background-color: #4f46e5; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn:hover { background-color: #4338ca; }
        .error { color: red; font-size: 14px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login Sistem</h2>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>
</body>
</html>