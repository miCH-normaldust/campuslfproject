<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-card">
        <h2>Join CampusLF</h2>
        <p class="subtitle">Create an account to report or claim lost items</p>

        <!-- General Validation Summary Alert -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following issues:</strong>
                <ul style="margin-top: 4px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="@error('name') input-error @enderror" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Campus Email</label>
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