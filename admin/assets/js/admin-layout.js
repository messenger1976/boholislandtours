/**
 * Admin layout interactions — mobile sidebar, dark mode, submenu helpers.
 */
(function () {
    'use strict';

    function applyDarkMode(enabled) {
        document.documentElement.classList.toggle('dark-mode', enabled);
        if (document.body) {
            document.body.classList.toggle('dark-mode', enabled);
        }
        var toggle = document.getElementById('darkModeToggle');
        if (toggle) {
            toggle.checked = enabled;
        }
        var chipIcon = document.querySelector('#themeChip i');
        if (chipIcon) {
            chipIcon.className = enabled ? 'bi bi-sun' : 'bi bi-moon-stars';
        }
        localStorage.setItem('darkMode', enabled ? 'true' : 'false');
    }

    function isDark() {
        return localStorage.getItem('darkMode') === 'true';
    }

    // Early apply (also duplicated inline in header for FOUC)
    try {
        applyDarkMode(isDark());
    } catch (e) {}

    function closeSidebar() {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        if (sidebar) {
            sidebar.classList.remove('mobile-menu', 'is-open');
        }
        if (overlay) {
            overlay.classList.remove('is-visible');
        }
        document.body.classList.remove('sidebar-open');
    }

    function openSidebar() {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        if (sidebar) {
            sidebar.classList.add('mobile-menu', 'is-open');
        }
        if (overlay) {
            overlay.classList.add('is-visible');
        }
        document.body.classList.add('sidebar-open');
    }

    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        if (!sidebar) {
            return;
        }
        if (sidebar.classList.contains('is-open') || sidebar.classList.contains('mobile-menu')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        applyDarkMode(isDark());

        var menuToggle = document.querySelector('.menu-toggle');
        var sidebarClose = document.querySelector('.sidebar-close');
        var overlay = document.getElementById('sidebarOverlay');
        var darkModeToggle = document.getElementById('darkModeToggle');
        var themeChip = document.getElementById('themeChip');

        if (menuToggle) {
            menuToggle.addEventListener('click', function (e) {
                e.preventDefault();
                toggleSidebar();
            });
        }

        if (sidebarClose) {
            sidebarClose.addEventListener('click', function (e) {
                e.preventDefault();
                closeSidebar();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close sidebar after navigating on small screens
        document.querySelectorAll('.nk-menu-link[href], .nk-menu-sub-link[href]').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.matchMedia('(max-width: 991px)').matches && this.getAttribute('href') && this.getAttribute('href') !== '#') {
                    closeSidebar();
                }
            });
        });

        if (darkModeToggle) {
            darkModeToggle.addEventListener('change', function () {
                applyDarkMode(this.checked);
            });
        }

        if (themeChip) {
            themeChip.addEventListener('click', function () {
                applyDarkMode(!isDark());
            });
        }

        window.addEventListener('resize', function () {
            if (window.matchMedia('(min-width: 992px)').matches) {
                closeSidebar();
            }
        });
    });

    window.AdminLayout = {
        applyDarkMode: applyDarkMode,
        openSidebar: openSidebar,
        closeSidebar: closeSidebar,
        toggleSidebar: toggleSidebar
    };
})();
