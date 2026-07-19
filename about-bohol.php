<?php
$pageTitle = 'About Bohol Island | Complete Guide to Bohol Philippines Tourism';
$pageDescription = 'Learn about Bohol: climate, language, money, how to get there by air, sea and land — your complete travel guide.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/chocolate-hills.jpg');">
    <div class="container">
        <h1>About Bohol Island</h1>
        <p class="lead mb-0 opacity-90">Your complete guide to traveling in Bohol, Philippines</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <span class="section-badge">Why Bohol?</span>
                <h2>The Island of Wonders</h2>
                <p>Bohol is the 10th-largest island in the Philippines and one of its top tourist destinations — home to the Chocolate Hills, white-sand beaches, rich culture, and warm hospitality.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $cards = [
                ['bi-translate', 'Language', 'Boholano, English, and Tagalog are widely spoken.'],
                ['bi-sun', 'Climate', 'Tropical. Dry season Nov–Apr (amihan). May–Jul hot/humid; Aug–Oct rainy (habagat).'],
                ['bi-clock', 'Philippine Time', 'UTC+8 — eight hours ahead of GMT.'],
                ['bi-bag-check', 'What to Bring', 'Light clothing, sun protection, comfortable shoes, beach gear, insect repellent, modest attire for churches.'],
                ['bi-cash', 'Money', 'Philippine Peso. USD often accepted. Cards at major spots — carry small bills.'],
                ['bi-building', 'Business Hours', 'Banks 9–3 Mon–Fri. Shops typically 9–8. Government offices 8–5 weekdays.'],
            ];
            foreach ($cards as $c): ?>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="bi <?php echo $c[0]; ?>"></i></div>
                    <h5><?php echo $c[1]; ?></h5>
                    <p class="small text-muted mb-0"><?php echo $c[2]; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100"><div class="card-body">
                    <h5><i class="bi bi-signpost-2 me-2 text-teal"></i>By Land</h5>
                    <p class="small text-muted mb-0">Buses, jeepneys, taxis, multicabs, tricycles, and habal-habal around Tagbilaran and beyond.</p>
                </div></div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100"><div class="card-body">
                    <h5><i class="bi bi-water me-2 text-teal"></i>By Sea</h5>
                    <p class="small text-muted mb-0">Fastcraft and ferries (Ocean Jet, SuperCat, Weesam, and more) connect Bohol to Cebu and neighboring islands.</p>
                </div></div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100"><div class="card-body">
                    <h5><i class="bi bi-airplane me-2 text-teal"></i>By Air</h5>
                    <p class="small text-muted mb-0">Bohol-Panglao International Airport with flights from Manila and other hubs (~1 hour from Manila).</p>
                </div></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-sand"><div class="container"><div class="cta-banner">
    <h2 class="mb-3">Planning your Bohol trip?</h2>
    <p class="mb-4 opacity-90">We're here Mon–Sun 8AM–6PM to help with packages, rentals, and transfers.</p>
    <a href="contact.php" class="btn btn-light btn-lg me-2">Contact Us</a>
    <a href="package1.php" class="btn btn-outline-light btn-lg">View Packages</a>
</div></div></section>

<?php include __DIR__ . '/footer.php'; ?>
<?php include __DIR__ . '/includes/scripts.php'; ?>
</body></html>
