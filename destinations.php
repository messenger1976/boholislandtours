<?php
$pageTitle = 'Bohol Destinations & Tours | Countryside, Panglao, Island Hopping | Bohol Island Tours';
$pageDescription = 'Explore Bohol destinations: Countryside tour, Danao Adventure Park, Mirror of the World, Can-umantad Falls, Panglao Island, and Island Hopping.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/chocolate-hills.jpg');">
    <div class="container">
        <h1>Bohol Destinations</h1>
        <p class="lead mb-0 opacity-90">Iconic tours across the island — from Chocolate Hills to turquoise waters</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4 mb-5" id="countryside">
            <div class="col-lg-6"><img src="img/boholcountrysidetour.png" class="img-fluid rounded-4 shadow" alt="Countryside Tour" onerror="this.src='images/chocolate-hills.jpg'"></div>
            <div class="col-lg-6">
                <span class="section-badge">Full Day</span>
                <h2>Country Side Tour</h2>
                <p>Discover Bohol's iconic inland wonders: Chocolate Hills, Tarsier Sanctuary, Loboc River cruise, Baclayon Church, Manmade Forest, and more.</p>
                <ul class="mb-4"><li>Chocolate Hills viewpoint</li><li>Tarsier Sanctuary</li><li>Loboc River buffet lunch cruise</li><li>Blood Compact &amp; Baclayon Church</li></ul>
                <a href="contact.php" class="btn btn-primary">Inquire Now</a>
            </div>
        </div>

        <div class="row g-4 mb-5 flex-lg-row-reverse" id="danao-adventure-park">
            <div class="col-lg-6"><img src="img/danaoadventureparktour.png" class="img-fluid rounded-4 shadow" alt="Danao Adventure" onerror="this.src='images/chocolate-hills.jpg'"></div>
            <div class="col-lg-6">
                <span class="section-badge">Adventure</span>
                <h2>Danao Adventure Park</h2>
                <p>Extreme thrills at Danao — zipline, canyon swing, river activities, caving, and more for adrenaline seekers.</p>
                <a href="contact.php" class="btn btn-primary">Book Adventure</a>
            </div>
        </div>

        <div class="row g-4 mb-5" id="mirror-of-the-world">
            <div class="col-lg-6"><img src="img/mirroroftheworldtour.png" class="img-fluid rounded-4 shadow" alt="Mirror of the World" onerror="this.src='images/chocolate-hills.jpg'"></div>
            <div class="col-lg-6">
                <span class="section-badge">Photo Spot</span>
                <h2>Mirror of the World</h2>
                <p>Miniature world landmarks and Bohollywood film sets in Loay — perfect for photos and family fun.</p>
                <a href="contact.php" class="btn btn-primary">Inquire Now</a>
            </div>
        </div>

        <div class="row g-4 mb-5 flex-lg-row-reverse" id="can-umantad-falls">
            <div class="col-lg-6"><img src="img/canumantadfallsandandatour.png" class="img-fluid rounded-4 shadow" alt="Can-umantad Falls" onerror="this.src='images/island.jpg'"></div>
            <div class="col-lg-6">
                <span class="section-badge">Nature</span>
                <h2>Can-umantad Falls &amp; Anda</h2>
                <p>Waterfall trek in Candijay plus Anda's white-sand beaches and cave pools — a scenic east-coast escape.</p>
                <a href="contact.php" class="btn btn-primary">Inquire Now</a>
            </div>
        </div>

        <div class="row g-4 mb-5" id="panglao-island">
            <div class="col-lg-6"><img src="img/panglaoislandtour.png" class="img-fluid rounded-4 shadow" alt="Panglao" onerror="this.src='images/panglao-beach.jpg'"></div>
            <div class="col-lg-6">
                <span class="section-badge">Beach</span>
                <h2>Panglao Island Tour</h2>
                <p>Hinagdanan Cave, Bohol Bee Farm, Alona Beach, Dauis Church, and island vibes — diving and snorkeling nearby.</p>
                <a href="contact.php" class="btn btn-primary">Inquire Now</a>
            </div>
        </div>

        <div class="row g-4" id="island-hopping">
            <div class="col-lg-6"><img src="images/island.jpg" class="img-fluid rounded-4 shadow" alt="Island Hopping"></div>
            <div class="col-lg-6">
                <span class="section-badge">Sea Adventure</span>
                <h2>Island Hopping Tour</h2>
                <p>Early dolphin watching, Balicasag snorkeling among turtles and coral, and sandbar stops — a must-do day at sea.</p>
                <a href="contact.php" class="btn btn-primary me-2">Inquire Now</a>
                <a href="index.php#tours" class="btn btn-outline-primary">View Packages</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-sand"><div class="container"><div class="cta-banner">
    <h2 class="mb-3">Want a custom destination combo?</h2>
    <a href="contact.php" class="btn btn-light btn-lg me-2">Contact Us</a>
    <a href="package1.php" class="btn btn-outline-light btn-lg">View Tour Packages</a>
</div></div></section>

<?php include __DIR__ . '/footer.php'; ?>
<?php include __DIR__ . '/includes/scripts.php'; ?>
</body></html>
