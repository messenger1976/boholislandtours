<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#eaf5ee">
    <title><?php echo isset($title) ? html_escape($title) : 'Account Activation'; ?> - Bohol Island Tours</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <?php
        $public_base = preg_replace('#/admin/?$#', '/', rtrim(base_url(), '/'));
        $logo_url = $public_base . 'images/favicon-logo.png';
        $favicon_url = $public_base . 'images/favicon-logo.png';
        $is_success = !empty($success);
    ?>
    <link rel="icon" href="<?php echo html_escape($favicon_url); ?>">
    <style>
        :root {
            --ink: #1f3a2e;
            --ink-soft: #355647;
            --gold: #3f8f6b;
            --gold-soft: #6bb890;
            --sand: #f3faf5;
            --paper: #ffffff;
            --muted: #5d7368;
            --line: #d7e8de;
            --danger: #c0392b;
            --ok: #1f7a4d;
            --radius: 1rem;
            --shadow: 0 16px 40px rgba(31, 58, 46, 0.1);
            --safe-top: env(safe-area-inset-top, 0px);
            --safe-bottom: env(safe-area-inset-bottom, 0px);
            --safe-left: env(safe-area-inset-left, 0px);
            --safe-right: env(safe-area-inset-right, 0px);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            height: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
            min-height: 100%;
            min-height: 100dvh;
            font-family: "Manrope", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(120% 80% at 8% -5%, rgba(107, 184, 144, 0.22), transparent 52%),
                radial-gradient(90% 70% at 100% 100%, rgba(63, 143, 107, 0.14), transparent 48%),
                linear-gradient(160deg, #f7fcf9 0%, #eaf5ee 48%, #e3f1e8 100%);
            display: flex;
            align-items: stretch;
            justify-content: center;
            padding:
                max(1rem, var(--safe-top))
                max(1rem, var(--safe-right))
                max(1rem, var(--safe-bottom))
                max(1rem, var(--safe-left));
        }

        .login-shell {
            width: 100%;
            max-width: 26rem;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            animation: rise-in 0.55s ease both;
        }

        .brand-strip {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--ink);
            padding: 0.25rem 0.15rem;
        }

        .brand-strip img {
            height: 2.75rem;
            width: auto;
            max-width: 7.5rem;
            object-fit: contain;
            border-radius: 0.45rem;
            background: #fff;
            border: 1px solid var(--line);
            padding: 0.2rem 0.35rem;
        }

        .brand-strip .brand-text {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .brand-strip .brand-name {
            font-family: "Fraunces", Georgia, serif;
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 0.01em;
        }

        .brand-strip .brand-tag {
            font-size: 0.78rem;
            color: var(--muted);
            font-weight: 500;
        }

        .login-card {
            background: var(--paper);
            border-radius: calc(var(--radius) + 0.15rem);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid rgba(63, 143, 107, 0.12);
        }

        .login-intro {
            padding: 1.35rem 1.25rem 0.35rem;
        }

        .login-intro h1 {
            margin: 0;
            font-family: "Fraunces", Georgia, serif;
            font-size: clamp(1.45rem, 5vw, 1.75rem);
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.02em;
        }

        .login-intro p {
            margin: 0.4rem 0 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .login-body {
            padding: 1rem 1.25rem 1.35rem;
        }

        .result-panel {
            text-align: center;
            padding: 0.35rem 0 0.25rem;
        }

        .result-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3.75rem;
            height: 3.75rem;
            border-radius: 999px;
            font-size: 1.85rem;
            margin-bottom: 0.85rem;
        }

        .result-icon.is-success {
            background: #e8f6ee;
            color: var(--ok);
        }

        .result-icon.is-error {
            background: #fdecea;
            color: var(--danger);
        }

        .result-panel h2 {
            margin: 0;
            font-family: "Fraunces", Georgia, serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.02em;
        }

        .result-panel p {
            margin: 0.55rem auto 1.25rem;
            max-width: 22rem;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .auth-foot a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 650;
            font-size: 0.9rem;
        }

        .auth-foot a:hover {
            color: #2f7355;
            text-decoration: underline;
            text-underline-offset: 0.15em;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            min-height: 3.05rem;
            border: none;
            border-radius: 0.85rem;
            background: linear-gradient(135deg, #3f8f6b 0%, #57a882 100%);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.01em;
            box-shadow: 0 10px 22px rgba(63, 143, 107, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            -webkit-tap-highlight-color: transparent;
            text-decoration: none;
        }

        .btn-login:hover {
            color: #fff;
            transform: translateY(-1px);
            background: linear-gradient(135deg, #57a882 0%, #3f8f6b 100%);
            box-shadow: 0 14px 28px rgba(63, 143, 107, 0.28);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:focus-visible {
            outline: 3px solid rgba(107, 184, 144, 0.5);
            outline-offset: 2px;
        }

        .auth-foot {
            text-align: center;
            margin-top: 1.15rem;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .login-note {
            text-align: center;
            color: var(--muted);
            font-size: 0.78rem;
            padding: 0 0.35rem;
        }

        @keyframes rise-in {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 640px) {
            body {
                padding:
                    max(1.5rem, var(--safe-top))
                    max(1.5rem, var(--safe-right))
                    max(1.5rem, var(--safe-bottom))
                    max(1.5rem, var(--safe-left));
            }

            .login-shell {
                max-width: 28.5rem;
            }

            .login-intro {
                padding: 1.75rem 1.75rem 0.5rem;
            }

            .login-body {
                padding: 1rem 1.75rem 1.75rem;
            }
        }

        @media (min-width: 960px) {
            body {
                align-items: center;
            }

            .login-shell {
                max-width: 56rem;
                display: grid;
                grid-template-columns: 1.05fr 1fr;
                gap: 0;
                background: #fff;
                border: 1px solid rgba(63, 143, 107, 0.12);
                border-radius: 1.35rem;
                overflow: hidden;
                box-shadow: var(--shadow);
            }

            .brand-panel {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 2rem;
                min-height: 32rem;
                background:
                    radial-gradient(circle at 18% 18%, rgba(107, 184, 144, 0.28), transparent 42%),
                    linear-gradient(155deg, #f2faf5 0%, #e5f4eb 55%, #dcefe4 100%);
                color: var(--ink);
                border-right: 1px solid rgba(63, 143, 107, 0.1);
            }

            .brand-strip {
                padding: 0;
            }

            .brand-panel .panel-copy h2 {
                margin: 2rem 0 0.75rem;
                font-family: "Fraunces", Georgia, serif;
                font-size: 2rem;
                line-height: 1.15;
                font-weight: 700;
                letter-spacing: -0.02em;
                color: var(--ink);
            }

            .brand-panel .panel-copy p {
                margin: 0;
                max-width: 23rem;
                color: var(--muted);
                line-height: 1.55;
                font-size: 0.95rem;
            }

            .brand-panel .spot-list {
                list-style: none;
                margin: 1.35rem 0 0;
                padding: 0;
                display: grid;
                gap: 0.55rem;
            }

            .brand-panel .spot-list li {
                display: flex;
                align-items: flex-start;
                gap: 0.55rem;
                font-size: 0.88rem;
                color: var(--ink-soft);
                line-height: 1.35;
            }

            .brand-panel .spot-list i {
                color: var(--gold);
                margin-top: 0.12rem;
                flex-shrink: 0;
            }

            .brand-panel .panel-meta {
                font-size: 0.82rem;
                color: var(--muted);
            }

            .login-card {
                border: none;
                border-radius: 0;
                box-shadow: none;
                display: flex;
                flex-direction: column;
                justify-content: center;
                background: var(--paper);
            }

            .login-note {
                display: none;
            }

            .mobile-brand {
                display: none;
            }
        }

        @media (max-width: 959.98px) {
            .brand-panel {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .login-shell,
            .btn-login {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <aside class="brand-panel">
            <div class="brand-strip">
                <img src="<?php echo html_escape($logo_url); ?>" alt="">
                <div class="brand-text">
                    <span class="brand-name">Bohol Island Tours</span>
                    <span class="brand-tag">Tours · Stays · Car rental</span>
                </div>
            </div>
            <div class="panel-copy">
                <?php if ($is_success): ?>
                    <h2>You’re ready to help guests explore Bohol</h2>
                    <p>Your staff account is active. Sign in to manage tours, stays, and island transfers.</p>
                <?php else: ?>
                    <h2>We couldn’t finish activating this account</h2>
                    <p>Activation links expire for security. Register again or ask an administrator for help.</p>
                <?php endif; ?>
                <ul class="spot-list">
                    <li><i class="bi bi-geo-alt-fill" aria-hidden="true"></i><span>Chocolate Hills &amp; countryside highlights</span></li>
                    <li><i class="bi bi-geo-alt-fill" aria-hidden="true"></i><span>Tarsier Sanctuary &amp; Loboc River cruise</span></li>
                    <li><i class="bi bi-geo-alt-fill" aria-hidden="true"></i><span>Panglao beaches &amp; island hopping</span></li>
                    <li><i class="bi bi-geo-alt-fill" aria-hidden="true"></i><span>Danao adventure &amp; Anda cave pools</span></li>
                    <li><i class="bi bi-truck" aria-hidden="true"></i><span>Car, van &amp; coaster rentals with drivers</span></li>
                </ul>
            </div>
            <div class="panel-meta">
                <?php echo $is_success ? 'Staff access is ready' : 'Activation links can expire'; ?>
            </div>
        </aside>

        <div class="mobile-brand brand-strip">
            <img src="<?php echo html_escape($logo_url); ?>" alt="Bohol Island Tours">
            <div class="brand-text">
                <span class="brand-name">Bohol Island Tours</span>
                <span class="brand-tag">Tours · Stays · Car rental</span>
            </div>
        </div>

        <div class="login-card">
            <div class="login-intro">
                <h1>Account activation</h1>
                <p><?php echo $is_success ? 'Your email link was verified successfully.' : 'Something went wrong with this activation link.'; ?></p>
            </div>
            <div class="login-body">
                <div class="result-panel">
                    <?php if ($is_success): ?>
                        <div class="result-icon is-success" aria-hidden="true">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2>Account activated</h2>
                    <?php else: ?>
                        <div class="result-icon is-error" aria-hidden="true">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <h2>Activation failed</h2>
                    <?php endif; ?>

                    <p><?php echo html_escape(isset($message) ? $message : ''); ?></p>

                    <?php if ($is_success): ?>
                        <a href="<?php echo site_url('login'); ?>" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                            <span>Go to sign in</span>
                        </a>
                        <div class="auth-foot">
                            Need a different account?
                            <a href="<?php echo site_url('register'); ?>">Create account</a>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo site_url('register'); ?>" class="btn btn-login">
                            <i class="bi bi-person-plus" aria-hidden="true"></i>
                            <span>Register again</span>
                        </a>
                        <div class="auth-foot">
                            Already activated?
                            <a href="<?php echo site_url('login'); ?>">Sign in</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <p class="login-note"><?php echo $is_success ? 'Staff access is ready' : 'Activation links can expire'; ?></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
