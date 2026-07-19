<?php
$pageTitle = '5 Days 4 Nights Bohol Tour Package | Ultimate Experience | Bohol Island Tours';
$pageDescription = 'Ultimate 5 Days 4 Nights Bohol tour with countryside, island hopping, Panglao, Danao and free days. Hotels & transport included.';
$canonicalUrl = 'https://www.boholislandtours.com/package4.php';
$ogImage = 'images/island.jpg';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/island.jpg');">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php#tours">Packages</a></li>
            <li class="breadcrumb-item active">5D/4N</li>
        </ol></nav>
        <h1>5 Days 4 Nights Bohol Tour</h1>
        <p class="lead mb-0 opacity-90">The complete island experience · From ₱3,000</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <span class="section-badge">Ultimate Package</span>
                <h2 class="mb-3">Five Days / Four Nights (5D/4N)</h2>
                <p class="text-muted">Our most complete itinerary — countryside, islands, beaches, adventure, and leisure days.</p>
                <div class="accordion itinerary-accordion mt-4" id="plansAccordion">
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#planA"><span class="day-badge">A</span> Classic Complete</button></h2>
                        <div id="planA" class="accordion-collapse collapse show" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Island hop AM / free PM · D4 Panglao (10am–2pm) · D5 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planB"><span class="day-badge">B</span> With Free Day</button></h2>
                        <div id="planB" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Island hop · D4 Free · D5 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planC"><span class="day-badge">C</span> Countryside + Panglao</button></h2>
                        <div id="planC" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Panglao · D4 Free · D5 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planD"><span class="day-badge">D</span> Countryside + Danao</button></h2>
                        <div id="planD" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Check-in · D2 Countryside · D3 Danao · D4 Free · D5 Checkout</li></ul></div></div></div>
                    <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#planE"><span class="day-badge">E</span> Full Combo</button></h2>
                        <div id="planE" class="accordion-collapse collapse" data-bs-parent="#plansAccordion"><div class="accordion-body"><ul class="mb-0"><li>D1 Panglao · D2 Countryside · D3 Island hop AM · D4 Danao · D5 Checkout</li></ul></div></div></div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-md-6"><div class="card border-0 shadow-sm h-100"><div class="card-body"><h5 class="text-success">Inclusions</h5><ul class="small mb-0"><li>4 nights accommodation</li><li>Private transport &amp; guide</li><li>Loboc cruise lunch</li><li>Listed entrance fees &amp; transfers</li></ul></div></div></div>
                    <div class="col-md-6"><div class="card border-0 shadow-sm h-100"><div class="card-body"><h5 class="text-danger">Exclusions</h5><ul class="small mb-0"><li>Airfare / ferry</li><li>Other meals</li><li>Optional Danao/ATV fees</li></ul></div></div></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="booking-widget">
                    <h5>Request a Quotation</h5>
                    <p class="mb-2"><span class="badge bg-primary">From ₱3,000</span> <span class="badge bg-secondary">up to ₱6,500</span></p>
                    <a href="contact.php" class="btn btn-accent w-100 mb-2">Contact Us for Quotation</a>
                    <a href="package3.php" class="btn btn-outline-primary btn-sm w-100">See 4D/3N Package</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-sand"><div class="container"><div class="cta-banner"><h2 class="mb-3">Ready for the ultimate Bohol trip?</h2><a href="contact.php" class="btn btn-light btn-lg">Get Your Free Quote</a></div></div></section>
<?php include __DIR__ . '/footer.php'; ?>
<?php include __DIR__ . '/includes/scripts.php'; ?>
</body></html>
