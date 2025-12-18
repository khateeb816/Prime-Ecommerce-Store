// Backend Admin JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const sidebar = document.querySelector('.left-sidebar-pro');
    const contentWrapper = document.querySelector('.all-content-wrapper');

    if (sidebarCollapse && sidebar) {
        sidebarCollapse.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            if (contentWrapper) {
                if (sidebar.classList.contains('collapsed')) {
                    contentWrapper.style.marginLeft = '0';
                } else {
                    contentWrapper.style.marginLeft = 'var(--sidebar-width)';
                }
            }
        });
    }

    // MetisMenu functionality
    const menuItems = document.querySelectorAll('.metismenu .has-arrow');
    menuItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const submenu = parent.querySelector('.submenu-angle');

            if (submenu) {
                const isActive = parent.classList.contains('active');

                // Close all other submenus
                document.querySelectorAll('.metismenu li').forEach(function(li) {
                    if (li !== parent) {
                        li.classList.remove('active');
                    }
                });

                // Toggle current submenu
                if (isActive) {
                    parent.classList.remove('active');
                } else {
                    parent.classList.add('active');
                }
            }
        });
    });

    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.textContent.replace(/[^0-9]/g, ''));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                element.textContent = element.textContent.replace(/[0-9,]+/, target.toLocaleString());
                clearInterval(timer);
            } else {
                element.textContent = element.textContent.replace(/[0-9,]+/, Math.floor(current).toLocaleString());
            }
        }, 16);
    }

    // Initialize counters
    document.querySelectorAll('.counter').forEach(function(counter) {
        animateCounter(counter);
    });

    // Auto-hide alerts
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Table row hover effect
    document.querySelectorAll('.table tbody tr').forEach(function(row) {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });

    // Bootstrap dropdowns will handle themselves automatically
    // No custom JavaScript needed for dropdowns
});

// Sparkline charts placeholder (would need actual sparkline library)
function initSparklines() {
    // Placeholder for sparkline charts
    document.querySelectorAll('#sparklinedash, #sparklinedash2, #sparklinedash3, #sparklinedash4').forEach(function(el) {
        el.style.width = '100px';
        el.style.height = '30px';
        el.style.background = '#f0f0f0';
        el.style.borderRadius = '4px';
    });
}

// Initialize on load
window.addEventListener('load', initSparklines);

