<?php
/**
 * Google AdSense configuration for Bohol Island Tours.
 *
 * Setup:
 * 1. Create / approve a site at https://www.google.com/adsense/
 * 2. Replace publisher_id with your ca-pub-XXXXXXXXXXXXXXXX value
 * 3. Update ads.txt at the site root with the same pub-XXXXXXXXXXXXXXXX
 * 4. (Optional) Create ad units in AdSense and paste slot IDs below
 * 5. Set enabled to true
 *
 * Auto ads work with only the publisher ID. Manual slot IDs unlock
 * fixed placements on package / destination pages.
 */
return [
    // Master switch — keep false until your publisher ID is set and site is approved
    'enabled' => true,

    // From AdSense → Account → Account information (format: ca-pub-################)
    'publisher_id' => 'ca-pub-1060012311865896',

    // Optional: AdSense site verification meta content (Ads → Sites → Get code)
    'verification_meta' => '',

    // Auto ads: Google places ads automatically when enabled in AdSense UI
    'auto_ads' => true,

    // Manual ad unit slot IDs (Ads → By ad unit → Get code → data-ad-slot)
    // Leave empty / placeholder until you create units — slots will not render.
    'slots' => [
        'sidebar' => '',       // Responsive sidebar on package pages
        'in_content' => '',    // Mid-page on destinations
        'footer' => '',        // Above footer on content pages
    ],
];
