<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="dashboard-body">
    <nav class="navbar">
        <a href="#" class="brand">CampusLF</a>
        <div class="user-info">
            <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem; color: white; border-color: #475569;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Student Dashboard</h1>
            <p>View posts and report or manage items.</p>
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
                <p style="color: #64748b;">No posts to show.</p>
            @endforelse
        </div>
    </div>
</body>
</html>