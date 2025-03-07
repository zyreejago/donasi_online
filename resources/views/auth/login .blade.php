@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <h2>Login</h2>

    <div id="error-message" style="color: red; display: none;"></div>

    <form id="login-form">
        @csrf
        <label>Email:</label>
        <input type="email" id="email" name="email" required>

        <label>Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>

<script>
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let errorMessage = document.getElementById('error-message');

    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            localStorage.setItem('token', data.token); // Simpan token ke localStorage
            window.location.href = '/dashboard'; // Redirect ke dashboard atau halaman lain
        } else {
            errorMessage.style.display = 'block';
            errorMessage.textContent = 'Login gagal! Periksa email dan password.';
        }
    })
    .catch(error => {
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Terjadi kesalahan, coba lagi!';
    });
});
</script>
@endsection
