<?php
$can_add = !empty($can_add);
$can_edit = !empty($can_edit);
$can_delete = !empty($can_delete);
$users = !empty($users) ? $users : array();
$total_users = count($users);
$current_admin_id = (int) $this->session->userdata('admin_id');
?>

<style>
    .users-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .users-page .page-actions .btn {
        width: 100%;
    }

    .users-page .form-section-card {
        margin-bottom: 1rem;
    }

    .users-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .users-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .users-page .user-card {
        margin-bottom: 0.85rem;
    }

    .users-page .user-card .card-body {
        padding: 1rem;
    }

    .users-page .user-card-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0;
        word-break: break-word;
    }

    .users-page .user-meta {
        display: grid;
        gap: 0.35rem;
        margin: 0.75rem 0;
        font-size: 0.85rem;
        color: var(--text, #334155);
    }

    .users-page .user-meta span {
        color: var(--muted, #64748b);
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .users-page .user-groups {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: 0.25rem;
    }

    .users-page .user-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .users-page .user-actions .btn {
        width: 100%;
    }

    html.dark-mode .users-page .user-card-title,
    body.dark-mode .users-page .user-card-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .users-page .user-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .users-page .user-actions .btn-danger {
            grid-column: 1 / -1;
        }
    }

    @media (min-width: 768px) {
        .users-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .users-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .users-page .page-actions .btn {
            width: auto;
        }
    }

    /* Mobile cards / desktop table */
    .users-page .users-mobile-list {
        display: block;
    }

    .users-page .users-desktop-table {
        display: none;
    }

    @media (min-width: 992px) {
        .users-page .users-mobile-list {
            display: none !important;
        }

        .users-page .users-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block users-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-people"></i> Manage Admin Users
                    (<?php echo (int) $total_users; ?>)
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">View and manage all admin user accounts.</p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_add): ?>
                <a href="<?php echo base_url('users/add'); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New User
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
            <span class="header-title"><i class="bi bi-list-ul"></i> User List</span>
        </div>
        <div class="card-body">
            <!-- Mobile / narrow: card list -->
            <div class="users-mobile-list">
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <?php
                        $status = isset($user->status) ? $user->status : 'inactive';
                        $status_badge = ($status === 'active') ? 'success' : 'secondary';
                        $view_url = base_url('users/view/' . (int) $user->id);
                        $edit_url = base_url('users/edit/' . (int) $user->id);
                        $delete_url = base_url('users/delete/' . (int) $user->id);
                        $can_delete_this = $can_delete && ((int) $user->id !== $current_admin_id);
                        ?>
                        <div class="card card-bordered user-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <div class="min-w-0">
                                        <div class="small text-muted">#<?php echo (int) $user->id; ?></div>
                                        <p class="user-card-title"><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="badge bg-<?php echo $status_badge; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </span>
                                </div>
                                <div class="user-meta">
                                    <div>
                                        <span>Username</span>
                                        <strong><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Email</span>
                                        <strong><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Groups</span>
                                        <div class="user-groups">
                                            <?php if (!empty($user->groups)): ?>
                                                <?php foreach ($user->groups as $group): ?>
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <strong class="text-muted">No groups</strong>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($can_edit || $can_delete_this): ?>
                                <div class="user-actions">
                                    <?php if ($can_edit): ?>
                                    <a href="<?php echo $view_url; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($can_delete_this): ?>
                                    <a href="<?php echo $delete_url; ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card card-bordered">
                        <div class="card-body text-center text-muted py-4">
                            No users found
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Desktop: DataTable -->
            <div class="users-desktop-table">
                <div class="table-responsive">
                    <table class="table table-hover no-datatables" id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Groups</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php
                                    $status = isset($user->status) ? $user->status : 'inactive';
                                    $status_badge = ($status === 'active') ? 'success' : 'secondary';
                                    $can_delete_this = $can_delete && ((int) $user->id !== $current_admin_id);
                                    ?>
                                    <tr>
                                        <td><?php echo (int) $user->id; ?></td>
                                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><strong><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if (!empty($user->groups)): ?>
                                                <?php foreach ($user->groups as $group): ?>
                                                    <span class="badge bg-info me-1"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted">No groups</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $status_badge; ?>">
                                                <?php echo ucfirst($status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($can_edit): ?>
                                            <a href="<?php echo base_url('users/view/' . (int) $user->id); ?>" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('users/edit/' . (int) $user->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php if ($can_delete_this): ?>
                                            <a href="<?php echo base_url('users/delete/' . (int) $user->id); ?>" class="btn btn-sm btn-danger" title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this user?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No users found</td>
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

    function initUsersDesktopTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        if (window.matchMedia && !window.matchMedia('(min-width: 992px)').matches) {
            return;
        }

        var $table = $('#usersTable');
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
                    emptyTable: 'No users found'
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        } catch (e) {
            console.warn('Users DataTable init failed', e);
        }
    }

    if ($) {
        $(initUsersDesktopTable);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initUsersDesktopTable);
    } else {
        initUsersDesktopTable();
    }
})(window, window.jQuery);
</script>
