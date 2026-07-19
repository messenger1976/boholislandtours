<?php
$pageTitle = 'Login | Bohol Island Tours';
$pageDescription = 'Login to your account';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;"><div class="container">
            <h1>Login to Your Account</h1>
            <p>Access your bookings and manage your reservations</p>
        </div>
</section>

<main class="content-section">
        <div class="container">
            <div class="registration-container" style="max-width: 500px; margin: 0 auto;">
                <h2>Login to Your Account</h2>
                <p style="text-align: center; color: #666; margin-bottom: 2rem;">Enter your credentials to access your dashboard</p>
                <form id="login-form" class="minimal-form">
                    <div class="form-group-contact">
                        <label for="login-email-input">Email Address</label>
                        <input type="email" id="login-email-input" placeholder="Enter your email address" required autocomplete="email">
                    </div>
                    <div class="form-group-contact">
                        <label for="login-password-input">Password</label>
                        <input type="password" id="login-password-input" placeholder="Enter your password" required autocomplete="current-password">
                    </div>
                    
                    <button type="submit" class="cta-button" style="width: 100%;">Login</button>

                    <p class="form-subtext" style="text-align: center; margin-top: 1rem;">
                        <a href="forgot-password.php" style="color: #b2945b; font-weight: 500; font-size: 0.95em;">Forgot your password?</a>
                    </p>

                    <p class="form-subtext" style="text-align: center; margin-top: 1.5rem;">
                        Don't have an account? <a href="registration.php" style="color: #b2945b; font-weight: 500;">Create one here</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$includeBookingApi = true;

$extraScripts = file_get_contents(__DIR__ . '/includes/_extra_login.html');
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
