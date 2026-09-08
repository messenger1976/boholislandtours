<?php
$module_name = isset($module_name) ? $module_name : '';
$generated = !empty($generated) ? $generated : array();
$errors = !empty($errors) ? $errors : array();
$permissions_created = !empty($permissions_created) ? $permissions_created : array();
$permissions_assigned = !empty($permissions_assigned) ? $permissions_assigned : array();
$sql = isset($sql) ? $sql : '';
$module_lower = strtolower($module_name);
?>

<style>
    .module-result-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .module-result-page .page-actions .btn {
        width: 100%;
    }

    .module-result-page .form-section-card {
        margin-bottom: 1rem;
    }

    .module-result-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .module-result-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .module-result-page .file-list,
    .module-result-page .perm-list {
        margin: 0;
        padding-left: 1.1rem;
    }

    .module-result-page .sql-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        max-height: 400px;
        overflow: auto;
        white-space: pre-wrap;
        word-break: break-word;
        font-size: 0.85rem;
        margin: 0;
    }

    .module-result-page .result-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.65rem;
    }

    .module-result-page .result-item:last-child {
        margin-bottom: 0;
    }

    .module-result-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .module-result-page .sql-box,
    body.dark-mode .module-result-page .sql-box,
    html.dark-mode .module-result-page .result-item,
    body.dark-mode .module-result-page .result-item {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .module-result-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .module-result-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .module-result-page .page-actions .btn {
            width: auto;
        }

        .module-result-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .module-result-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .module-result-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block module-result-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-check-circle text-success"></i> Module Generation Complete
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Module:
                        <strong><?php echo htmlspecialchars($module_name, ENT_QUOTES, 'UTF-8'); ?></strong>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('module_generator'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Generate Another
                </a>
                <a href="<?php echo base_url($module_lower); ?>" class="btn btn-primary">
                    <i class="bi bi-eye"></i> View Module
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <strong>Errors:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($generated)): ?>
        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-file-earmark-check"></i> Generated Files</span>
            </div>
            <div class="card-body">
                <ul class="file-list">
                    <?php foreach ($generated as $file): ?>
                        <li><?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($sql !== ''): ?>
        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-database"></i> Database Table SQL</span>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="copySQL()">
                    <i class="bi bi-clipboard"></i> Copy SQL
                </button>
            </div>
            <div class="card-body">
                <pre id="sql-code" class="sql-box"><code><?php echo htmlspecialchars($sql, ENT_QUOTES, 'UTF-8'); ?></code></pre>
                <p class="text-muted small mb-0 mt-2">
                    <i class="bi bi-info-circle"></i>
                    Copy and execute this SQL in your database to create the table.
                </p>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($permissions_created)): ?>
        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-shield-check"></i> Permissions Created</span>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">These permissions were created (or already existed) in the database:</p>
                <?php foreach ($permissions_created as $perm): ?>
                    <div class="result-item">
                        <div class="min-w-0">
                            <strong><?php echo htmlspecialchars($perm['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                            <br><small class="text-muted"><code><?php echo htmlspecialchars($perm['slug'], ENT_QUOTES, 'UTF-8'); ?></code></small>
                        </div>
                        <span class="badge bg-<?php echo ($perm['status'] == 'created') ? 'success' : 'info'; ?>">
                            <?php echo ($perm['status'] == 'created') ? 'Created' : 'Already Existed'; ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($permissions_assigned)): ?>
        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-person-check"></i> Super Admin Assignment</span>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Permissions assigned to the Super Admin role:</p>
                <?php foreach ($permissions_assigned as $assigned): ?>
                    <?php
                    $badge = 'danger';
                    $label = 'Failed';
                    if ($assigned['status'] == 'assigned') {
                        $badge = 'success';
                        $label = 'Assigned';
                    } elseif ($assigned['status'] == 'already_assigned') {
                        $badge = 'info';
                        $label = 'Already Assigned';
                    }
                    ?>
                    <div class="result-item">
                        <span><?php echo htmlspecialchars($assigned['permission'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="badge bg-<?php echo $badge; ?>"><?php echo $label; ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="alert alert-info mb-0 mt-3">
                    <i class="bi bi-info-circle"></i>
                    You can assign these to other roles on the
                    <a href="<?php echo base_url('roles'); ?>" class="alert-link">Roles</a> page.
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-list-check"></i> Next Steps</span>
        </div>
        <div class="card-body">
            <ol class="mb-0">
                <li class="mb-2">
                    <strong>Execute SQL:</strong> Copy the SQL above and run it in your database.
                </li>
                <?php if (empty($permissions_created)): ?>
                <li class="mb-2">
                    <strong>Set Permissions:</strong>
                    <ul class="mt-1">
                        <li><code>view_<?php echo htmlspecialchars($module_lower, ENT_QUOTES, 'UTF-8'); ?>s</code></li>
                        <li><code>add_<?php echo htmlspecialchars($module_lower, ENT_QUOTES, 'UTF-8'); ?>s</code></li>
                        <li><code>edit_<?php echo htmlspecialchars($module_lower, ENT_QUOTES, 'UTF-8'); ?>s</code></li>
                        <li><code>delete_<?php echo htmlspecialchars($module_lower, ENT_QUOTES, 'UTF-8'); ?>s</code></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="mb-2">
                    <strong>Test the Module:</strong>
                    <code><?php echo base_url($module_lower); ?></code>
                </li>
                <li class="mb-2">
                    <strong>Customize generated files</strong> under controllers, models, and views as needed.
                </li>
                <li class="mb-0">
                    <strong>Add to Navigation:</strong> Update the sidebar/menu to include the new module.
                </li>
            </ol>
        </div>
    </div>

    <div class="sticky-actions">
        <div class="action-row page-actions">
            <a href="<?php echo base_url('module_generator'); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Generate Another
            </a>
            <a href="<?php echo base_url($module_lower); ?>" class="btn btn-primary">
                <i class="bi bi-eye"></i> View Module
            </a>
        </div>
    </div>
</div>

<script>
function copySQL() {
    var sqlCode = document.getElementById('sql-code').textContent;
    var textarea = document.createElement('textarea');
    textarea.value = sqlCode;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand('copy');
        alert('SQL copied to clipboard!');
    } catch (err) {
        alert('Failed to copy SQL. Please select and copy manually.');
    }
    document.body.removeChild(textarea);
}
</script>
