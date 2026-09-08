<?php
$roles = !empty($roles) ? $roles : array();
?>

<style>
    .group-add-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .group-add-page .page-actions .btn {
        width: 100%;
    }

    .group-add-page .form-section-card {
        margin-bottom: 1rem;
    }

    .group-add-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .group-add-page .roles-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        max-height: 300px;
        overflow-y: auto;
        background: var(--surface-2, #f3f7fa);
    }

    .group-add-page .switch-box {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
    }

    .group-add-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .group-add-page .roles-box,
    body.dark-mode .group-add-page .roles-box,
    html.dark-mode .group-add-page .switch-box,
    body.dark-mode .group-add-page .switch-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .group-add-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .group-add-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .group-add-page .page-actions .btn {
            width: auto;
        }

        .group-add-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .group-add-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .group-add-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block group-add-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-plus-circle"></i> Add New Group
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Create a user group and assign one or more roles.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('groups'); ?>" class="btn btn-outline-secondary">
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

    <?php echo form_open('groups/add', array('id' => 'group-add-form', 'class' => 'group-add-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Group Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">Group Name *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo set_value('name'); ?>" required>
                        <small class="form-text text-muted">Unique name (e.g., Managers, Staff, Reception)</small>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
                        <small class="form-text text-muted">Brief description of what this group is for</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-shield-check"></i> Assign Roles *
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Select one or more roles to assign to this group.</p>
                <?php if (!empty($roles)): ?>
                    <div class="roles-box">
                        <?php foreach ($roles as $role): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="roles[]"
                                       value="<?php echo (int) $role->id; ?>"
                                       id="role_<?php echo (int) $role->id; ?>"
                                       <?php echo set_checkbox('roles[]', $role->id); ?>>
                                <label class="form-check-label" for="role_<?php echo (int) $role->id; ?>">
                                    <strong><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    <?php if (!empty($role->description)): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($role->description, ENT_QUOTES, 'UTF-8'); ?></small>
                                    <?php endif; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">
                        No roles available. Please <a href="<?php echo base_url('roles/add'); ?>">create a role</a> first.
                    </div>
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
                               <?php echo set_checkbox('status', '1', TRUE); ?>>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row page-actions">
                <a href="<?php echo base_url('groups'); ?>" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Create Group
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
