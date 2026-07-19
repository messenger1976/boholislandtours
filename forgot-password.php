<?php
$pageTitle = 'Forgot Password | Bohol Island Tours';
$pageDescription = 'Reset your password';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;"><div class="container">
            <h1>Forgot Your Password?</h1>
            <p>Enter your email address and we'll send you a link to reset your password</p>
        </div>
</section>

<main class="content-section">
        <div class="container">
            <div class="registration-container" style="max-width: 500px; margin: 0 auto;">
                <h2>Reset Password</h2>
                <p style="text-align: center; color: #666; margin-bottom: 2rem;">
                    No worries! Enter your email address and we'll send you instructions to reset your password.
                </p>
                
                <form id="forgot-password-form" class="minimal-form">
                    <div class="form-group-contact">
                        <label for="reset-email">Email Address</label>
                        <input type="email" id="reset-email" placeholder="Enter your registered email address" required autocomplete="email">
                    </div>
                    
                    <button type="submit" class="cta-button" style="width: 100%;">Send Reset Link</button>

                    <p class="form-subtext" style="text-align: center; margin-top: 1.5rem;">
                        Remember your password? <a href="login.php" style="color: #b2945b; font-weight: 500;">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;

$extraScripts = file_get_contents(__DIR__ . '/includes/_extra_forgot-password.html');
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
