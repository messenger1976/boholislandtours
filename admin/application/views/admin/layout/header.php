<?php
// Ensure URL helper is loaded before using base_url()
if (!function_exists('base_url') && isset($this) && is_object($this) && method_exists($this, 'load')) {
    $this->load->helper('url');
}

$public_base = preg_replace('#/admin/?$#', '/', rtrim(base_url(), '/'));
$logo_url = $public_base . 'images/favicon-logo.png';
$favicon_url = $public_base . 'images/favicon-logo.png';
$asset_ver = '20260907';
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0, private">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="Thu, 01 Jan 1970 00:00:00 GMT">
    <meta name="theme-color" content="#0e3a5d">
    <meta name="cache-timestamp" content="<?php echo time(); ?>">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>Admin · Bohol Island Tours</title>
    <link rel="icon" href="<?php echo html_escape($favicon_url); ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-theme.css?v=' . $asset_ver); ?>">

    <script>
        (function () {
            try {
                if (localStorage.getItem('darkMode') === 'true') {
                    document.documentElement.classList.add('dark-mode');
                }
            } catch (e) {}
        })();
    </script>
</head>
<body>
<script>
    (function () {
        try {
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        } catch (e) {}
    })();
</script>

<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

<!-- Sidebar -->
<aside class="nk-sidebar" id="sidebar" aria-label="Admin navigation">
    <div class="nk-sidebar-brand">
        <a href="<?php echo base_url('dashboard'); ?>">
            <span class="brand-mark"><i class="bi bi-compass"></i></span>
            <span class="brand-copy">
                <span class="brand-name">Bohol Island Tours</span>
                <span class="brand-tag">Tours · Stays · Car rental</span>
            </span>
        </a>
        <button type="button" class="sidebar-close" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <nav class="nk-menu">
        <?php
        $this->load->model('Admin_model');
        $admin_id = $this->session->userdata('admin_id');

        $is_super_admin = false;
        if ($admin_id) {
            $is_super_admin = $this->Admin_model->is_super_admin($admin_id);
        }

        $current_uri = uri_string();
        ?>

        <div class="nk-menu-section">Booking Engine</div>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_dashboard')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('dashboard'); ?>" class="nk-menu-link <?php echo ($current_uri == 'dashboard' || $current_uri == '' || $current_uri == 'login') ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-speedometer2"></i></span>
                <span class="nk-menu-text">Dashboard</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_bookings')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('bookings'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'bookings') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-calendar-check"></i></span>
                <span class="nk-menu-text">Bookings</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_rooms')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('rooms'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'rooms') !== false ? 'active' : ''; ?>">
                    <span class="nk-menu-icon"><i class="bi bi-map"></i></span>
                <span class="nk-menu-text">Tour Packages</span>
            </a>
        </div>
        <?php endif; ?>

        <div class="nk-menu-section">Guests &amp; Leads</div>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_inquiries')): ?>
        <?php
        $inquiry_badge_count = 0;
        if ($this->db->table_exists('inquiry')) {
            $this->db->where_in('status', array('new', 'guest_replied'));
            $inquiry_badge_count = (int) $this->db->count_all_results('inquiry');
        }
        ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('inquiries'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'inquiries') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-envelope"></i></span>
                <span class="nk-menu-text">Inquiries</span>
                <span id="inquiry-menu-badge" class="nk-menu-badge" <?php echo $inquiry_badge_count > 0 ? '' : 'style="display:none;"'; ?>><?php echo $inquiry_badge_count > 0 ? (int) $inquiry_badge_count : ''; ?></span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'manage_email_settings')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('email_settings'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'email_settings') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-mailbox"></i></span>
                <span class="nk-menu-text">Email/SMTP</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_bookings')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('customers'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'customers') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-person-badge"></i></span>
                <span class="nk-menu-text">Customers/Guests</span>
            </a>
        </div>
        <?php endif; ?>

        <div class="nk-menu-section">Insights</div>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'view_reports')): ?>
        <?php $is_reports_active = strpos($current_uri, 'reports') !== false; ?>
        <div class="nk-menu-item has-submenu <?php echo $is_reports_active ? 'active' : ''; ?>">
            <a href="#" class="nk-menu-link <?php echo $is_reports_active ? 'active' : ''; ?>" onclick="event.preventDefault(); this.closest('.nk-menu-item').classList.toggle('active');">
                <span class="nk-menu-icon"><i class="bi bi-graph-up"></i></span>
                <span class="nk-menu-text">Reports</span>
                <span class="nk-menu-toggle"><i class="bi bi-chevron-right"></i></span>
            </a>
            <div class="nk-menu-sub">
                <div class="nk-menu-sub-item">
                    <a href="<?php echo base_url('reports/daily_sales'); ?>" class="nk-menu-sub-link <?php echo strpos($current_uri, 'reports/daily_sales') !== false ? 'active' : ''; ?>">
                        <i class="bi bi-calendar-day me-2"></i> Daily Sales Report
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="nk-menu-section">Administration</div>

        <?php if ($admin_id && ($this->Admin_model->has_permission($admin_id, 'view_users') || $this->Admin_model->has_permission($admin_id, 'manage_users'))): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('users'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'users') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-people"></i></span>
                <span class="nk-menu-text">Users</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'manage_groups')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('groups'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'groups') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-people-fill"></i></span>
                <span class="nk-menu-text">Groups</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($admin_id && $this->Admin_model->has_permission($admin_id, 'manage_roles')): ?>
        <div class="nk-menu-item">
            <a href="<?php echo base_url('roles'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'roles') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-shield-check"></i></span>
                <span class="nk-menu-text">Roles</span>
            </a>
        </div>
        <?php endif; ?>

        <?php if ($is_super_admin): ?>
        <div class="nk-menu-item nk-menu-divider">
            <a href="<?php echo base_url('module_generator'); ?>" class="nk-menu-link <?php echo strpos($current_uri, 'module_generator') !== false ? 'active' : ''; ?>">
                <span class="nk-menu-icon"><i class="bi bi-magic"></i></span>
                <span class="nk-menu-text">Module Generator</span>
                <span class="nk-menu-badge">SA</span>
            </a>
        </div>
        <?php endif; ?>

        <div class="nk-menu-item nk-menu-divider">
            <a href="<?php echo base_url('logout'); ?>" class="nk-menu-link">
                <span class="nk-menu-icon"><i class="bi bi-box-arrow-right"></i></span>
                <span class="nk-menu-text">Logout</span>
            </a>
        </div>
    </nav>
</aside>

<!-- Header -->
<header class="nk-header">
    <button type="button" class="menu-toggle" aria-label="Open menu">
        <i class="bi bi-list"></i>
    </button>

    <div class="nk-header-brand">
        <a href="<?php echo base_url('dashboard'); ?>" class="logo-link">
            <i class="bi bi-compass"></i>
            <span>Bohol Island Tours</span>
        </a>
    </div>

    <h5 class="nk-header-title"><?php echo isset($title) ? $title : 'Admin Panel'; ?></h5>

    <div class="nk-header-tools">
        <span class="nk-header-welcome text-muted me-1" data-admin-id="<?php echo $this->session->userdata('admin_id'); ?>" data-timestamp="<?php echo time(); ?>">Welcome, <?php
            $admin_name = $this->session->userdata('admin_name');
            $admin_username = $this->session->userdata('admin_username');
            $display_name = !empty($admin_name) ? $admin_name : (!empty($admin_username) ? $admin_username : 'Admin');
            echo htmlspecialchars($display_name);
        ?></span>

        <button type="button" class="theme-chip" id="themeChip" title="Toggle dark mode" aria-label="Toggle dark mode">
            <i class="bi bi-moon-stars"></i>
        </button>

        <div class="user-dropdown dropdown">
            <button class="btn p-0 border-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">
                    <?php
                    $admin_name = $this->session->userdata('admin_name');
                    $admin_username = $this->session->userdata('admin_username');
                    $admin_id = $this->session->userdata('admin_id');

                    if (!empty($admin_id) && is_numeric($admin_id)) {
                        $this->load->model('Admin_model');
                        $admin_data = $this->Admin_model->get_admin($admin_id);

                        if ($admin_data && (int)$admin_data->id == (int)$admin_id) {
                            if (!empty($admin_data->avatar) && file_exists(FCPATH . $admin_data->avatar)): ?>
                                <img src="<?php echo base_url($admin_data->avatar); ?>" alt="Avatar"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            <?php else:
                                $display_name = !empty($admin_name) ? $admin_name : (!empty($admin_username) ? $admin_username : 'Admin');
                                echo strtoupper(substr($display_name, 0, 1));
                            endif;
                        } else {
                            $display_name = !empty($admin_name) ? $admin_name : (!empty($admin_username) ? $admin_username : 'Admin');
                            echo strtoupper(substr($display_name, 0, 1));
                        }
                    } else {
                        $display_name = !empty($admin_name) ? $admin_name : (!empty($admin_username) ? $admin_username : 'Admin');
                        echo strtoupper(substr($display_name, 0, 1));
                    }
                    ?>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="<?php echo base_url('profile'); ?>">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <div class="dropdown-item dark-mode-toggle" onclick="event.stopPropagation();">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-moon-stars"></i>
                            <span>Dark Mode</span>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" id="darkModeToggle" role="switch" onclick="event.stopPropagation();">
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="<?php echo base_url('logout'); ?>">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Content -->
<main class="nk-content">
