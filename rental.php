<?php
$pageTitle = 'Car & Van Rental Bohol | Professional Drivers | Bohol Island Tours';
$pageDescription = 'Rent a car, van, coaster or bus in Bohol with professional driver-guides. Safe transfers to Chocolate Hills, Panglao, Danao, Anda and more.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/chocolate-hills.jpg');">
    <div class="container">
        <h1>Car / Van / Coaster / Bus Rental</h1>
        <p class="lead mb-0 opacity-90">Modern fleet · Professional driver-guides · Island-wide transfers</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Fleet</span>
            <h2 class="section-title">Our Vehicles</h2>
            <p class="section-subtitle">Safe, air-conditioned vehicles for couples, families, and large groups.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100"><div class="feature-icon"><i class="bi bi-car-front"></i></div><h5>Toyota Vios</h5><p class="small text-muted mb-0">Ideal for couples &amp; small groups</p></div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100"><div class="feature-icon"><i class="bi bi-bus-front"></i></div><h5>Toyota Hi Ace</h5><p class="small text-muted mb-0">Comfortable van for families</p></div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100"><div class="feature-icon"><i class="bi bi-bus-front-fill"></i></div><h5>Toyota Grandia</h5><p class="small text-muted mb-0">Spacious premium van</p></div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100"><div class="feature-icon"><i class="bi bi-truck-front"></i></div><h5>51-Seater Bus</h5><p class="small text-muted mb-0">Fully A/C — educational &amp; big groups</p></div>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-lg-7">
                <h3>Destinations We Serve</h3>
                <div class="row g-2">
                    <?php
                    $places = ['Chocolate Hills / Countryside','Danao Adventure Park','Danao Sea of Clouds','Panglao Island','Mirror of the World / Bohollywood','Anda / Cabagnow Cave Pool','Can-umantad Falls','Alicia Panoramic','City Tour','Dimiao Twin Falls','Airport / Seaport / Hotel transfers'];
                    foreach ($places as $p): ?>
                    <div class="col-md-6"><div class="p-3 bg-light rounded-3"><i class="bi bi-geo-alt-fill text-teal me-2"></i><?php echo htmlspecialchars($p); ?></div></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="booking-widget">
                    <h5>Get a Rental Quote</h5>
                    <p class="small text-muted">Rates include vehicle, driver, and gas. Other destinations priced by distance/duration.</p>
                    <p class="mb-3"><i class="bi bi-envelope me-2"></i><a href="mailto:boholislandtours@gmail.com">boholislandtours@gmail.com</a></p>
                    <a href="contact.php" class="btn btn-accent w-100">Request Quotation</a>
                </div>
                <div class="mt-3 p-3 rounded-3 border">
                    <h6>Why rent with us?</h6>
                    <ul class="small mb-0">
                        <li>Safe modern vehicles</li>
                        <li>Drivers who double as tour guides</li>
                        <li>Organized, on-time transfers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
<?php include __DIR__ . '/includes/scripts.php'; ?>
</body></html>
