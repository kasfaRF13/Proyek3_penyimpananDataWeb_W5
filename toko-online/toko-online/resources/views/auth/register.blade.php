<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Toko Online</title>
</head>
<body>
    <h2>Daftar Akun Baru</h2>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <label>ID User:</label><br>
        <input type="text" name="id_user" placeholder="USR001" required><br>

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Username:</label><br>
        <input type="text" name="username" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>

        <label>No HP:</label><br>
        <input type="text" name="no_hp" required><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>