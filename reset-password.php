<?php
$pageTitle = 'Reset Password | Bohol Island Tours';
$pageDescription = 'Set a new password';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;"><div class="container">
            <h1>Reset Your Password</h1>
            <p>Enter your new password below</p>
        </div>
</section>

<main class="content-section">
        <div class="container">
            <div class="registration-container" style="max-width: 500px; margin: 0 auto;">
                <h2>Set New Password</h2>
                
                <div id="token-error" style="display: none; padding: 1rem; margin: 1rem 0; border-radius: 4px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                    <p id="token-error-message"></p>
                </div>
                
                <form id="reset-password-form" class="minimal-form" style="display: none;">
                    <div class="form-group-contact">
                        <label for="reset-password">New Password</label>
                        <input type="password" id="reset-password" placeholder="Enter your new password" required autocomplete="new-password" minlength="6">
                        <small style="color: #666; font-size: 0.9em;">Password must be at least 6 characters long</small>
                    </div>
                    
                    <div class="form-group-contact">
                        <label for="reset-confirm-password">Confirm New Password</label>
                        <input type="password" id="reset-confirm-password" placeholder="Confirm your new password" required autocomplete="new-password" minlength="6">
                    </div>
                    
                    <button type="submit" class="cta-button" style="width: 100%;">Reset Password</button>

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

$extraScripts = file_get_contents(__DIR__ . '/includes/_extra_reset-password.html');
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
