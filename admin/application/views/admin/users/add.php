<?php
$groups = !empty($groups) ? $groups : array();
?>

<style>
    .user-add-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .user-add-page .page-actions .btn {
        width: 100%;
    }

    .user-add-page .form-section-card {
        margin-bottom: 1rem;
    }

    .user-add-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .user-add-page .avatar-row {
        display: grid;
        gap: 1rem;
        align-items: start;
    }

    .user-add-page .avatar-img,
    .user-add-page .avatar-fallback {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid var(--card-border, #dee2e6);
    }

    .user-add-page .avatar-img {
        object-fit: cover;
    }

    .user-add-page .avatar-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: #fff;
        font-size: 2.5rem;
        font-weight: 600;
    }

    .user-add-page .groups-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        max-height: 240px;
        overflow-y: auto;
        background: var(--surface-2, #f3f7fa);
    }

    .user-add-page .switch-box {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
    }

    .user-add-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .user-add-page .groups-box,
    body.dark-mode .user-add-page .groups-box,
    html.dark-mode .user-add-page .switch-box,
    body.dark-mode .user-add-page .switch-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 576px) {
        .user-add-page .avatar-row {
            grid-template-columns: auto 1fr;
            align-items: center;
        }
    }

    @media (min-width: 768px) {
        .user-add-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .user-add-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .user-add-page .page-actions .btn {
            width: auto;
        }

        .user-add-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .user-add-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .user-add-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block user-add-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-plus-circle"></i> Add New Admin User
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Create an admin account and assign one or more groups.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('users'); ?>" class="btn btn-outline-secondary">
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

    <?php echo form_open_multipart('users/add', array('id' => 'user-add-form', 'class' => 'user-add-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-image"></i> Profile Avatar
            </div>
            <div class="card-body">
                <div class="avatar-row">
                    <div class="avatar-preview-container">
                        <div class="avatar-fallback" id="avatar-preview">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div>
                        <label for="avatar" class="form-label">Upload avatar (optional)</label>
                        <input type="file" class="form-control mb-2" id="avatar" name="avatar"
                               accept="image/*" onchange="previewAvatar(this)">
                        <small class="form-text text-muted">Allowed: JPG, PNG, GIF, WEBP (Max 2MB)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-person"></i> Account Details
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?php echo set_value('username'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo set_value('name'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="password" name="password"
                               required autocomplete="new-password">
                        <small class="form-text text-muted">Minimum 6 characters</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-people"></i> Assign Groups *
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Select one or more groups to assign to this user.</p>
                <?php if (!empty($groups)): ?>
                    <div class="groups-box">
                        <?php foreach ($groups as $group): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="groups[]"
                                       value="<?php echo (int) $group->id; ?>"
                                       id="group_<?php echo (int) $group->id; ?>"
                                       <?php echo set_checkbox('groups[]', $group->id); ?>>
                                <label class="form-check-label" for="group_<?php echo (int) $group->id; ?>">
                                    <strong><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    <?php if (!empty($group->description)): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($group->description, ENT_QUOTES, 'UTF-8'); ?></small>
                                    <?php endif; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">
                        No groups available. Please <a href="<?php echo base_url('groups/add'); ?>">create a group</a> first.
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
                <a href="<?php echo base_url('users'); ?>" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Create User
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var preview = document.getElementById('avatar-preview');

        reader.onload = function (e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'avatar-img';
                img.id = 'avatar-preview';
                img.alt = 'Avatar';
                preview.parentNode.replaceChild(img, preview);
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
