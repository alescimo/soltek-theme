/**
 * Soltek Theme - Main JavaScript
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initScrollToTop();
        initSmoothScroll();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('menu-icon-open');
        const iconClose = document.getElementById('menu-icon-close');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function() {
            const isOpen = menu.classList.toggle('active');

            if (iconOpen && iconClose) {
                iconOpen.style.display = isOpen ? 'none' : 'block';
                iconClose.style.display = isOpen ? 'block' : 'none';
            }

            // Prevent body scroll when menu is open
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target) && menu.classList.contains('active')) {
                menu.classList.remove('active');
                if (iconOpen && iconClose) {
                    iconOpen.style.display = 'block';
                    iconClose.style.display = 'none';
                }
                document.body.style.overflow = '';
            }
        });

        // Close menu on link click
        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                menu.classList.remove('active');
                if (iconOpen && iconClose) {
                    iconOpen.style.display = 'block';
                    iconClose.style.display = 'none';
                }
                document.body.style.overflow = '';
            });
        });
    }

    /**
     * Scroll to Top Button
     */
    function initScrollToTop() {
        // Create button if it doesn't exist
        let btn = document.getElementById('scroll-to-top');

        if (!btn) {
            btn = document.createElement('button');
            btn.id = 'scroll-to-top';
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>';
            btn.setAttribute('aria-label', 'Torna su');
            btn.style.cssText = 'position: fixed; bottom: 6rem; right: 1.5rem; z-index: 50; padding: 0.75rem; background: #2563eb; color: white; border: none; border-radius: 9999px; cursor: pointer; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); opacity: 0; visibility: hidden; transition: all 0.3s;';
            document.body.appendChild(btn);
        }

        // Show/hide on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 400) {
                btn.style.opacity = '1';
                btn.style.visibility = 'visible';
            } else {
                btn.style.opacity = '0';
                btn.style.visibility = 'hidden';
            }
        });

        // Scroll to top on click
        btn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

})();
