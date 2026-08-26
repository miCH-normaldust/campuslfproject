<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Guest Feed</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <a href="{{ route('welcome') }}" class="brand">CampusLF</a>
        <div class="user-info">
            <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 0.85rem;">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 0.85rem;">Register</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Public Feed</h1>
            <p>Browse active lost and found listings across campus.</p>
        </div>

        <div class="post-grid">
            @forelse($posts as $post)
                <div class="post-card">
                    <div>
                        <span class="status-badge status-active">Active</span>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            @empty
                <p style="color: #64748b;">No active posts found at the moment.</p>
            @endforelse
        </div>
    </div>
</body>
</html>