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
                <label for="login-password">Password</label>
                <div class="password-field-wrapper">
                <input type="password" id="login-password" name="password" placeholder="••••••••" class="@error('password') input-error @enderror" required>
                <button type="button" class="toggle-password-btn" data-target="login-password" aria-label="Toggle password visibility">
                 <!-- Eye Icon (Password Hidden) -->
                    <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <!-- Eye Off Icon (Password Visible) -->
                    <svg class="eye-off-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
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