<?php
$status = isset($group->status) ? $group->status : 'inactive';
$status_badge = ($status === 'active') ? 'success' : 'secondary';
$roles = !empty($roles) ? $roles : array();
$description = !empty($group->description) ? $group->description : '-';
$created_label = !empty($group->created_at) ? date('M d, Y H:i', strtotime($group->created_at)) : 'N/A';
?>

<style>
    .group-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .group-view-page .page-actions .btn {
        width: 100%;
    }

    .group-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .group-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .group-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .group-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .group-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .group-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .group-view-page .notes-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        color: var(--text, #334155);
        white-space: pre-wrap;
        word-break: break-word;
    }

    .group-view-page .role-item {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.65rem;
    }

    .group-view-page .role-item:last-child {
        margin-bottom: 0;
    }

    .group-view-page .role-item strong {
        display: block;
        color: var(--heading, #1e293b);
    }

    .group-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .group-view-page .detail-item .value,
    body.dark-mode .group-view-page .detail-item .value,
    html.dark-mode .group-view-page .role-item strong,
    body.dark-mode .group-view-page .role-item strong {
        color: var(--heading, #e2e8f0);
    }

    html.dark-mode .group-view-page .notes-box,
    body.dark-mode .group-view-page .notes-box,
    html.dark-mode .group-view-page .role-item,
    body.dark-mode .group-view-page .role-item {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 576px) {
        .group-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .group-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .group-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .group-view-page .page-actions .btn {
            width: auto;
        }

        .group-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .group-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .group-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block group-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-people-fill"></i> <?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Group #<?php echo (int) $group->id; ?>
                        &middot;
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('groups'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="<?php echo base_url('groups/edit/' . (int) $group->id); ?>" class="btn btn-primary">
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
                    <div class="value"><?php echo (int) $group->id; ?></div>
                </div>
                <div class="detail-item">
                    <label>Group Name</label>
                    <div class="value"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></div>
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
            <span class="header-title"><i class="bi bi-shield-check"></i> Assigned Roles</span>
        </div>
        <div class="card-body">
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                    <div class="role-item">
                        <strong><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                        <?php if (!empty($role->slug)): ?>
                            <small class="text-muted d-block"><?php echo htmlspecialchars($role->slug, ENT_QUOTES, 'UTF-8'); ?></small>
                        <?php endif; ?>
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

    <div class="sticky-actions">
        <div class="action-row page-actions">
            <a href="<?php echo base_url('groups/edit/' . (int) $group->id); ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit Group
            </a>
            <a href="<?php echo base_url('groups'); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
