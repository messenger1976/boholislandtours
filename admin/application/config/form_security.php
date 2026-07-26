<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Public form security (Contact / Inquiry)
|--------------------------------------------------------------------------
|
| Get free reCAPTCHA v3 keys at: https://www.google.com/recaptcha/admin
| Leave keys empty to skip reCAPTCHA while other protections still apply.
|
*/
$config['form_security'] = array(
	// Google reCAPTCHA v3 (invisible)
	'recaptcha_enabled' => TRUE,
	'recaptcha_site_key' => '6Ld5g2YtAAAAAJpG1_Dax3p4UteuUbnUYdPhXeE3',
	'recaptcha_secret_key' => '6Ld5g2YtAAAAAAJ8neKDwOhky7cRgLsI2DIrpDVz',
	'recaptcha_min_score' => 0.5,
	'recaptcha_expected_action' => 'contact_submit',

	// CSRF token lifetime (seconds)
	'csrf_ttl' => 7200,

	// Minimum seconds between issuing a token and accepting a submit (blocks instant bots)
	'min_submit_seconds' => 2,

	// Rate limiting per IP
	'rate_limit_max' => 5,
	'rate_limit_window' => 900, // 15 minutes
	'rate_limit_block_seconds' => 1800, // 30 minutes after exceeding limit

	// Honeypot field name (must match the hidden input name on the form)
	'honeypot_field' => 'company_url',

	// Allowed browser origins for API CORS (empty = same-host only)
	'allowed_origins' => array(),
);
