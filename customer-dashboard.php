<?php
$pageTitle = 'My Dashboard | Bohol Island Tours';
$pageDescription = 'Manage bookings and profile';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:28vh;"><div class="container">
            <h1>My Dashboard</h1>
            <p>Manage your account, bookings, and inquiries</p>
        </div>
</section>

<main class="content-section">
        <div class="container">
            
            <!-- No JavaScript Warning -->
            <noscript>
                <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    <strong>JavaScript Required:</strong> This page requires JavaScript to function properly. Please enable JavaScript in your browser settings.
                </div>
            </noscript>
            
            <!-- Dashboard Tabs -->
            <div class="dashboard-tabs" style="
                display: flex;
                gap: 0.5rem;
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 2rem;
                flex-wrap: wrap;
            ">
                <button class="tab-button active" data-tab="bookings" style="
                    padding: 1rem 2rem;
                    background: none;
                    border: none;
                    border-bottom: 3px solid transparent;
                    cursor: pointer;
                    font-size: 1rem;
                    font-weight: 500;
                    color: #666;
                    transition: all 0.3s;
                ">My Bookings</button>
                <button class="tab-button" data-tab="profile" style="
                    padding: 1rem 2rem;
                    background: none;
                    border: none;
                    border-bottom: 3px solid transparent;
                    cursor: pointer;
                    font-size: 1rem;
                    font-weight: 500;
                    color: #666;
                    transition: all 0.3s;
                ">My Profile</button>
                <button class="tab-button" data-tab="inquiry" style="
                    padding: 1rem 2rem;
                    background: none;
                    border: none;
                    border-bottom: 3px solid transparent;
                    cursor: pointer;
                    font-size: 1rem;
                    font-weight: 500;
                    color: #666;
                    transition: all 0.3s;
                ">Send Inquiry</button>
            </div>

            <!-- Bookings Tab Content -->
            <div id="bookings-tab" class="tab-content active">
                <div id="bookings-container">
                    <div class="loading-message" style="text-align: center; padding: 2rem; color: #666;">
                        <p>Loading your bookings...</p>
                    </div>
                </div>
            </div>
            
            <!-- Error message container -->
            <div id="dashboard-error" style="display: none; text-align: center; padding: 2rem; background: #f8d7da; color: #721c24; border-radius: 8px; margin: 1rem 0;">
                <p id="error-message"></p>
            </div>

            <!-- Profile Tab Content -->
            <div id="profile-tab" class="tab-content" style="display: none;">
                <div class="registration-container">
                    <h2>Update Your Information</h2>
                    <form id="profile-form" class="minimal-form">
                        <h3 style="margin-bottom: 1rem; color: #1a2238; font-size: 1.25rem;">Personal Information</h3>
                        <div class="form-grid-2">
                            <div class="form-group-contact">
                                <input type="text" id="profile-first-name" placeholder="First Name *" required>
                            </div>
                            <div class="form-group-contact">
                                <input type="text" id="profile-last-name" placeholder="Last Name *" required>
                            </div>
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group-contact">
                                <input type="email" id="profile-email" placeholder="Email Address *" required>
                            </div>
                            <div class="form-group-contact">
                                <input type="tel" id="profile-phone" placeholder="Phone Number *" required>
                            </div>
                        </div>
                        <div class="form-grid-3">
                            <div class="form-group-contact">
                                <input type="date" id="profile-date-of-birth" placeholder="Date of Birth">
                                <label for="profile-date-of-birth" style="display: block; margin-top: 0.5rem; font-size: 0.875rem; color: #666;">Date of Birth</label>
                            </div>
                            <div class="form-group-contact">
                                <select id="profile-gender" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-family: inherit;">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group-contact">
                                <input type="text" id="profile-nationality" placeholder="Nationality (e.g., Filipino)">
                            </div>
                        </div>
                        
                        <h3 style="margin: 2rem 0 1rem 0; color: #1a2238; font-size: 1.25rem;">Address Information</h3>
                        <div class="form-group-contact">
                            <textarea id="profile-address" placeholder="Street Address *" rows="2" required></textarea>
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group-contact">
                                <input type="text" id="profile-city" placeholder="City">
                            </div>
                            <div class="form-group-contact">
                                <input type="text" id="profile-province" placeholder="Province">
                            </div>
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group-contact">
                                <input type="text" id="profile-postal-code" placeholder="Postal Code">
                            </div>
                            <div class="form-group-contact">
                                <input type="text" id="profile-country" placeholder="Country" value="Philippines">
                            </div>
                        </div>
                        
                        <h3 style="margin: 2rem 0 1rem 0; color: #1a2238; font-size: 1.25rem;">Identification (Optional)</h3>
                        <div class="form-grid-2">
                            <div class="form-group-contact">
                                <select id="profile-id-type" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-family: inherit;">
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
                            <div class="form-group-contact">
                                <input type="text" id="profile-id-number" placeholder="ID Number">
                            </div>
                        </div>
                        
                        <h3 style="margin: 2rem 0 1rem 0; color: #1a2238; font-size: 1.25rem;">Account Security</h3>
                        <div class="form-group-contact">
                            <input type="password" id="profile-password" placeholder="New Password (leave blank to keep current)">
                        </div>
                        <div class="form-group-contact">
                            <input type="password" id="profile-confirm-password" placeholder="Confirm New Password">
                        </div>
                        
                        <button type="submit" class="cta-button">Update Profile</button>
                    </form>
                </div>
            </div>

            <!-- Inquiry Tab Content -->
            <div id="inquiry-tab" class="tab-content" style="display: none;">
                <div class="registration-container">
                    <h2>Send Us an Inquiry</h2>
                    <p style="color: #666; margin-bottom: 1.5rem;">Have a question or need assistance? Fill out the form below and we'll get back to you as soon as possible.</p>
                    <form id="inquiry-form" class="minimal-form">
                        <div class="form-group-contact">
                            <label for="inquiry-subject">Subject</label>
                            <input type="text" id="inquiry-subject" placeholder="What is your inquiry about?" required>
                        </div>
                        <div class="form-group-contact">
                            <label for="inquiry-message">Message</label>
                            <textarea id="inquiry-message" rows="6" placeholder="Please provide details about your inquiry..." required style="
                                width: 100%;
                                padding: 0.75rem;
                                border: 1px solid #ddd;
                                border-radius: 4px;
                                font-family: inherit;
                                font-size: 1rem;
                                resize: vertical;
                            "></textarea>
                        </div>
                        
                        <button type="submit" class="cta-button">Send Inquiry</button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$includeBookingApi = true;

$extraScripts = file_get_contents(__DIR__ . '/includes/_extra_customer-dashboard.html');
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
