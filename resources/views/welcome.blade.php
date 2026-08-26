<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Guest Welcome</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f4f4f9; }
        .card { background: white; padding: 40px; border-radius: 8px; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; color: white; background-color: #007bff; text-decoration: none; border-radius: 5px; }
        .btn-secondary { background-color: #6c757d; }
        .btn-outline { background-color: transparent; color: #007bff; border: 1px solid #007bff; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Welcome to CampusLF</h1>
        <p>Guest Portal — Access campus lost & found posts or sign in to contribute.</p>
        <hr><br>
        
        <a href="{{ route('login') }}" class="btn">Log In</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        <br><br>
        <a href="{{ route('guest.dashboard') }}" class="btn btn-outline">Browse Posts as Guest</a>
    </div>
</body>
</html>