<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Admin Portal</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-layout">
        <!-- Admin Navigation Drawer -->
        <aside class="drawer" style="background: #020617; border-right: 2px solid #ef4444;">
            <div>
                <div class="drawer-header">
                    <a href="#" class="brand" style="color: #f87171;">CampusLF Admin</a>
                    <span class="user-badge" style="color: #ef4444;">Administrator Access</span>
                </div>
                <ul class="drawer-menu">
                    <li><a href="{{ route('admin.dashboard') }}" class="active">Browse Community Feed</a></li>
                    <li><a href="#">User Activity Monitoring</a></li>
                    <li><a href="#">Reports & Policy Violations</a></li>
                    <li><a href="#">Account Management & Deactivation Requests</a></li>
                    <li><a href="#">Messages & Notifications</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="drawer-footer">
                <ul class="drawer-menu">
                    <li>
                            <button type="button" onclick="openLogoutModal()">Log-out</button>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1>Admin Moderation Dashboard</h1>
                <p>System overview, content moderation, and administrative controls.</p>
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
                    <div class="empty-state">
                        <p>No activity or posts logged in the system.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </div>
            <h3>Log Out?</h3>
            <p>Are you sure you want to end your session?</p>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
                <form action="{{ route('logout') }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn-confirm" style="width: 100%;">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>