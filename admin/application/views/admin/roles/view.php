<?php
$status = isset($role->status) ? $role->status : 'inactive';
$status_badge = ($status === 'active') ? 'success' : 'secondary';
$permissions = !empty($permissions) ? $permissions : array();
$description = !empty($role->description) ? $role->description : '-';
$created_label = !empty($role->created_at) ? date('M d, Y H:i', strtotime($role->created_at)) : 'N/A';

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
    .role-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .role-view-page .page-actions .btn {
        width: 100%;
    }

    .role-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .role-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .role-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .role-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .role-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .role-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .role-view-page .notes-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        color: var(--text, #334155);
        white-space: pre-wrap;
        word-break: break-word;
    }

    .role-view-page .chip-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .role-view-page .perm-module {
        margin-bottom: 0.85rem;
    }

    .role-view-page .perm-module:last-child {
        margin-bottom: 0;
    }

    .role-view-page .perm-module-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin-bottom: 0.4rem;
        text-transform: capitalize;
    }

    .role-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .role-view-page .detail-item .value,
    body.dark-mode .role-view-page .detail-item .value,
    html.dark-mode .role-view-page .perm-module-title,
    body.dark-mode .role-view-page .perm-module-title {
        color: var(--heading, #e2e8f0);
    }

    html.dark-mode .role-view-page .notes-box,
    body.dark-mode .role-view-page .notes-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 576px) {
        .role-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .role-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .role-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .role-view-page .page-actions .btn {
            width: auto;
        }

        .role-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .role-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .role-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block role-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-shield-check"></i> <?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Role #<?php echo (int) $role->id; ?>
                        &middot;
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('roles'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="<?php echo base_url('roles/edit/' . (int) $role->id); ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-info-circle"></i> Basic Information</span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>ID</label>
                    <div class="value"><?php echo (int) $role->id; ?></div>
                </div>
                <div class="detail-item">
                    <label>Role Name</label>
                    <div class="value"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Slug</label>
                    <div class="value"><code><?php echo htmlspecialchars($role->slug, ENT_QUOTES, 'UTF-8'); ?></code></div>
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
            <div class="detail-item mt-3">
                <label>Description</label>
                <div class="notes-box"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-key"></i> Assigned Permissions</span>
        </div>
        <div class="card-body">
            <?php if (!empty($grouped_perms)): ?>
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
            <?php else: ?>
                <p class="text-muted mb-0">No permissions assigned</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="sticky-actions">
        <div class="action-row page-actions">
            <a href="<?php echo base_url('roles/edit/' . (int) $role->id); ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit Role
            </a>
            <a href="<?php echo base_url('roles'); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
