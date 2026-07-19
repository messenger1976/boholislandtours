<?php
$pageTitle = '4 Days 3 Nights Bohol Tour Package | 5 Flexible Plans | Bohol Island Tours';
$pageDescription = '4 Days 3 Nights Bohol packages with countryside, island hopping, Panglao free days or Danao adventure. Hotels & transport included.';
$canonicalUrl = 'https://www.boholislandtours.com/package3.php';
$ogImage = 'images/loboc-river-cruise.jpg';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/loboc-river-cruise.jpg');">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php#tours">Packages</a></li>
            <li class="breadcrumb-item active">4D/3N</li>
        </ol></nav>
        <h1>4 Days 3 Nights Bohol Tour</h1>
        <p class="lead mb-0 opacity-90">Balanced itinerary with free time · From ₱2,500</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <span class="section-badge">Package Overview</span>
                <h2 class="mb-3">Four Days / Three Nights (4D/3N)</h2>
                <p class="text-muted">Extra nights for a relaxed pace — include a free day, island hopping, or Danao adventure.</p>
                <div class="accordion itinerary-accordion mt-4" id="plansAccordion">
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#planA"><span class="day-badge">A</span> Full Highlights</button></h2>
                        <div id="planA" class="accordion-collapse collapse show" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Island hop AM + Panglao PM · D4 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planB"><span class="day-badge">B</span> Countryside + Island Hop</button></h2>
                        <div id="planB" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Island hop AM / free PM · D4 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planC"><span class="day-badge">C</span> Panglao + Countryside + Free Day</button></h2>
                        <div id="planC" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Panglao · D2 Countryside · D3 Free day · D4 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planD"><span class="day-badge">D</span> Countryside + Free Day</button></h2>
                        <div id="planD" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Free · D4 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planE"><span class="day-badge">E</span> Countryside + Danao</button></h2>
                        <div id="planE" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Danao Adventure · D4 Checkout</li></ul></div></div></div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-6"><div class="card border-0 shadow-sm h-100"><div class="card-body"><h5 class="text-success">Inclusions</h5><ul class="small mb-0"><li>3 nights stay</li><li>Transfers &amp; guided tours</li><li>Loboc lunch cruise</li><li>Entrance fees</li></ul></div></div></div>
                    <div class="col-md-6"><div class="card border-0 shadow-sm h-100"><div class="card-body"><h5 class="text-danger">Exclusions</h5><ul class="small mb-0"><li>Airfare / ferry</li><li>Other meals</li><li>Optional activities</li></ul></div></div></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="booking-widget">
                    <h5>Request a Quotation</h5>
                    <p class="mb-2"><span class="badge bg-primary">From ₱2,500</span> <span class="badge bg-secondary">up to ₱5,500</span></p>
                    <a href="contact.php" class="btn btn-accent w-100 mb-2">Contact Us for Quotation</a>
                    <div class="d-flex gap-2"><a href="package2.php" class="btn btn-outline-primary btn-sm flex-fill">3D/2N</a><a href="package4.php" class="btn btn-outline-primary btn-sm flex-fill">5D/4N</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-sand"><div class="container"><div class="cta-banner"><h2 class="mb-3">Book your 4D/3N Bohol holiday</h2><a href="contact.php" class="btn btn-light btn-lg">Get Your Free Quote</a></div></div></section>
<?php include __DIR__ . '/footer.php'; ?>
<?php include __DIR__ . '/includes/scripts.php'; ?>
</body></html>
