<?php
$pageTitle = 'Bohol Island Tours | Premium Bohol Travel & Tour Packages';
$pageDescription = 'Experience Bohol\'s natural wonders with affordable tour packages! Explore Chocolate Hills, Tarsier Sanctuary, Loboc River, island hopping at Balicasag, dolphin watching & more.';
$includeSwiper = true;
$extraHead = <<<'HTML'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TouristDestination",
  "name": "Bohol Island Tours",
  "url": "https://www.boholislandtours.com/",
  "telephone": "+639125298818",
  "email": "boholislandtours@gmail.com"
}
</script>
HTML;
include __DIR__ . '/includes/head.php';
?>
<body class="has-transparent-header">
<?php include __DIR__ . '/header.php'; ?>

<!-- Hero Slider -->
<section id="home" class="hero-swiper swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image:url('images/manmade-forest.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Bohol Highlights</span>
                <h1>Man-Made Forest</h1>
                <p>Drive through the iconic mahogany forest corridor — a living tunnel of green on your countryside adventure.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/chocolate-hills.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Must See</span>
                <h1>Chocolate Hills</h1>
                <p>Witness over a thousand cone-shaped hills that turn chocolate-brown in the dry season — Bohol's signature wonder.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/tarsiers.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Wildlife</span>
                <h1>Tarsier Sanctuary</h1>
                <p>Meet one of the world's smallest primates in a protected sanctuary dedicated to their conservation.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/loboc-river-cruise.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Culture</span>
                <h1>Loboc River Cruise</h1>
                <p>Float past lush riverbanks with a Filipino buffet lunch and live cultural entertainment.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/panglao-beach.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Beach Escape</span>
                <h1>Panglao Paradise</h1>
                <p>Relax on powdery white sand beaches with crystal-clear waters perfect for swimming and snorkeling.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/island.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Adventure</span>
                <h1>Island Hopping</h1>
                <p>Explore Balicasag, Virgin Island, and vibrant marine sanctuaries on an unforgettable day at sea.</p>
            </div>
        </div>
        <div class="swiper-slide" style="background-image:url('images/blood-compact.jpg');">
            <div class="slide-overlay"></div>
            <div class="container hero-content">
                <span class="badge bg-secondary mb-3">Heritage</span>
                <h1>Blood Compact Site</h1>
                <p>Walk through history at the landmark of the first international treaty of friendship in the Philippines.</p>
            </div>
        </div>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
</section>

<!-- Unified Tour Search -->
<div class="container">
    <div class="tour-search-card reveal">
        <form class="booking-form" id="tourSearchForm" action="#" method="post">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label" for="destination">Destination</label>
                    <select class="form-select" name="destination" id="destination" required>
                        <option value="">Choose destination</option>
                        <option value="chocolate-hills">Chocolate Hills</option>
                        <option value="panglao">Panglao Beach</option>
                        <option value="tarsier">Tarsier Sanctuary</option>
                        <option value="loboc">Loboc River</option>
                        <option value="island-hopping">Island Hopping</option>
                        <option value="countryside">Countryside Tour</option>
                        <option value="full-package">Full Package Tours</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="travel-date">Travel Date</label>
                    <input type="date" class="form-control" name="travel-date" id="travel-date" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="tourists">Tourists</label>
                    <select class="form-select" name="tourists" id="tourists">
                        <option value="1">1 Person</option>
                        <option value="2" selected>2 Persons</option>
                        <option value="3">3 Persons</option>
                        <option value="4">4 Persons</option>
                        <option value="5">5+ Persons</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-accent w-100">
                        <i class="bi bi-search me-1"></i> Find Tours
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- About -->
<section id="about" class="section">
    <div class="container">
        <div class="text-center mb-2 reveal">
            <span class="section-badge">Why Travel With Us</span>
            <h2 class="section-title">Discover Bohol with Us</h2>
            <p class="section-subtitle">From the iconic Chocolate Hills to pristine beaches, we craft unforgettable journeys across this tropical paradise.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-compass"></i></div>
                    <h4>Expert Guides</h4>
                    <p class="mb-0 text-muted">Professional local guides with deep knowledge of Bohol's culture and history.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                    <h4>Safe Travel</h4>
                    <p class="mb-0 text-muted">Licensed operators and your safety as our top priority every step of the way.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-calendar-check"></i></div>
                    <h4>Flexible Scheduling</h4>
                    <p class="mb-0 text-muted">Customizable tour dates and durations that fit your travel plans.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-star"></i></div>
                    <h4>Premium Experience</h4>
                    <p class="mb-0 text-muted">Quality accommodations, transport, and exclusive curated experiences.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-cash-coin"></i></div>
                    <h4>Best Value</h4>
                    <p class="mb-0 text-muted">Competitive pricing with no hidden fees — transparent packages you can trust.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-heart"></i></div>
                    <h4>Personalized Service</h4>
                    <p class="mb-0 text-muted">Tailored experiences that match your interests and travel style.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Packages -->
<section id="tours" class="section section-sand">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Handpicked Adventures</span>
            <h2 class="section-title">Popular Tour Packages</h2>
            <p class="section-subtitle">Choose from day trips to multi-day island experiences — all designed for unforgettable memories.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-clock me-1"></i> Full Day</span>
                    <span class="price-badge">₱1,500</span>
                    <img src="images/chocolate-hills.jpg" class="card-img-top" alt="Chocolate Hills Adventure">
                    <div class="card-body">
                        <h5 class="card-title">Chocolate Hills Adventure</h5>
                        <p class="card-text text-muted small">Transport, guide, entrance fees &amp; lunch included.</p>
                        <a href="package1.php" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-clock me-1"></i> Full Day</span>
                    <span class="price-badge">₱2,200</span>
                    <img src="images/panglao-beach.jpg" class="card-img-top" alt="Panglao Beach Paradise">
                    <div class="card-body">
                        <h5 class="card-title">Panglao Beach Paradise</h5>
                        <p class="card-text text-muted small">Boat transfer, beach activities, snorkeling &amp; lunch.</p>
                        <a href="destinations.php#panglao-island" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-clock me-1"></i> Half Day</span>
                    <span class="price-badge">₱1,800</span>
                    <img src="images/tarsiers.jpg" class="card-img-top" alt="Tarsier & Wildlife Tour">
                    <div class="card-body">
                        <h5 class="card-title">Tarsier &amp; Wildlife Tour</h5>
                        <p class="card-text text-muted small">Transport, guide, sanctuary entry &amp; photo session.</p>
                        <a href="destinations.php#countryside" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-clock me-1"></i> Half Day</span>
                    <span class="price-badge">₱1,300</span>
                    <img src="images/loboc-river-cruise.jpg" class="card-img-top" alt="Loboc River Experience">
                    <div class="card-body">
                        <h5 class="card-title">Loboc River Experience</h5>
                        <p class="card-text text-muted small">River cruise, buffet lunch &amp; cultural show.</p>
                        <a href="destinations.php#countryside" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-clock me-1"></i> Full Day</span>
                    <span class="price-badge">₱2,500</span>
                    <img src="images/island.jpg" class="card-img-top" alt="Bohol Island Hopping">
                    <div class="card-body">
                        <h5 class="card-title">Bohol Island Hopping</h5>
                        <p class="card-text text-muted small">Multiple islands, snorkeling, marine life &amp; lunch.</p>
                        <a href="destinations.php#island-hopping" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="card tour-card position-relative">
                    <span class="duration-badge"><i class="bi bi-moon-stars me-1"></i> Multi-Day</span>
                    <span class="price-badge">From ₱3,500</span>
                    <img src="images/bohol-overview.jpg" class="card-img-top" alt="Complete Bohol Packages" onerror="this.src='images/chocolate-hills.jpg'">
                    <div class="card-body">
                        <h5 class="card-title">Complete Island Packages</h5>
                        <p class="card-text text-muted small">2–5 day packages with lodging, tours &amp; transfers.</p>
                        <a href="package2.php" class="btn btn-outline-primary btn-sm">Explore Packages</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 reveal">
            <a href="package1.php" class="btn btn-primary me-2">View All Packages</a>
            <a href="contact.php" class="btn btn-outline-primary">Get a Custom Quote</a>
        </div>
    </div>
</section>

<!-- Destinations preview -->
<section id="destinations" class="section">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Explore</span>
            <h2 class="section-title">Top Destinations</h2>
            <p class="section-subtitle">Iconic places that make Bohol one of the Philippines' most loved islands.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <a href="destinations.php#countryside" class="text-decoration-none">
                    <div class="card dest-card position-relative">
                        <img src="images/chocolate-hills.jpg" class="card-img-top" alt="Countryside">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Countryside Tour</h5>
                            <p class="small text-muted mb-0">Chocolate Hills, Tarsiers, Loboc River &amp; more</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 reveal">
                <a href="destinations.php#panglao-island" class="text-decoration-none">
                    <div class="card dest-card">
                        <img src="images/panglao-beach.jpg" class="card-img-top" alt="Panglao">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Panglao Island</h5>
                            <p class="small text-muted mb-0">Beaches, diving &amp; island vibes</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 reveal">
                <a href="destinations.php#island-hopping" class="text-decoration-none">
                    <div class="card dest-card">
                        <img src="images/island.jpg" class="card-img-top" alt="Island Hopping">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Island Hopping</h5>
                            <p class="small text-muted mb-0">Balicasag, Virgin Island &amp; snorkeling</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="section section-ocean">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-count="15">0</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-label">Happy Travelers</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-count="40">0</div>
                    <div class="stat-label">Tour Destinations</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number" data-count="98">0</div>
                    <div class="stat-label">Satisfaction Rate %</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video -->
<section id="video" class="section video-section section-sand">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Watch</span>
            <h2 class="section-title">Experience Bohol's Magic</h2>
            <p class="section-subtitle">A glimpse of the adventure, culture, and natural beauty awaiting you.</p>
        </div>
        <div class="video-wrapper reveal">
            <video autoplay loop muted playsinline>
                <source src="video/bohol-video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Reviews</span>
            <h2 class="section-title">What Travelers Say</h2>
            <p class="section-subtitle">Real stories from guests who explored Bohol with us.</p>
        </div>
        <div class="swiper testimonials-swiper reveal">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p>"The Chocolate Hills tour was breathtaking! Our guide was knowledgeable and the whole day was seamless."</p>
                        <div class="author">
                            <div class="author-avatar">MR</div>
                            <div><strong>Maria R.</strong><br><small class="text-muted">Manila, Philippines</small></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p>"Island hopping exceeded expectations. Crystal waters, great lunch, and a very professional crew."</p>
                        <div class="author">
                            <div class="author-avatar">JK</div>
                            <div><strong>James K.</strong><br><small class="text-muted">Singapore</small></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                        <p>"Booked the 3D2N package — perfect mix of countryside, beaches, and downtime. Highly recommended!"</p>
                        <div class="author">
                            <div class="author-avatar">AL</div>
                            <div><strong>Anna L.</strong><br><small class="text-muted">Seoul, Korea</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section-sand pt-0">
    <div class="container">
        <div class="cta-banner reveal">
            <h2 class="mb-3">Ready for Your Bohol Adventure?</h2>
            <p class="mb-4 opacity-90">Tell us your dates and group size — we'll craft the perfect itinerary for you.</p>
            <a href="contact.php" class="btn btn-light btn-lg me-2">Get a Free Quote</a>
            <a href="package1.php" class="btn btn-outline-light btn-lg">Browse Packages</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>

<?php
$includeSwiper = true;
$extraScripts = <<<'JS'
<script>
(function () {
    var form = document.getElementById('tourSearchForm');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var destination = form.querySelector('[name="destination"]').value;
        var travelDate = form.querySelector('[name="travel-date"]').value;
        var tourists = form.querySelector('[name="tourists"]').value || '1';
        if (!destination) { alert('Please select a destination.'); return; }
        if (!travelDate) { alert('Please select a travel date.'); return; }
        var travel = new Date(travelDate);
        var now = new Date(); now.setHours(0,0,0,0);
        if (travel < now) { alert('Travel date cannot be in the past.'); return; }
        var btn = form.querySelector('button[type="submit"]');
        var original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Finding Tours...';
        try {
            localStorage.setItem('tourSearchData', JSON.stringify({
                destination: destination,
                travelDate: travelDate,
                tourists: tourists,
                timestamp: new Date().toISOString()
            }));
        } catch (err) {}
        var tours = document.getElementById('tours');
        if (tours) tours.scrollIntoView({ behavior: 'smooth' });
        setTimeout(function () {
            btn.disabled = false;
            btn.innerHTML = original;
            alert('Tour search completed! Check out our available packages below.');
        }, 800);
    });
})();
</script>
JS;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
