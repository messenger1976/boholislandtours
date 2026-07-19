<?php
/**
 * Shared <head> for Bohol Island Tours public pages.
 *
 * Expected (optional) vars before include:
 *   $pageTitle, $pageDescription, $pageKeywords, $canonicalUrl
 *   $ogImage, $extraHead (raw HTML), $bodyClass
 *   $includeFlatpickr (bool), $includeSwiper (bool)
 */
if (!isset($pageTitle)) {
    $pageTitle = 'Bohol Island Tours | Premium Bohol Travel & Tour Packages';
}
if (!isset($pageDescription)) {
    $pageDescription = 'Experience Bohol\'s natural wonders with affordable tour packages! Explore Chocolate Hills, Tarsier Sanctuary, Loboc River, island hopping & more.';
}
if (!isset($pageKeywords)) {
    $pageKeywords = 'Bohol tours, Bohol travel packages, Chocolate Hills tour, Tarsier Sanctuary, Loboc River cruise, Bohol island hopping';
}
if (!isset($canonicalUrl)) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'www.boholislandtours.com';
    $uri = isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
    $canonicalUrl = $scheme . '://' . $host . $uri;
}
if (!isset($ogImage)) {
    $ogImage = 'images/chocolate-hills.jpg';
}
if (!isset($includeFlatpickr)) {
    $includeFlatpickr = false;
}
if (!isset($includeSwiper)) {
    $includeSwiper = false;
}
if (!isset($extraHead)) {
    $extraHead = '';
}
$h = static function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};
if (!function_exists('asset_v')) {
    /**
     * Append the file's last-modified time as a cache-busting version query.
     * Browsers refetch the asset automatically whenever the file changes.
     */
    function asset_v($path)
    {
        $full = __DIR__ . '/../' . ltrim($path, '/');
        $ver = is_file($full) ? filemtime($full) : null;
        return $ver ? $path . '?v=' . $ver : $path;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title><?php echo $h($pageTitle); ?></title>
    <meta name="description" content="<?php echo $h($pageDescription); ?>">
    <meta name="keywords" content="<?php echo $h($pageKeywords); ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="<?php echo $h($canonicalUrl); ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $h($canonicalUrl); ?>">
    <meta property="og:title" content="<?php echo $h($pageTitle); ?>">
    <meta property="og:description" content="<?php echo $h($pageDescription); ?>">
    <meta property="og:image" content="<?php echo $h($ogImage); ?>">
    <meta property="og:site_name" content="Bohol Island Tours">
    <meta property="og:locale" content="en_PH">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $h($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo $h($pageDescription); ?>">
    <meta name="twitter:image" content="<?php echo $h($ogImage); ?>">

    <meta name="theme-color" content="#0e3a5d">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="geo.region" content="PH-BOH">
    <meta name="geo.placename" content="Tagbilaran City, Bohol">

    <link rel="manifest" href="manifest.json">
    <link rel="icon" type="image/png" href="images/favicon-logo.png">
    <link rel="apple-touch-icon" href="images/favicon-logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php if (!empty($includeSwiper)): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<?php endif; ?>
<?php if (!empty($includeFlatpickr)): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo $h(asset_v('assets/css/theme.css')); ?>">
<?php if ($extraHead !== ''): ?>
    <?php echo $extraHead; ?>
<?php endif; ?>
</head>
