<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Admin Moderation</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dashboard-body">
    <nav class="navbar" style="background: #0f172a; border-bottom: 2px solid #ef4444;">
        <a href="#" class="brand" style="color: #f87171;">CampusLF Admin</a>
        <div class="user-info">
            <span class="admin-badge">ADMIN</span>
            <span>{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem; color: white; border-color: #475569;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Content Moderation & Activity Logs</h1>
            <p>Overview of all campus activity, reported items, and system posts.</p>
        </div>

        <div class="post-grid">
            @forelse($posts as $post)
                <div class="post-card">
                    <div>
                        <span class="status-badge status-{{ $post->status }}">{{ $post->status }}</span>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            @empty
                <p style="color: #64748b;">No items recorded in the database.</p>
            @endforelse
        </div>
    </div>
</body>
</html>