<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Guest Portal</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="dashboard-layout">
        <!-- Guest Navigation Drawer -->
        <aside class="drawer">
            <div>
                <div class="drawer-header">
                    <a href="{{ route('welcome') }}" class="brand">CampusLF</a>
                    <span class="user-badge">Guest Access</span>
                </div>
                <ul class="drawer-menu">
                    <li><a href="{{ route('guest.dashboard') }}" class="active">Browse Community Feed</a></li>
                    <li><a href="{{ route('login') }}">Log-in / Register</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1>Community Feed</h1>
                <p>Browse active lost and found items posted across campus.</p>
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
                    <div class="empty-state">
                        <p>No posts available in the community feed right now.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>