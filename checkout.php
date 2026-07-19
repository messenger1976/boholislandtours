<?php
$pageTitle = 'Checkout | Bohol Island Tours';
$pageDescription = 'Review and confirm your booking.';
$includeFlatpickr = true;
$includeApiConfig = true;
$includeBookingApi = true;
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;">
    <div class="container">
        <h1>Booking Summary</h1>
        <p class="lead mb-0 opacity-90">Review your details and confirm your reservation</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="steps-indicator">
            <div class="step done"><i class="bi bi-check-lg"></i> Select</div>
            <div class="step done"><i class="bi bi-cart"></i> Cart</div>
            <div class="step active"><i class="bi bi-credit-card"></i> Checkout</div>
            <div class="step"><i class="bi bi-check-circle"></i> Confirm</div>
        </div>

        <div class="row g-4 checkout-layout">
            <div class="col-lg-7 checkout-form">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="checkout-auth-header d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                            <h2 class="h4 mb-0" id="auth-header-title">Login to Continue</h2>
                            <div id="auth-buttons" class="d-flex gap-2 flex-wrap">
                                <a href="login.php" id="login-link" class="btn btn-outline-primary btn-sm cta-button-secondary">Login</a>
                                <a href="registration.php" id="register-link" class="btn btn-outline-primary btn-sm cta-button-secondary">Register</a>
                            </div>
                            <div id="logged-in-info" style="display:none;">
                                <p class="mb-2 text-muted">Logged in as: <strong id="logged-in-name"></strong></p>
                                <button type="button" id="logout-button" class="btn btn-outline-secondary btn-sm cta-button-secondary">Logout</button>
                            </div>
                        </div>

                        <form action="#" id="checkout-login-form" class="minimal-form" novalidate>
                            <div id="login-fields">
                                <div class="mb-3 form-group-contact">
                                    <label class="form-label" for="login-email">Email Address</label>
                                    <input type="email" class="form-control" id="login-email" placeholder="Email Address" required>
                                </div>
                                <div class="mb-3 form-group-contact">
                                    <label class="form-label" for="login-password">Password</label>
                                    <input type="password" class="form-control" id="login-password" placeholder="Password" required>
                                </div>
                                <button type="button" id="login-button" class="btn btn-primary cta-button">Login</button>
                            </div>

                            <div id="account-info-section" style="display:none;">
                                <h2 class="h5 mt-4">Account Information</h2>
                                <p class="text-muted small">Please review and update your information if needed.</p>
                                <div class="account-info-form">
                                    <h3 class="h6 text-primary mt-3">Personal Information</h3>
                                    <div class="row g-3 form-grid-2">
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-first-name">First Name</label>
                                            <input type="text" class="form-control" id="account-first-name" placeholder="First Name *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-last-name">Last Name</label>
                                            <input type="text" class="form-control" id="account-last-name" placeholder="Last Name *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-email">Email Address</label>
                                            <input type="email" class="form-control" id="account-email" placeholder="Email Address *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-phone">Contact Number</label>
                                            <input type="tel" class="form-control" id="account-phone" placeholder="Phone Number *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-gender">Gender</label>
                                            <select class="form-select" id="account-gender">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-nationality">Nationality</label>
                                            <input type="text" class="form-control" id="account-nationality" placeholder="Nationality (e.g., Filipino)">
                                        </div>
                                    </div>

                                    <h3 class="h6 text-primary mt-4">Address Information</h3>
                                    <div class="mb-3 form-group-contact">
                                        <label class="form-label" for="account-address">Street Address</label>
                                        <textarea class="form-control" id="account-address" placeholder="Street Address *" rows="2" required></textarea>
                                    </div>
                                    <div class="row g-3 form-grid-2">
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-city">City *</label>
                                            <input type="text" class="form-control" id="account-city" placeholder="City *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-province">Province *</label>
                                            <input type="text" class="form-control" id="account-province" placeholder="Province *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-postal-code">Zip/Postal Code *</label>
                                            <input type="text" class="form-control" id="account-postal-code" placeholder="Zip/Postal Code *" required>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-country">Country *</label>
                                            <input type="text" class="form-control" id="account-country" placeholder="Country *" value="Philippines" required>
                                        </div>
                                    </div>

                                    <h3 class="h6 text-primary mt-4">Identification (Optional)</h3>
                                    <div class="row g-3 form-grid-2">
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-id-type">ID Type</label>
                                            <select class="form-select" id="account-id-type">
                                                <option value="">Select ID Type</option>
                                                <option value="passport">Passport</option>
                                                <option value="driver_license">Driver's License</option>
                                                <option value="national_id">National ID</option>
                                                <option value="philhealth">PhilHealth ID</option>
                                                <option value="sss">SSS ID</option>
                                                <option value="tin">TIN ID</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="account-id-number">ID Number</label>
                                            <input type="text" class="form-control" id="account-id-number" placeholder="ID Number">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="payment-section" style="display:none;">
                                <h2 class="h5 mt-4">Payment Information</h2>
                                <div class="mb-3 form-group-contact">
                                    <label class="form-label" for="payment-method">Payment Method</label>
                                    <select id="payment-method" class="form-select form-control">
                                        <option value="pay_at_hotel">Pay at the Hotel</option>
                                        <option value="card">Credit/Debit Card</option>
                                        <option value="gcash">GCash</option>
                                    </select>
                                </div>
                                <div id="card-payment-fields" style="display:none;">
                                    <p class="text-muted small">Please enter your card details below.</p>
                                    <div class="mb-3 form-group-contact">
                                        <label class="form-label" for="card-number">Card Number</label>
                                        <input type="text" class="form-control" id="card-number" placeholder="Card Number (XXXX XXXX XXXX XXXX)" maxlength="19">
                                    </div>
                                    <div class="row g-3 form-grid-2">
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="card-expiry">Expiry Date</label>
                                            <input type="text" class="form-control" id="card-expiry" placeholder="MM / YY" maxlength="7">
                                        </div>
                                        <div class="col-md-6 form-group-contact">
                                            <label class="form-label" for="card-cvc">CVC</label>
                                            <input type="text" class="form-control" id="card-cvc" placeholder="CVC" maxlength="3">
                                        </div>
                                    </div>
                                </div>
                                <div id="pay-at-hotel-message" class="alert alert-success">
                                    <strong>Pay at the Hotel:</strong> You will pay upon arrival. We require this information to hold your room.
                                </div>
                                <button type="submit" class="btn btn-accent cta-button mt-3">Confirm Reservation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <aside class="checkout-summary">
                    <div class="summary-card" id="checkout-summary-content">
                        <!-- Summary populated from cart by script.js -->
                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$includeBookingApi = true;
$includeFlatpickr = true;
$extraScripts = file_get_contents(__DIR__ . '/includes/_checkout-script.js.tmp');
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
