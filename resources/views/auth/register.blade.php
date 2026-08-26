<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="auth-card">
        <h2>Join CampusLF</h2>
        <p class="subtitle">Create an account to report or claim lost items</p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Campus Email</label>
                <input type="email" name="email" placeholder="student@campus.edu" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-submit btn-green">Create Account</button>
        </form>
        <div class="footer-text">
            Already registered? <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
</body>
</html>