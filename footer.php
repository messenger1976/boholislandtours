<footer id="contact" class="site-footer">
    <div class="container">
        <div class="newsletter-section">
            <h3>Join Our Newsletter</h3>
            <p>Sign up to our newsletter to receive our latest news about offers & promotions.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address">
                <button type="submit">Subscribe</button>
            </form>
        </div>

        <div class="footer-grid">
            <div class="footer-column">
                <h4>About Bohol Tours</h4>
                <p>Your premier gateway to Bohol's natural wonders and cultural heritage. We specialize in creating unforgettable travel experiences with expert local guides and carefully curated itineraries.</p>
            </div>
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#tours">Tour Packages</a></li>
                    <li><a href="index.php#destinations">Destinations</a></li>
                    <li><a href="index.php#about">About Us</a></li>
                    <li><a href="about-bohol.php">About Bohol</a></li>
                    <li><a href="rental.php">Car/Van Rental</a></li>
                    <li style="display: none;"><a href="gallery.php">Gallery</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="sitemap.xml">Sitemap</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact Us</h4>
                <p>
                    Tourism Center<br>
                    Tagbilaran City, Bohol 6300<br>
                    <a href="tel:+63384110000">(038) 411-TOUR</a><br>
                    <a href="mailto:info@boholislandtours.com">info@boholislandtours.com</a>
                </p>
            </div>
            <div class="footer-column">
                <h4>Follow Our Journey</h4>
                <p>Stay updated with the latest Bohol travel tips and exclusive offers.</p>
                <div class="social-icons">
                    <a href="#">F</a>
                    <a href="#">T</a>
                    <a href="#">I</a>
                    <a href="#">Y</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Bohol Island Tours. All Rights Reserved.</p>
            <div class="payment-methods">
                <span>Payment methods:</span>
                <span>Visa</span>
                <span>Mastercard</span>
                <span>GCash</span>
                <span>PayPal</span>
            </div>
        </div>
    </div>
</footer>

<!-- Facebook Messenger Chat Plugin -->
<div id="fb-root"></div>
<div id="fb-customer-chat" class="fb-customerchat"></div>
<script>
    // Replace with your Facebook Page ID
    (function initMessengerChat() {
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute('page_id', '137067352998686'); // TODO: set your real Page ID
        chatbox.setAttribute('attribution', 'biz_inbox');
        // Optional theme color (match your brand)
        // chatbox.setAttribute('theme_color', '#0d6efd');
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

<!-- Floating Facebook Button -->
<a
    href="https://www.facebook.com/boholislandtours.ph"
    class="floating-fb-btn"
    aria-label="Open our Facebook Page"
    target="_blank"
    rel="noopener noreferrer"
>
    <span class="floating-fb-icon" aria-hidden="true">
        <!-- Inline SVG Facebook icon -->
        <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.312h3.587l-.467 3.622h-3.12V24h6.116C23.403 24 24 23.403 24 22.676V1.325C24 .597 23.403 0 22.675 0z"/>
        </svg>
    </span>
</a>


