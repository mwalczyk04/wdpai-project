function initUserMenu() {
    const avatarToggle = document.getElementById('avatar-toggle');
    const userDropdown = document.getElementById('user-dropdown');

    if (!avatarToggle || !userDropdown) {
        return;
    }

    const openDropdown = () => {
        userDropdown.removeAttribute('hidden');
        avatarToggle.setAttribute('aria-expanded', 'true');
        const firstInput = userDropdown.querySelector('input');
        if (firstInput) {
            firstInput.focus();
        }
    };

    const closeDropdown = () => {
        userDropdown.setAttribute('hidden', '');
        avatarToggle.setAttribute('aria-expanded', 'false');
    };

    avatarToggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isHidden = userDropdown.hasAttribute('hidden');
        if (isHidden) {
            openDropdown();
        } else {
            closeDropdown();
        }
    });

    userDropdown.addEventListener('click', (event) => {
        event.stopPropagation();
    });

    document.addEventListener('click', () => {
        if (!userDropdown.hasAttribute('hidden')) {
            closeDropdown();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !userDropdown.hasAttribute('hidden')) {
            closeDropdown();
            avatarToggle.focus();
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initUserMenu);
} else {
    initUserMenu();
}
