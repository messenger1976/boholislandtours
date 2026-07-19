<footer id="contact" class="site-footer">
    <div class="container">
        <div class="newsletter-box">
            <div class="row align-items-center g-3">
                <div class="col-lg-5">
                    <h4 class="mb-1">Join Our Newsletter</h4>
                    <p class="mb-0 opacity-75">Get the latest Bohol travel offers &amp; promotions.</p>
                </div>
                <div class="col-lg-7">
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address" required aria-label="Email">
                            <button type="submit" class="btn btn-secondary">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <h4>About Bohol Tours</h4>
                <p>Your premier gateway to Bohol's natural wonders and cultural heritage. Unforgettable travel experiences with expert local guides and curated itineraries.</p>
                <div class="social-links mt-3">
                    <a href="https://www.facebook.com/boholislandtours.ph" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="mailto:info@boholislandtours.com" aria-label="Email"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#tours">Tour Packages</a></li>
                    <li><a href="index.php#destinations">Destinations</a></li>
                    <li><a href="rental.php">Car/Van Rental</a></li>
                    <li><a href="about-bohol.php">About Bohol</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h4>Popular Packages</h4>
                <ul class="footer-links">
                    <li><a href="package1.php">2D1N Bohol Tour</a></li>
                    <li><a href="package2.php">3D2N Bohol Tour</a></li>
                    <li><a href="package3.php">4D3N Bohol Tour</a></li>
                    <li><a href="package4.php">5D4N Bohol Tour</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3">
                <h4>Contact Us</h4>
                <p class="mb-2"><i class="bi bi-geo-alt me-2 text-teal"></i>Tourism Center, Tagbilaran City, Bohol 6300</p>
                <p class="mb-2"><i class="bi bi-telephone me-2"></i><a href="tel:+63384110000">(038) 411-TOUR</a></p>
                <p class="mb-2"><i class="bi bi-envelope me-2"></i><a href="mailto:info@boholislandtours.com">info@boholislandtours.com</a></p>
                <p class="mb-0"><i class="bi bi-whatsapp me-2"></i><a href="https://wa.me/639125298818" target="_blank" rel="noopener">+63 912 529 8818</a></p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row align-items-center g-2">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Bohol Island Tours. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="me-2 opacity-75">Payment methods:</span>
                    <span class="badge bg-secondary me-1">Visa</span>
                    <span class="badge bg-secondary me-1">Mastercard</span>
                    <span class="badge bg-secondary me-1">GCash</span>
                    <span class="badge bg-secondary">PayPal</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Facebook Messenger Chat Plugin -->
<div id="fb-root"></div>
<div id="fb-customer-chat" class="fb-customerchat"></div>
<script>
    (function initMessengerChat() {
        var chatbox = document.getElementById('fb-customer-chat');
        if (!chatbox) return;
        chatbox.setAttribute('page_id', '137067352998686');
        chatbox.setAttribute('attribution', 'biz_inbox');
    })();

    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v19.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<a href="https://www.facebook.com/boholislandtours.ph"
   class="floating-fb-btn"
   aria-label="Open our Facebook Page"
   target="_blank"
   rel="noopener noreferrer">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.312h3.587l-.467 3.622h-3.12V24h6.116C23.403 24 24 23.403 24 22.676V1.325C24 .597 23.403 0 22.675 0z"/>
    </svg>
</a>
