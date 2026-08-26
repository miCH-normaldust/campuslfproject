<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Welcome</title>
    @vite(['resources/css/app.css'])
</head>
<body class="welcome-page">
    <div class="hero-card">
        <span class="badge">Campus Lost & Found</span>
        <h1>CampusLF</h1>
        <p>Reconnecting lost belongings with their rightful owners across campus quickly and securely.</p>
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-primary">Log In to Account</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Create New Account</a>
            <a href="{{ route('guest.dashboard') }}" class="btn btn-outline">Browse Feed as Guest</a>
        </div>
    </div>
</body>
</html>