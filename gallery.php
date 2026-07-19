<?php
$pageTitle = 'Gallery | Bohol Island Tours';
$pageDescription = 'A glimpse into the comfort and style that awaits you.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('img/ambassador.jpg');">
    <div class="container">
        <h1>Our Gallery</h1>
        <p class="lead mb-0 opacity-90">A glimpse into the comfort and style that awaits you</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="row g-3 gallery-grid">
            <?php
            $images = [
                ['img/dormitory.jpg', 'Dormitory'],
                ['img/standard.jpg', 'Standard Room'],
                ['img/deluxeb.jpg', 'Deluxe B Room'],
                ['img/deluxea.jpg', 'Deluxe A Room'],
                ['img/ambassador.jpg', 'Ambassador Room'],
                ['img/executive.jpg', 'Executive Room'],
            ];
            foreach ($images as $img): ?>
            <div class="col-6 col-md-4">
                <div class="gallery-item">
                    <img src="<?php echo $img[0]; ?>" alt="<?php echo htmlspecialchars($img[1]); ?>" class="gallery-image">
                    <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<div id="lightbox-modal" class="lightbox">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightbox-image" alt="">
</div>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
