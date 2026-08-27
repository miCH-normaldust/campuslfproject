<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusLF - Guest Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <!-- Redesigned Search Bar Container -->
            <div class="search-card">
                <form action="{{ route('guest.dashboard') }}" method="GET" class="search-form">
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
                    <a href="{{ route('guest.dashboard') }}" class="btn-back-feed">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Back to Feed
                    </a>
                </div>
            @endif

            <!-- Conditional Grid Display -->
            @if(!empty($isSearching) && request('category') === 'profiles')
                <!-- Profiles Grid (Active Profile Search) -->
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
                            <p>No user profiles matching "{{ $searchTerm }}".</p>
                        </div>
                    @endforelse
                </div>
            @else
                <!-- General Feed OR Active Post Search -->
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
                            <p>{{ !empty($isSearching) ? 'No posts found matching your search.' : 'No posts in the community feed yet.' }}</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </main>
    </div>
</body>
</html>