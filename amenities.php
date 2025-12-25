<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="Discover the amenities and services at BODARE Pension House">
    <meta name="theme-color" content="#b2945b">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BODARE">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Amenities - BODARE Pension House</title>
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="manifest.json">
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="img/logo.png">
    <link rel="icon" type="image/png" href="img/logo.png">
    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Jost:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <section class="page-header" style="background-image: url('img/ambassador.jpg');">
        <div class="page-header-content">
            <h1>Our Amenities</h1>
            <p>Services and facilities designed for your comfort and convenience.</p>
        </div>
    </section>

    <main class="content-section">
        <div class="container">
            <div class="amenities-grid">
                
                <div class="amenity-card">
                    <span class="icon">📶</span>
                    <h3>High-Speed WiFi</h3>
                    <p>Stay connected with complimentary high-speed internet access available in all rooms and public areas.</p>
                </div>

                <div class="amenity-card">
                    <span class="icon">🅿️</span>
                    <h3>Free Parking</h3>
                    <p>Enjoy the convenience of free, secured on-site parking for all our registered guests.</p>
                </div>

                <div class="amenity-card">
                    <span class="icon">🛎️</span>
                    <h3>24-Hour Front Desk</h3>
                    <p>Our team is available around the clock to assist with check-in, check-out, and any requests you may have.</p>
                </div>

                <div class="amenity-card">
                    <span class="icon">❄️</span>
                    <h3>Air Conditioning</h3>
                    <p>All rooms are equipped with individually controlled air conditioning for your personal comfort.</p>
                </div>

                <div class="amenity-card">
                    <span class="icon">📺</span>
                    <h3>Cable Television</h3>
                    <p>Unwind with a wide selection of local and international channels on your in-room flat-screen TV.</p>
                </div>

                <div class="amenity-card">
                    <span class="icon">🚿</span>
                    <h3>Private Bathrooms</h3>
                    <p>Each room features a clean, private bathroom complete with hot and cold showers and essential toiletries.</p>
                </div>
                
            </div>
        </div>
    </main>

<?php include 'footer.php'; ?>
    
    <script src="api-config.js"></script>
    <script src="script.js"></script>
    <script>
        // Check login status and update header button
        async function updateLoginButton() {
            const loginBtn = document.getElementById('login-account-btn');
            const accountBtn = document.getElementById('my-account-btn');
            
            if (!loginBtn || !accountBtn) return;
            
            try {
                if (typeof API !== 'undefined') {
                    const response = await API.auth.check();
                    if (response.success && response.logged_in) {
                        loginBtn.style.display = 'none';
                        accountBtn.style.display = 'inline-block';
                    } else {
                        loginBtn.style.display = 'inline-block';
                        accountBtn.style.display = 'none';
                    }
                } else {
                    loginBtn.style.display = 'inline-block';
                    accountBtn.style.display = 'none';
                }
            } catch (error) {
                loginBtn.style.display = 'inline-block';
                accountBtn.style.display = 'none';
            }
        }
        
        if (typeof API !== 'undefined') {
            updateLoginButton();
        } else {
            window.addEventListener('load', () => {
                if (typeof API !== 'undefined') {
                    updateLoginButton();
                }
            });
        }
        
        // Register Service Worker for PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('ServiceWorker registration successful:', registration.scope);
                    })
                    .catch((error) => {
                        console.log('ServiceWorker registration failed:', error);
                    });
            });
        }
    </script>
</body>
</html>
