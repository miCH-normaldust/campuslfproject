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

