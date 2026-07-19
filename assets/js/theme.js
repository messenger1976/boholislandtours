/**
 * Bohol Island Tours — theme UI behaviors (jQuery)
 * Depends on: jQuery 3.x, Bootstrap 5 bundle, optional Swiper
 */
(function ($) {
    'use strict';

    $(function () {
        var $header = $('.site-header');
        var $backToTop = $('#backToTop');

        // Transparent header on home (body.has-transparent-header)
        function onScroll() {
            var scrolled = $(window).scrollTop() > 40;
            $header.toggleClass('is-scrolled', scrolled);
            $backToTop.toggleClass('show', $(window).scrollTop() > 400);
        }
        onScroll();
        $(window).on('scroll', onScroll);

        // Back to top
        $backToTop.on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });

        // Close mobile nav on link click
        $('.navbar-collapse .nav-link:not(.dropdown-toggle)').on('click', function () {
            var $collapse = $('.navbar-collapse');
            if ($collapse.hasClass('show')) {
                bootstrap.Collapse.getOrCreateInstance($collapse[0]).hide();
            }
        });

        // Scroll reveal
        var $reveals = $('.reveal');
        if ($reveals.length && 'IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('visible');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            $reveals.each(function () { io.observe(this); });
        } else {
            $reveals.addClass('visible');
        }

        // Animated counters
        $('.stat-number[data-count]').each(function () {
            var $el = $(this);
            var target = parseInt($el.data('count'), 10) || 0;
            var started = false;
            function animate() {
                if (started) return;
                started = true;
                $({ n: 0 }).animate({ n: target }, {
                    duration: 1600,
                    easing: 'swing',
                    step: function (now) {
                        $el.text(Math.floor(now).toLocaleString());
                    },
                    complete: function () {
                        $el.text(target.toLocaleString());
                    }
                });
            }
            if ('IntersectionObserver' in window) {
                var cio = new IntersectionObserver(function (entries) {
                    if (entries[0].isIntersecting) {
                        animate();
                        cio.disconnect();
                    }
                }, { threshold: 0.4 });
                cio.observe($el[0]);
            } else {
                animate();
            }
        });

        // Hero Swiper
        if (typeof Swiper !== 'undefined' && document.querySelector('.hero-swiper')) {
            new Swiper('.hero-swiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: { crossFade: true },
                autoplay: { delay: 5500, disableOnInteraction: false },
                pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
                navigation: {
                    nextEl: '.hero-swiper .swiper-button-next',
                    prevEl: '.hero-swiper .swiper-button-prev'
                }
            });
        }

        // Testimonials Swiper
        if (typeof Swiper !== 'undefined' && document.querySelector('.testimonials-swiper')) {
            new Swiper('.testimonials-swiper', {
                loop: true,
                autoplay: { delay: 4500, disableOnInteraction: false },
                spaceBetween: 24,
                pagination: { el: '.testimonials-swiper .swiper-pagination', clickable: true },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        }

        // Newsletter form (UI only)
        $('.newsletter-form').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var email = $form.find('input[type="email"]').val();
            if (!email) return;
            alert('Thank you for subscribing! We will keep you updated on Bohol travel offers.');
            $form[0].reset();
        });

        // Payment option cards
        $('.payment-option input[type="radio"]').on('change', function () {
            $('.payment-option').removeClass('active');
            $(this).closest('.payment-option').addClass('active');
        });

        // Set min date on travel-date inputs (tour search)
        var today = new Date().toISOString().split('T')[0];
        $('input[type="date"][name="travel-date"], #travel-date').attr('min', today);
    });
})(jQuery);
