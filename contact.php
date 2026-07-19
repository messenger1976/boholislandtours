<?php
$pageTitle = 'Contact Us | Bohol Island Tours';
$pageDescription = 'Get in touch for bookings, inquiries, and customized tour arrangements.';
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg');">
    <div class="container">
        <h1>Contact Us</h1>
        <p class="lead mb-0 opacity-90">Bookings, inquiries &amp; customized tour arrangements</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="bi bi-phone"></i></div>
                    <h5>Smart</h5>
                    <p class="mb-1"><a href="tel:+639125298818">+63 912 529 8818</a></p>
                    <p class="mb-0"><a href="tel:+639190805294">+63 919 080 5294</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="bi bi-phone-fill"></i></div>
                    <h5>Globe</h5>
                    <p class="mb-0"><a href="tel:+639179507562">+63 917 950 7562</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="bi bi-envelope"></i></div>
                    <h5>Email</h5>
                    <p class="mb-0"><a href="mailto:boholislandtours@gmail.com">boholislandtours@gmail.com</a></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm contact-form-centered">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h4 text-center mb-2">Booking and Inquiry Form</h2>
                        <p class="text-center text-muted mb-4">Send us a message — or call/email to arrange your Bohol tour.</p>
                        <div id="contact-form-alert" class="alert" style="display:none;"></div>
                        <form action="#" class="minimal-form" id="contact-form">
                            <div class="row g-3 form-grid-2">
                                <div class="col-md-6 form-group-contact">
                                    <label for="contact-first-name">*First Name</label>
                                    <input type="text" id="contact-first-name" name="first_name" placeholder="First Name" required maxlength="75">
                                </div>
                                <div class="col-md-6 form-group-contact">
                                    <label for="contact-last-name">*Last Name</label>
                                    <input type="text" id="contact-last-name" name="last_name" placeholder="Last Name" required maxlength="75">
                                </div>
                            </div>
                            <div class="form-group-contact mt-3">
                                <label for="contact-email">*Email</label>
                                <input type="email" id="contact-email" name="email" placeholder="your.email@example.com" required maxlength="255">
                            </div>
                            <div class="form-group-contact mt-3">
                                <label for="contact-subject">*Subject</label>
                                <input type="text" id="contact-subject" name="subject" placeholder="Subject" required maxlength="255">
                            </div>
                            <div class="form-group-contact mt-3">
                                <label for="contact-phone">*Telephone/Cellphone No.</label>
                                <input type="tel" id="contact-phone" name="phone" placeholder="+63 XXX XXX XXXX" required maxlength="50">
                            </div>
                            <div class="form-group-contact mt-3">
                                <label for="contact-message">*Message</label>
                                <textarea id="contact-message" name="message" placeholder="Your message or inquiry..." rows="6" required maxlength="5000"></textarea>
                            </div>
                            <div class="form-group-contact bg-light p-3 rounded-3 my-3">
                                <h3 class="h6">Itinerary Options</h3>
                                <p class="small text-muted">For customized tours, include details in the message box above.</p>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="include-guide" name="include_guide">
                                    <label class="form-check-label" for="include-guide">Include a Professional Tour Guide</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="include-accommodations" name="include_accommodations">
                                    <label class="form-check-label" for="include-accommodations">Include Accommodations</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent w-100 cta-button" id="contact-submit-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-map-section mt-5">
            <h2 class="h4 text-center mb-3">Our Location</h2>
            <div class="ratio ratio-21x9 rounded-4 overflow-hidden shadow">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15720.198338965688!2d123.84650532997193!3d9.65651921313175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aa4db4591a2e79%3A0x869b0c74b1f6365!2sTagbilaran%20City%2C%20Bohol!5e0!3m2!1sen!2sph!4v1729352771569!5m2!1sen!2sph"
                    class="google-map"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$extraScripts = <<<'JS'
<script>
(function () {
    var form = document.getElementById('contact-form');
    if (!form) return;
    var alertBox = document.getElementById('contact-form-alert');
    var submitBtn = document.getElementById('contact-submit-btn');
    function showAlert(type, message) {
        if (!alertBox) return;
        alertBox.style.display = 'block';
        alertBox.className = 'alert alert-' + (type === 'success' ? 'success' : 'danger');
        alertBox.textContent = message;
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (typeof API === 'undefined') { showAlert('danger', 'API not loaded. Please refresh.'); return; }
        var first = (document.getElementById('contact-first-name').value || '').trim();
        var last = (document.getElementById('contact-last-name').value || '').trim();
        var email = (document.getElementById('contact-email').value || '').trim();
        var subject = (document.getElementById('contact-subject').value || '').trim();
        var phone = (document.getElementById('contact-phone').value || '').trim();
        var message = (document.getElementById('contact-message').value || '').trim();
        var includeGuide = document.getElementById('include-guide').checked;
        var includeAccommodations = document.getElementById('include-accommodations').checked;
        var name = (first + ' ' + last).trim();
        if (!name || !email || !subject || !phone || !message) {
            showAlert('danger', 'Please fill in all required fields.');
            return;
        }
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        try {
            var result = await API.request('inquiry/submit', {
                method: 'POST',
                body: JSON.stringify({
                    name: name, email: email, subject: subject, phone: phone, message: message,
                    include_guide: includeGuide, include_accommodations: includeAccommodations
                })
            });
            if (result && result.success) {
                showAlert('success', result.message || 'Thank you! Your message has been sent.');
                form.reset();
            } else {
                showAlert('danger', (result && result.message) ? result.message : 'Could not send your message.');
            }
        } catch (err) {
            showAlert('danger', (err && err.message) ? err.message : 'Could not send your message. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send Message';
        }
    });
})();
</script>
JS;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
