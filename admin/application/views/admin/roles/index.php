<?php
$can_manage = !empty($can_manage);
$roles = !empty($roles) && is_array($roles) ? $roles : array();
$total_roles = count($roles);
?>

<style>
    .roles-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .roles-page .page-actions .btn {
        width: 100%;
    }

    .roles-page .form-section-card {
        margin-bottom: 1rem;
    }

    .roles-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .roles-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .roles-page .role-card {
        margin-bottom: 0.85rem;
    }

    .roles-page .role-card .card-body {
        padding: 1rem;
    }

    .roles-page .role-card-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0;
        word-break: break-word;
    }

    .roles-page .role-meta {
        display: grid;
        gap: 0.35rem;
        margin: 0.75rem 0;
        font-size: 0.85rem;
        color: var(--text, #334155);
    }

    .roles-page .role-meta span {
        color: var(--muted, #64748b);
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .roles-page .role-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .roles-page .role-actions .btn {
        width: 100%;
    }

    html.dark-mode .roles-page .role-card-title,
    body.dark-mode .roles-page .role-card-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .roles-page .role-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .roles-page .role-actions .btn-danger {
            grid-column: 1 / -1;
        }
    }

    @media (min-width: 768px) {
        .roles-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .roles-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .roles-page .page-actions .btn {
            width: auto;
        }
    }

    .roles-page .roles-mobile-list {
        display: block;
    }

    .roles-page .roles-desktop-table {
        display: none;
    }

    @media (min-width: 992px) {
        .roles-page .roles-mobile-list {
            display: none !important;
        }

        .roles-page .roles-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block roles-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-shield-check"></i> Manage Roles
                    (<?php echo (int) $total_roles; ?>)
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">View and manage roles and their assigned permissions.</p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_manage): ?>
                <a href="<?php echo base_url('roles/add'); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Role
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-list-ul"></i> Role List</span>
        </div>
        <div class="card-body">
            <div class="roles-mobile-list">
                <?php if (!empty($roles)): ?>
                    <?php foreach ($roles as $role): ?>
                        <?php
                        $status = isset($role->status) ? $role->status : 'inactive';
                        $status_badge = ($status === 'active') ? 'success' : 'secondary';
                        $description = !empty($role->description) ? $role->description : '-';
                        $perm_count = !empty($role->permissions) ? count($role->permissions) : 0;
                        $view_url = base_url('roles/view/' . (int) $role->id);
                        $edit_url = base_url('roles/edit/' . (int) $role->id);
                        $delete_url = base_url('roles/delete/' . (int) $role->id);
                        ?>
                        <div class="card card-bordered role-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <div class="min-w-0">
                                        <div class="small text-muted">#<?php echo (int) $role->id; ?></div>
                                        <p class="role-card-title"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="badge bg-<?php echo $status_badge; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </span>
                                </div>
                                <div class="role-meta">
                                    <div>
                                        <span>Slug</span>
                                        <strong><code><?php echo htmlspecialchars($role->slug, ENT_QUOTES, 'UTF-8'); ?></code></strong>
                                    </div>
                                    <div>
                                        <span>Description</span>
                                        <strong><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Permissions</span>
                                        <strong>
                                            <?php if ($perm_count > 0): ?>
                                                <span class="badge bg-primary"><?php echo (int) $perm_count; ?> permission(s)</span>
                                            <?php else: ?>
                                                <span class="text-muted">No permissions assigned</span>
                                            <?php endif; ?>
                                        </strong>
                                    </div>
                                </div>
                                <?php if ($can_manage): ?>
                                <div class="role-actions">
                                    <a href="<?php echo $view_url; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo $delete_url; ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this role?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card card-bordered">
                        <div class="card-body text-center text-muted py-4">
                            No roles found
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="roles-desktop-table">
                <div class="table-responsive">
                    <table class="table table-hover no-datatables" id="rolesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($roles)): ?>
                                <?php foreach ($roles as $role): ?>
                                    <?php
                                    $status = isset($role->status) ? $role->status : 'inactive';
                                    $status_badge = ($status === 'active') ? 'success' : 'secondary';
                                    $description = !empty($role->description) ? $role->description : '-';
                                    $perm_count = !empty($role->permissions) ? count($role->permissions) : 0;
                                    ?>
                                    <tr>
                                        <td><?php echo (int) $role->id; ?></td>
                                        <td><strong><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                        <td><code><?php echo htmlspecialchars($role->slug, ENT_QUOTES, 'UTF-8'); ?></code></td>
                                        <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if ($perm_count > 0): ?>
                                                <span class="badge bg-primary"><?php echo (int) $perm_count; ?> permission(s)</span>
                                            <?php else: ?>
                                                <span class="text-muted">No permissions assigned</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $status_badge; ?>">
                                                <?php echo ucfirst($status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($can_manage): ?>
                                            <a href="<?php echo base_url('roles/view/' . (int) $role->id); ?>" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('roles/edit/' . (int) $role->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?php echo base_url('roles/delete/' . (int) $role->id); ?>" class="btn btn-sm btn-danger" title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this role?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No roles found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function (window, $) {
    'use strict';

    function initRolesDesktopTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        if (window.matchMedia && !window.matchMedia('(min-width: 992px)').matches) {
            return;
        }

        var $table = $('#rolesTable');
        if (!$table.length || $.fn.DataTable.isDataTable($table)) {
            return;
        }

        var tbodyRows = $table.find('tbody tr');
        if (!tbodyRows.length || (tbodyRows.length === 1 && tbodyRows.find('td[colspan]').length > 0)) {
            return;
        }

        try {
            $table.DataTable({
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                order: [[0, 'desc']],
                responsive: false,
                autoWidth: false,
                language: {
                    search: 'Search:',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    emptyTable: 'No roles found'
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        } catch (e) {
            console.warn('Roles DataTable init failed', e);
        }
    }

    if ($) {
        $(initRolesDesktopTable);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRolesDesktopTable);
    } else {
        initRolesDesktopTable();
    }
})(window, window.jQuery);
</script>
