<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-card">
        <h2>Welcome Back</h2>
        <p class="subtitle">Log in to manage your campus posts</p>

        <!-- Global Error Alert (e.g. Invalid credentials mismatch) -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Invalid Credentials:</strong>
                <ul style="margin-top: 4px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="student@campus.edu" class="@error('email') input-error @enderror" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" class="@error('password') input-error @enderror" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn-submit">Sign In</button>
        </form>

        <div class="footer-text">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
</body>
</html>