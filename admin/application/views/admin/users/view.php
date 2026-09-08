<?php
$can_edit = method_exists($this, 'has_permission') ? $this->has_permission('edit_users') : true;
$status = isset($user->status) ? $user->status : 'inactive';
$status_badge = ($status === 'active') ? 'success' : 'secondary';
$groups = !empty($groups) ? $groups : array();
$roles = !empty($roles) ? $roles : array();
$permissions = !empty($permissions) ? $permissions : array();
$display_name = !empty($user->name) ? $user->name : (!empty($user->username) ? $user->username : 'A');
$has_avatar = !empty($user->avatar) && file_exists(FCPATH . $user->avatar);
$created_label = !empty($user->created_at) ? date('M d, Y H:i', strtotime($user->created_at)) : 'N/A';

$grouped_perms = array();
foreach ($permissions as $perm) {
    $module = !empty($perm->module) ? $perm->module : 'general';
    if (!isset($grouped_perms[$module])) {
        $grouped_perms[$module] = array();
    }
    $grouped_perms[$module][] = $perm;
}
?>

<style>
    .user-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .user-view-page .page-actions .btn {
        width: 100%;
    }

    .user-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .user-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .user-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-view-page .avatar-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .user-view-page .avatar-img,
    .user-view-page .avatar-fallback {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 3px solid var(--card-border, #dee2e6);
    }

    .user-view-page .avatar-img {
        object-fit: cover;
    }

    .user-view-page .avatar-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: #fff;
        font-size: 2.75rem;
        font-weight: 600;
    }

    .user-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .user-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .user-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .user-view-page .chip-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .user-view-page .role-item {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.65rem;
    }

    .user-view-page .role-item:last-child {
        margin-bottom: 0;
    }

    .user-view-page .role-item strong {
        display: block;
        color: var(--heading, #1e293b);
    }

    .user-view-page .perm-module {
        margin-bottom: 0.85rem;
    }

    .user-view-page .perm-module:last-child {
        margin-bottom: 0;
    }

    .user-view-page .perm-module-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin-bottom: 0.4rem;
        text-transform: capitalize;
    }

    .user-view-page .perms-scroll {
        max-height: 320px;
        overflow-y: auto;
    }

    .user-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .user-view-page .detail-item .value,
    body.dark-mode .user-view-page .detail-item .value,
    html.dark-mode .user-view-page .role-item strong,
    body.dark-mode .user-view-page .role-item strong,
    html.dark-mode .user-view-page .perm-module-title,
    body.dark-mode .user-view-page .perm-module-title {
        color: var(--heading, #e2e8f0);
    }

    html.dark-mode .user-view-page .role-item,
    body.dark-mode .user-view-page .role-item {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 576px) {
        .user-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .user-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .user-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .user-view-page .page-actions .btn {
            width: auto;
        }

        .user-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .user-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .user-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block user-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        User #<?php echo (int) $user->id; ?>
                        &middot;
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('users'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <?php if ($can_edit): ?>
                <a href="<?php echo base_url('users/edit/' . (int) $user->id); ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-info-circle"></i> Basic Information</span>
        </div>
        <div class="card-body">
            <div class="avatar-wrap">
                <?php if ($has_avatar): ?>
                    <img src="<?php echo base_url($user->avatar); ?>" alt="Avatar" class="avatar-img">
                <?php else: ?>
                    <div class="avatar-fallback"><?php echo strtoupper(substr($display_name, 0, 1)); ?></div>
                <?php endif; ?>
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <label>ID</label>
                    <div class="value"><?php echo (int) $user->id; ?></div>
                </div>
                <div class="detail-item">
                    <label>Username</label>
                    <div class="value"><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Full Name</label>
                    <div class="value"><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <div class="value"><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Status</label>
                    <div class="value">
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Created</label>
                    <div class="value"><?php echo htmlspecialchars($created_label, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-people-fill"></i> Groups</span>
        </div>
        <div class="card-body">
            <?php if (!empty($groups)): ?>
                <div class="chip-wrap">
                    <?php foreach ($groups as $group): ?>
                        <span class="badge bg-info"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No groups assigned</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-shield-check"></i> Roles</span>
        </div>
        <div class="card-body">
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                    <div class="role-item">
                        <strong><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                        <small class="text-muted d-block"><?php echo htmlspecialchars($role->slug, ENT_QUOTES, 'UTF-8'); ?></small>
                        <?php if (!empty($role->description)): ?>
                            <small class="text-muted d-block mt-1"><?php echo htmlspecialchars($role->description, ENT_QUOTES, 'UTF-8'); ?></small>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted mb-0">No roles assigned</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-key"></i> Permissions</span>
        </div>
        <div class="card-body">
            <?php if (!empty($grouped_perms)): ?>
                <div class="perms-scroll">
                    <?php foreach ($grouped_perms as $module => $module_perms): ?>
                        <div class="perm-module">
                            <div class="perm-module-title"><?php echo htmlspecialchars(ucfirst($module), ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="chip-wrap">
                                <?php foreach ($module_perms as $perm): ?>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($perm->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No permissions assigned</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="sticky-actions">
        <div class="action-row page-actions">
            <?php if ($can_edit): ?>
            <a href="<?php echo base_url('users/edit/' . (int) $user->id); ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit User
            </a>
            <?php endif; ?>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
