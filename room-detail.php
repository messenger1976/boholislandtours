<?php
$pageTitle = 'Room Details | Bohol Island Tours';
$pageDescription = 'View room details and reserve your stay.';
$includeFlatpickr = true;
$includeApiConfig = true;
$extraHead = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.css">';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="room-hero page-hero" style="background-image: url('https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop'); min-height: 36vh;"></section>

<section class="section pt-4">
    <div class="container">
        <div class="row g-4 room-layout">
            <div class="col-lg-7 room-details-main">
                <h1 id="room-title">Executive Room</h1>
                <div class="room-specs d-flex flex-wrap gap-3 mb-4 text-muted">
                    <span><i class="bi bi-people me-1"></i><span id="room-capacity">Good for 4 persons</span></span>
                    <span><i class="bi bi-arrows-fullscreen me-1"></i> 10ft Size</span>
                    <span><i class="bi bi-lamp me-1"></i> Normal Beds</span>
                </div>
                <div class="room-image-grid row g-2 mb-4" id="room-image-grid-container"></div>
                <p class="room-description">
                    Spacious and elegantly appointed, the Executive Room is designed for guests seeking extra comfort and space. It provides a relaxing sanctuary with modern amenities, perfect for families or business travelers.
                </p>
                <h3 class="h5 mt-4">Room Amenities</h3>
                <div class="amenities-grid row g-2">
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Cable TV</div></div>
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Shower</div></div>
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Safe box</div></div>
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Free WiFi</div></div>
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Work Desk</div></div>
                    <div class="col-6 col-md-4"><div class="amenity-item p-3 bg-light rounded-3">Bathtub</div></div>
                </div>
            </div>

            <div class="col-lg-5">
                <aside class="booking-widget" id="booking-widget">
                    <div class="widget-header mb-3">
                        <h2 class="h4 mb-1">Reserve</h2>
                        <p class="mb-0 text-muted">From <span id="room-price-display"><strong>₱1,999</strong> / night</span></p>
                    </div>
                    <form class="widget-form" id="booking-form-widget">
                        <div class="row g-3 date-inputs mb-2">
                            <div class="col-6">
                                <label class="form-label" for="checkin-widget">Check In</label>
                                <input type="date" class="form-control" id="checkin-widget" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="checkout-widget">Check Out</label>
                                <input type="date" class="form-control" id="checkout-widget" required>
                            </div>
                        </div>
                        <div id="date-error-message" class="alert alert-danger py-2 small" style="display:none;"></div>

                        <div class="counters-grid row g-3 mb-3">
                            <div class="col-6 guest-inputs">
                                <label class="form-label">Adults</label>
                                <div class="counter input-group" data-min="1">
                                    <button type="button" class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="1" readonly id="adults-count">
                                    <button type="button" class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="col-6 guest-inputs">
                                <label class="form-label">Children</label>
                                <div class="counter input-group" data-min="0">
                                    <button type="button" class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="0" readonly id="children-count">
                                    <button type="button" class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="col-6 guest-inputs">
                                <label class="form-label">Rooms</label>
                                <div class="counter input-group" data-min="1">
                                    <button type="button" class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="1" readonly id="room-count-input">
                                    <button type="button" class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="col-6 guest-inputs">
                                <label class="form-label">Extra Bed</label>
                                <div class="counter input-group" data-min="0" data-cost="500">
                                    <button type="button" class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="0" readonly>
                                    <button type="button" class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="total-cost d-flex justify-content-between align-items-center p-3 bg-light rounded-3 mb-3">
                            <h3 class="h6 mb-0">Total Cost</h3>
                            <span id="total-cost-display" class="fs-5 fw-bold text-primary">₱1,999</span>
                        </div>

                        <button type="submit" class="btn btn-accent w-100 cta-button">Add to Cart</button>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</section>

<div id="lightbox-modal" class="lightbox">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightbox-image" alt="">
</div>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$includeFlatpickr = true;
$extraScripts = '<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>';
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
