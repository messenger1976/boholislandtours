<?php
$pageTitle = 'Booking Confirmation | Bohol Island Tours';
$pageDescription = 'Your booking has been confirmed.';
$includeApiConfig = true;
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;">
    <div class="container">
        <h1>Booking Confirmed!</h1>
        <p class="lead mb-0 opacity-90">Thank you for your reservation</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="steps-indicator mb-4">
            <div class="step done">Select</div>
            <div class="step done">Cart</div>
            <div class="step done">Checkout</div>
            <div class="step active">Confirm</div>
        </div>
        <div id="confirmation-container" class="mx-auto" style="max-width:800px;">
            <div class="loading-message text-center py-5 text-muted">
                <div class="spinner-border text-primary mb-3"></div>
                <p>Loading booking details...</p>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$extraScripts = <<<'JS'
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const params = new URLSearchParams(window.location.search);
    const bookingNumber = params.get('booking') || localStorage.getItem('booking_number');
    const container = document.getElementById('confirmation-container');
    if (!bookingNumber) {
        container.innerHTML = `<div class="text-center py-5 text-danger"><h3>Booking not found</h3><p>Invalid booking number.</p><a href="rooms.php" class="btn btn-primary cta-button mt-3">Browse Rooms</a></div>`;
        return;
    }
    try {
        const response = await API.booking.getByNumber(bookingNumber);
        if (response.success && response.booking) {
            const booking = response.booking;
            const fmt = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            container.innerHTML = `
                <div class="alert alert-success text-center shadow-sm">
                    <h2 class="h4 mb-2">Your booking has been confirmed!</h2>
                    <p class="mb-0 fs-5">Booking Number: <strong>${booking.booking_number}</strong></p>
                </div>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">Booking Details</h3>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6"><strong>Room</strong><br>${booking.room_name} (${booking.room_type})</div>
                            <div class="col-md-6"><strong>Guests</strong><br>${booking.guests} guest(s)</div>
                            <div class="col-md-6"><strong>Check-In</strong><br>${new Date(booking.check_in).toLocaleDateString('en-US', fmt)}</div>
                            <div class="col-md-6"><strong>Check-Out</strong><br>${new Date(booking.check_out).toLocaleDateString('en-US', fmt)}</div>
                            <div class="col-md-6"><strong>Status</strong><br><span class="badge bg-secondary status-badge status-${booking.status}">${booking.status}</span></div>
                            <div class="col-md-6"><strong>Total Amount</strong><br><span class="fs-5 fw-bold text-primary">₱${parseFloat(booking.total_amount).toLocaleString('en-US', {minimumFractionDigits: 2})}</span></div>
                        </div>
                        <hr>
                        <h4 class="h6">Guest Information</h4>
                        <p class="mb-1"><strong>Name:</strong> ${booking.guest_name}</p>
                        <p class="mb-1"><strong>Email:</strong> ${booking.guest_email}</p>
                        <p class="mb-0"><strong>Phone:</strong> ${booking.guest_phone}</p>
                        ${booking.notes ? `<hr><h4 class="h6">Special Requests</h4><p>${booking.notes}</p>` : ''}
                    </div>
                </div>
                <div class="alert alert-warning">
                    <h4 class="h6">Important Information</h4>
                    <ul class="mb-0 small">
                        <li>Your booking is currently <strong>${booking.status}</strong>. You will receive a confirmation email shortly.</li>
                        <li>Please arrive during check-in hours (typically 2:00 PM).</li>
                        <li>To modify or cancel, contact us with your booking number.</li>
                        <li>Payment will be collected at the hotel upon check-in (unless paid online).</li>
                    </ul>
                </div>
                <div class="text-center">
                    <a href="customer-dashboard.php" class="btn btn-primary cta-button me-2">View All Bookings</a>
                    <a href="index.php" class="btn btn-outline-primary cta-button-secondary">Back to Home</a>
                </div>`;
        } else {
            throw new Error('Booking not found');
        }
    } catch (error) {
        container.innerHTML = `<div class="text-center py-5 text-danger"><h3>Error loading booking</h3><p>${error.message || 'Please try again later.'}</p><a href="rooms.php" class="btn btn-primary cta-button mt-3">Browse Rooms</a></div>`;
    }
});
</script>
<style>
.status-pending { background: #fff3cd !important; color: #856404 !important; }
.status-confirmed { background: #d4edda !important; color: #155724 !important; }
.status-cancelled { background: #f8d7da !important; color: #721c24 !important; }
.status-completed { background: #d1ecf1 !important; color: #0c5460 !important; }
</style>
JS;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
