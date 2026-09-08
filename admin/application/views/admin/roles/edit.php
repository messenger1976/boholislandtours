<?php
$selected_permission_ids = !empty($selected_permission_ids) ? $selected_permission_ids : array();
$permissions = !empty($permissions) ? $permissions : array();
?>

<style>
    .role-edit-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .role-edit-page .page-actions .btn {
        width: 100%;
    }

    .role-edit-page .form-section-card {
        margin-bottom: 1rem;
    }

    .role-edit-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .role-edit-page .perm-module-card {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        margin-bottom: 0.85rem;
        overflow: hidden;
        background: var(--surface-2, #f3f7fa);
    }

    .role-edit-page .perm-module-card:last-child {
        margin-bottom: 0;
    }

    .role-edit-page .perm-module-card .module-title {
        padding: 0.7rem 1rem;
        font-weight: 600;
        border-bottom: 1px solid var(--card-border, #dbe4ee);
        text-transform: capitalize;
        color: var(--heading, #1e293b);
    }

    .role-edit-page .perm-module-card .module-body {
        padding: 0.85rem 1rem;
        max-height: 250px;
        overflow-y: auto;
    }

    .role-edit-page .switch-box {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
    }

    .role-edit-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .role-edit-page .perm-module-card,
    body.dark-mode .role-edit-page .perm-module-card,
    html.dark-mode .role-edit-page .switch-box,
    body.dark-mode .role-edit-page .switch-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .role-edit-page .perm-module-card .module-title,
    body.dark-mode .role-edit-page .perm-module-card .module-title {
        color: var(--heading, #e2e8f0);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .role-edit-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .role-edit-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .role-edit-page .page-actions .btn {
            width: auto;
        }

        .role-edit-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .role-edit-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .role-edit-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block role-edit-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-pencil-square"></i> Edit Role
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Update
                        <strong><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                        (#<?php echo (int) $role->id; ?>)
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('roles/view/' . (int) $role->id); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-eye"></i> View
                </a>
                <a href="<?php echo base_url('roles'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php echo form_open('roles/edit/' . $role->id, array('id' => 'role-edit-form', 'class' => 'role-edit-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Role Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Role Name *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo set_value('name', $role->name); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="slug" class="form-label">Role Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                               value="<?php echo set_value('slug', $role->slug); ?>" required
                               pattern="[a-z0-9_-]+"
                               title="Only lowercase letters, numbers, dashes, and underscores">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description', $role->description); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-key"></i> Assign Permissions *
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Select one or more permissions to assign to this role.</p>
                <?php if (!empty($permissions)): ?>
                    <?php foreach ($permissions as $module => $module_permissions): ?>
                        <div class="perm-module-card">
                            <div class="module-title"><?php echo htmlspecialchars(ucfirst($module), ENT_QUOTES, 'UTF-8'); ?> Permissions</div>
                            <div class="module-body">
                                <?php foreach ($module_permissions as $permission): ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                               value="<?php echo (int) $permission->id; ?>"
                                               id="perm_<?php echo (int) $permission->id; ?>"
                                               <?php echo (in_array($permission->id, $selected_permission_ids)) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="perm_<?php echo (int) $permission->id; ?>">
                                            <strong><?php echo htmlspecialchars($permission->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                                            <br><small class="text-muted"><?php echo htmlspecialchars($permission->slug, ENT_QUOTES, 'UTF-8'); ?></small>
                                            <?php if (!empty($permission->description)): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars($permission->description, ENT_QUOTES, 'UTF-8'); ?></small>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">No permissions available.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-toggle-on"></i> Status
            </div>
            <div class="card-body">
                <div class="switch-box">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               <?php echo set_checkbox('status', '1', $role->status == 'active'); ?>>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row page-actions">
                <a href="<?php echo base_url('roles'); ?>" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Update Role
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
