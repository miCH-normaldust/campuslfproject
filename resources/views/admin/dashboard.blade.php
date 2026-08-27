<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Admin Portal</title>
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

            <!-- Search and Filtering Form -->
            <div class="search-card">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="search-form">
                    <div class="search-bar-wrapper">
                        <!-- Category Radio Buttons (Icons Only) -->
                        <div class="category-toggle-group">
                            <label class="category-pill {{ request('category', 'posts') === 'posts' ? 'active' : '' }}" title="Posts">
                                <input type="radio" id="cat-posts" name="category" value="posts" {{ request('category', 'posts') === 'posts' ? 'checked' : '' }}>
                                <svg class="category-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </label>
                            <label class="category-pill {{ request('category') === 'profiles' ? 'active' : '' }}" title="Profiles">
                                <input type="radio" id="cat-profiles" name="category" value="profiles" {{ request('category') === 'profiles' ? 'checked' : '' }}>
                                <svg class="category-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </label>
                        </div>

                        <!-- Post Sub-Category Dropdown (Lost / Found) -->
                        <div class="filter-group" id="post-type-group" style="{{ request('category') === 'profiles' ? 'display: none;' : '' }}">
                            <select name="post_type" class="search-select-dropdown compact">
                                <option value="all" {{ ($postType ?? 'all') === 'all' ? 'selected' : '' }}>All Statuses</option>
                                <option value="found" {{ ($postType ?? '') === 'found' ? 'selected' : '' }}>Found</option>
                                <option value="lost" {{ ($postType ?? '') === 'lost' ? 'selected' : '' }}>Lost</option>
                            </select>
                        </div>

                        <!-- Dynamic Compact Sorting Dropdowns -->
                        <div class="filter-group">
                            <select id="sort-posts-select" name="sort" class="search-select-dropdown compact" style="{{ request('category') === 'profiles' ? 'display: none;' : '' }}">
                                <option value="latest" {{ ($sort ?? 'latest') === 'latest' ? 'selected' : '' }}>Newest</option>
                                <option value="oldest" {{ ($sort ?? '') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>

                            <select id="sort-profiles-select" name="sort" class="search-select-dropdown compact" style="{{ request('category') !== 'profiles' ? 'display: none;' : '' }}">
                                <option value="a-z" {{ ($sort ?? 'a-z') === 'a-z' ? 'selected' : '' }}>A - Z</option>
                                <option value="z-a" {{ ($sort ?? '') === 'z-a' ? 'selected' : '' }}>Z - A</option>
                            </select>
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
                                value="{{ $searchTerm ?? '' }}" 
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

            <!-- Active Search Status Bar & Back Button -->
            @if(!empty($isSearching))
                <div class="search-status-bar">
                    <div class="search-status-text">
                        Showing {{ request('category') === 'profiles' ? 'profile' : 'post' }} results for: <strong>"{{ $searchTerm }}"</strong>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn-back-feed">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Back to Feed
                    </a>
                </div>
            @endif

            <!-- Dynamic Content Output -->
            @if(request('category') === 'profiles')
                <!-- Profiles Grid -->
                <div class="post-grid">
                    @forelse($profiles as $profile)
                        <div class="post-card">
                            <div>
                                <span class="status-badge status-found">{{ ucfirst($profile->role ?? 'User') }}</span>
                                <h3>{{ $profile->name }}</h3>
                                <p>{{ $profile->email }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>{{ !empty($isSearching) ? 'No user profiles matching "' . $searchTerm . '".' : 'No registered users found.' }}</p>
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
                            <p>{{ !empty($isSearching) ? 'No posts found matching your search criteria.' : 'No posts in the community feed yet.' }}</p>
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