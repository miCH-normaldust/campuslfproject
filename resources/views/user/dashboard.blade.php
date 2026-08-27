<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Student Dashboard</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-layout">
        <!-- User Navigation Drawer -->
        <aside class="drawer">
            <div>
                <div class="drawer-header">
                    <a href="#" class="brand">CampusLF</a>
                    <span class="user-badge">Logged in as: {{ Auth::user()->name }}</span>
                </div>
                <ul class="drawer-menu">
                    <li><a href="{{ route('user.dashboard') }}" class="active">Browse Community Feed</a></li>
                    <li><a href="#">Create Post</a></li>
                    <li><a href="#">Messages & Notifications</a></li>
                    <li><a href="#">Profile</a></li>
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
                <h1>Student Dashboard</h1>
                <p>Manage your posts, report lost items, or browse campus feed.</p>
            </div>
            
    <!-- Redesigned Search Bar Container -->
<div class="search-card">
    <form action="" method="GET" class="search-form">
        <div class="search-bar-wrapper">
            <!-- Category Radio Buttons -->
            <div class="category-toggle-group">
                <label class="category-pill {{ request('category', 'posts') === 'posts' ? 'active' : '' }}">
                    <input type="radio" name="category" value="posts" {{ request('category', 'posts') === 'posts' ? 'checked' : '' }}>
                    <span>Posts</span>
                </label>
                <label class="category-pill {{ request('category') === 'profiles' ? 'active' : '' }}">
                    <input type="radio" name="category" value="profiles" {{ request('category') === 'profiles' ? 'checked' : '' }}>
                    <span>Profiles</span>
                </label>
            </div>

            <div class="search-divider"></div>

            <!-- Text Input -->
            <div class="search-input-field">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search keywords or names..." 
                    aria-label="Search feed"
                >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-search-submit">
                Search
            </button>
        </div>
    </form>
</div>
            @if(request('category') === 'profiles')
    <!-- Profiles Grid -->
    <div class="post-grid">
        @forelse($profiles as $profile)
            <div class="post-card">
                <div>
                    <span class="status-badge status-found">{{ ucfirst($profile->role) }}</span>
                    <h3>{{ $profile->name }}</h3>
                    <p>{{ $profile->email }}</p>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>No user profiles found matching your search.</p>
            </div>
        @endforelse
    </div>
@else
    <!-- Posts Grid -->
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
                <p>No posts found matching your search.</p>
            </div>
        @endforelse
    </div>
@endif
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