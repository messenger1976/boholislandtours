<?php
$pageTitle = 'Amenities | Bohol Island Tours';
$pageDescription = 'Services and facilities designed for your comfort and convenience.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('img/ambassador.jpg');">
    <div class="container">
        <h1>Our Amenities</h1>
        <p class="lead mb-0 opacity-90">Comfort and convenience for every guest</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="row g-4 amenities-grid">
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-wifi"></i></div><h3 class="h5">High-Speed WiFi</h3><p class="small text-muted mb-0">Complimentary high-speed internet in rooms and public areas.</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-p-square"></i></div><h3 class="h5">Free Parking</h3><p class="small text-muted mb-0">Free, secured on-site parking for registered guests.</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-bell"></i></div><h3 class="h5">24-Hour Front Desk</h3><p class="small text-muted mb-0">Around-the-clock assistance for check-in, checkout, and requests.</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-snow"></i></div><h3 class="h5">Air Conditioning</h3><p class="small text-muted mb-0">Individually controlled A/C in every room.</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-tv"></i></div><h3 class="h5">Cable Television</h3><p class="small text-muted mb-0">Local and international channels on flat-screen TVs.</p></div></div>
            <div class="col-md-6 col-lg-4"><div class="feature-card amenity-card h-100"><div class="feature-icon"><i class="bi bi-droplet"></i></div><h3 class="h5">Private Bathrooms</h3><p class="small text-muted mb-0">Hot &amp; cold showers with essential toiletries.</p></div></div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
