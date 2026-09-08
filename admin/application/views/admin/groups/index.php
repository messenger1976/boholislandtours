<?php
$can_manage = !empty($can_manage);
$groups = !empty($groups) ? $groups : array();
$total_groups = count($groups);
?>

<style>
    .groups-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .groups-page .page-actions .btn {
        width: 100%;
    }

    .groups-page .form-section-card {
        margin-bottom: 1rem;
    }

    .groups-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .groups-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .groups-page .group-card {
        margin-bottom: 0.85rem;
    }

    .groups-page .group-card .card-body {
        padding: 1rem;
    }

    .groups-page .group-card-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0;
        word-break: break-word;
    }

    .groups-page .group-meta {
        display: grid;
        gap: 0.35rem;
        margin: 0.75rem 0;
        font-size: 0.85rem;
        color: var(--text, #334155);
    }

    .groups-page .group-meta span {
        color: var(--muted, #64748b);
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .groups-page .group-roles {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: 0.25rem;
    }

    .groups-page .group-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .groups-page .group-actions .btn {
        width: 100%;
    }

    html.dark-mode .groups-page .group-card-title,
    body.dark-mode .groups-page .group-card-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .groups-page .group-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .groups-page .group-actions .btn-danger {
            grid-column: 1 / -1;
        }
    }

    @media (min-width: 768px) {
        .groups-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .groups-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .groups-page .page-actions .btn {
            width: auto;
        }
    }

    .groups-page .groups-mobile-list {
        display: block;
    }

    .groups-page .groups-desktop-table {
        display: none;
    }

    @media (min-width: 992px) {
        .groups-page .groups-mobile-list {
            display: none !important;
        }

        .groups-page .groups-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block groups-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-people-fill"></i> Manage Groups
                    (<?php echo (int) $total_groups; ?>)
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">View and manage user groups and their assigned roles.</p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_manage): ?>
                <a href="<?php echo base_url('groups/add'); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Group
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
            <span class="header-title"><i class="bi bi-list-ul"></i> Group List</span>
        </div>
        <div class="card-body">
            <div class="groups-mobile-list">
                <?php if (!empty($groups)): ?>
                    <?php foreach ($groups as $group): ?>
                        <?php
                        $status = isset($group->status) ? $group->status : 'inactive';
                        $status_badge = ($status === 'active') ? 'success' : 'secondary';
                        $description = !empty($group->description) ? $group->description : '-';
                        $view_url = base_url('groups/view/' . (int) $group->id);
                        $edit_url = base_url('groups/edit/' . (int) $group->id);
                        $delete_url = base_url('groups/delete/' . (int) $group->id);
                        ?>
                        <div class="card card-bordered group-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <div class="min-w-0">
                                        <div class="small text-muted">#<?php echo (int) $group->id; ?></div>
                                        <p class="group-card-title"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="badge bg-<?php echo $status_badge; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </span>
                                </div>
                                <div class="group-meta">
                                    <div>
                                        <span>Description</span>
                                        <strong><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Roles</span>
                                        <div class="group-roles">
                                            <?php if (!empty($group->roles)): ?>
                                                <?php foreach ($group->roles as $role): ?>
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <strong class="text-muted">No roles assigned</strong>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($can_manage): ?>
                                <div class="group-actions">
                                    <a href="<?php echo $view_url; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo $delete_url; ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this group?');">
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
                            No groups found
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="groups-desktop-table">
                <div class="table-responsive">
                    <table class="table table-hover no-datatables" id="groupsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Group Name</th>
                                <th>Description</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($groups)): ?>
                                <?php foreach ($groups as $group): ?>
                                    <?php
                                    $status = isset($group->status) ? $group->status : 'inactive';
                                    $status_badge = ($status === 'active') ? 'success' : 'secondary';
                                    $description = !empty($group->description) ? $group->description : '-';
                                    ?>
                                    <tr>
                                        <td><?php echo (int) $group->id; ?></td>
                                        <td><strong><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                        <td><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if (!empty($group->roles)): ?>
                                                <?php foreach ($group->roles as $role): ?>
                                                    <span class="badge bg-info me-1"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted">No roles assigned</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $status_badge; ?>">
                                                <?php echo ucfirst($status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($can_manage): ?>
                                            <a href="<?php echo base_url('groups/view/' . (int) $group->id); ?>" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('groups/edit/' . (int) $group->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?php echo base_url('groups/delete/' . (int) $group->id); ?>" class="btn btn-sm btn-danger" title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this group?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No groups found</td>
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

    function initGroupsDesktopTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        if (window.matchMedia && !window.matchMedia('(min-width: 992px)').matches) {
            return;
        }

        var $table = $('#groupsTable');
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
                    emptyTable: 'No groups found'
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        } catch (e) {
            console.warn('Groups DataTable init failed', e);
        }
    }

    if ($) {
        $(initGroupsDesktopTable);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGroupsDesktopTable);
    } else {
        initGroupsDesktopTable();
    }
})(window, window.jQuery);
</script>
