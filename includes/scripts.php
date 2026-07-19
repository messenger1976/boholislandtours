<?php
/**
 * Shared footer scripts for public pages.
 *
 * Optional flags before include:
 *   $includeApiConfig, $includeBookingApi, $includeScriptJs (default true)
 *   $includeFlatpickr, $includeSwiper
 *   $extraScripts (raw HTML)
 */
if (!isset($includeApiConfig)) {
    $includeApiConfig = false;
}
if (!isset($includeBookingApi)) {
    $includeBookingApi = false;
}
if (!isset($includeScriptJs)) {
    $includeScriptJs = true;
}
if (!isset($includeFlatpickr)) {
    $includeFlatpickr = false;
}
if (!isset($includeSwiper)) {
    $includeSwiper = false;
}
if (!isset($extraScripts)) {
    $extraScripts = '';
}
?>
<button type="button" class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="bi bi-chevron-up"></i>
</button>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if (!empty($includeSwiper)): ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php endif; ?>
<?php if (!empty($includeFlatpickr)): ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php endif; ?>
<script src="assets/js/theme.js"></script>
<?php if (!empty($includeApiConfig)): ?>
<script src="api-config.js"></script>
<?php endif; ?>
<?php if (!empty($includeBookingApi)): ?>
<script src="booking-api.js"></script>
<?php endif; ?>
<?php if (!empty($includeScriptJs)): ?>
<script src="script.js"></script>
<?php endif; ?>
<?php if ($extraScripts !== ''): ?>
<?php echo $extraScripts; ?>
<?php endif; ?>
