window.openLogoutModal = function () {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.add('active');
    }
};

window.closeLogoutModal = function () {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.remove('active');
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === this) {
                window.closeLogoutModal();
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-password-btn').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            const eyeIcon = this.querySelector('.eye-icon');
            const eyeOffIcon = this.querySelector('.eye-off-icon');

            if (eyeIcon && eyeOffIcon) {
                eyeIcon.style.display = isPassword ? 'none' : 'block';
                eyeOffIcon.style.display = isPassword ? 'block' : 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const categoryInputs = document.querySelectorAll('.category-pill input[type="radio"]');
    
    categoryInputs.forEach(input => {
        input.addEventListener('change', function () {
            // Remove active class from all pills
            document.querySelectorAll('.category-pill').forEach(pill => {
                pill.classList.remove('active');
            });
            // Add active class to the selected pill's label parent
            if (this.checked) {
                this.closest('.category-pill').classList.add('active');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const radioPosts = document.getElementById('cat-posts');
    const radioProfiles = document.getElementById('cat-profiles');
    const postTypeGroup = document.getElementById('post-type-group');
    const sortPostsSelect = document.getElementById('sort-posts-select');
    const sortProfilesSelect = document.getElementById('sort-profiles-select');

    function toggleControls() {
        if (radioProfiles && radioProfiles.checked) {
            if (postTypeGroup) postTypeGroup.style.display = 'none';
            if (sortPostsSelect) sortPostsSelect.style.display = 'none';
            if (sortProfilesSelect) sortProfilesSelect.style.display = 'block';
        } else {
            if (postTypeGroup) postTypeGroup.style.display = 'block';
            if (sortPostsSelect) sortPostsSelect.style.display = 'block';
            if (sortProfilesSelect) sortProfilesSelect.style.display = 'none';
        }
    }

    if (radioPosts && radioProfiles) {
        radioPosts.addEventListener('change', toggleControls);
        radioProfiles.addEventListener('change', toggleControls);
        toggleControls(); // Initial execution on load
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const radioPosts = document.getElementById('cat-posts');
    const radioProfiles = document.getElementById('cat-profiles');
    const postTypeGroup = document.getElementById('post-type-group');
    const sortPostsSelect = document.getElementById('sort-posts-select');
    const sortProfilesSelect = document.getElementById('sort-profiles-select');

    function toggleControls() {
        if (radioProfiles && radioProfiles.checked) {
            if (postTypeGroup) postTypeGroup.style.display = 'none';
            if (sortPostsSelect) sortPostsSelect.style.display = 'none';
            if (sortProfilesSelect) sortProfilesSelect.style.display = 'block';
        } else {
            if (postTypeGroup) postTypeGroup.style.display = 'block';
            if (sortPostsSelect) sortPostsSelect.style.display = 'block';
            if (sortProfilesSelect) sortProfilesSelect.style.display = 'none';
        }
    }

    if (radioPosts && radioProfiles) {
        radioPosts.addEventListener('change', toggleControls);
        radioProfiles.addEventListener('change', toggleControls);
        toggleControls(); // Initial execution on load
    }
});

window.toggleSidebar = function () {
    const drawer = document.querySelector('.drawer');
    if (drawer) {
        drawer.classList.toggle('collapsed');
        localStorage.setItem('admin_sidebar_collapsed', drawer.classList.contains('collapsed'));
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const drawer = document.querySelector('.drawer');
    if (drawer && localStorage.getItem('admin_sidebar_collapsed') === 'true') {
        drawer.classList.add('collapsed');
    }
});

window.toggleSidebar = function () {
    const drawer = document.querySelector('.drawer');
    if (drawer) {
        drawer.classList.toggle('collapsed');
        localStorage.setItem('sidebar_collapsed', drawer.classList.contains('collapsed'));
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const drawer = document.querySelector('.drawer');
    if (drawer && localStorage.getItem('sidebar_collapsed') === 'true') {
        drawer.classList.add('collapsed');
    }
});