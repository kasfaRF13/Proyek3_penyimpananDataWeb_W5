<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas 1</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; }
        .btn-logout { padding: 8px 16px; background-color: #ef4444; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-logout:hover { background-color: #dc2626; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Selamat Datang!</h1>
        <p>Selamat datang, <strong>{{ Auth::user()->nama_lengkap }}</strong>!</p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: <strong>{{ Auth::user()->username }}</strong></p>
        
        <form action="{{ url('/logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</body>
</html>