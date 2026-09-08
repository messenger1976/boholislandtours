<?php
$can_add = !empty($can_add);
$can_edit = !empty($can_edit);
$can_delete = !empty($can_delete);
$search_term = isset($search_term) ? $search_term : '';
$customers = !empty($customers) ? $customers : array();
$total_customers = count($customers);
?>

<style>
    .customers-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .customers-page .page-actions .btn {
        width: 100%;
    }

    .customers-page .form-section-card {
        margin-bottom: 1rem;
    }

    .customers-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .customers-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customers-page .customer-card {
        margin-bottom: 0.85rem;
    }

    .customers-page .customer-card .card-body {
        padding: 1rem;
    }

    .customers-page .customer-card-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0;
        word-break: break-word;
    }

    .customers-page .customer-meta {
        display: grid;
        gap: 0.35rem;
        margin: 0.75rem 0;
        font-size: 0.85rem;
        color: var(--text, #334155);
    }

    .customers-page .customer-meta span {
        color: var(--muted, #64748b);
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .customers-page .customer-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }

    .customers-page .customer-actions .btn {
        width: 100%;
    }

    html.dark-mode .customers-page .customer-card-title,
    body.dark-mode .customers-page .customer-card-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .customers-page .customer-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .customers-page .customer-actions .btn-danger {
            grid-column: 1 / -1;
        }
    }

    @media (min-width: 768px) {
        .customers-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .customers-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .customers-page .page-actions .btn {
            width: auto;
        }
    }

    /* Mobile cards / desktop table */
    .customers-page .customers-mobile-list {
        display: block;
    }

    .customers-page .customers-desktop-table {
        display: none;
    }

    @media (min-width: 992px) {
        .customers-page .customers-mobile-list {
            display: none !important;
        }

        .customers-page .customers-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block customers-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-people"></i> Customers / Guests
                    (<?php echo (int) $total_customers; ?>)
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Manage guest profiles used for bookings and inquiries.</p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_add): ?>
                <a href="<?php echo base_url('customers/add'); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Customer
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
            <span class="header-title"><i class="bi bi-search"></i> Search</span>
        </div>
        <div class="card-body">
            <form method="get" action="<?php echo base_url('customers'); ?>" class="row g-2 align-items-end">
                <div class="col-12 col-md">
                    <label class="form-label" for="customer-search">Find guest</label>
                    <input type="text" class="form-control" id="customer-search" name="search"
                           placeholder="Search by name, email, or phone..."
                           value="<?php echo htmlspecialchars($search_term, ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="col-6 col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
                <?php if ($search_term !== ''): ?>
                <div class="col-6 col-md-auto">
                    <a href="<?php echo base_url('customers'); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-list-ul"></i> Customer List</span>
        </div>
        <div class="card-body">
            <!-- Mobile card list -->
            <div class="customers-mobile-list">
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <?php
                        $full_name = trim($customer->first_name . ' ' . $customer->last_name);
                        $phone = !empty($customer->phone) ? $customer->phone : '-';
                        $address_parts = array_filter(array(
                            isset($customer->address) ? $customer->address : '',
                            isset($customer->city) ? $customer->city : '',
                            isset($customer->province) ? $customer->province : '',
                        ));
                        $address = !empty($address_parts) ? implode(', ', $address_parts) : '-';
                        $status = isset($customer->status) ? $customer->status : 'inactive';
                        $status_badge = ($status === 'active') ? 'success' : 'secondary';
                        $view_url = base_url('customers/view/' . (int) $customer->id);
                        $edit_url = base_url('customers/edit/' . (int) $customer->id);
                        $delete_url = base_url('customers/delete/' . (int) $customer->id);
                        ?>
                        <div class="card card-bordered customer-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <div class="min-w-0">
                                        <div class="small text-muted">#<?php echo (int) $customer->id; ?></div>
                                        <p class="customer-card-title"><?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="badge bg-<?php echo $status_badge; ?>">
                                        <?php echo ucfirst($status); ?>
                                    </span>
                                </div>
                                <div class="customer-meta">
                                    <div>
                                        <span>Email</span>
                                        <strong><?php echo htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Phone</span>
                                        <strong><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                    <div>
                                        <span>Address</span>
                                        <strong><?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                </div>
                                <?php if ($can_edit || $can_delete): ?>
                                <div class="customer-actions">
                                    <?php if ($can_edit): ?>
                                    <a href="<?php echo $view_url; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($can_delete): ?>
                                    <a href="<?php echo $delete_url; ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this customer/guest?');">
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
                            No customers/guests found
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Desktop table -->
            <div class="customers-desktop-table">
                <div class="table-responsive">
                    <table class="table table-hover no-datatables" id="customersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $customer): ?>
                                    <?php
                                    $full_name = trim($customer->first_name . ' ' . $customer->last_name);
                                    $phone = !empty($customer->phone) ? $customer->phone : '-';
                                    $address_parts = array_filter(array(
                                        isset($customer->address) ? $customer->address : '',
                                        isset($customer->city) ? $customer->city : '',
                                        isset($customer->province) ? $customer->province : '',
                                    ));
                                    $address = !empty($address_parts) ? implode(', ', $address_parts) : '-';
                                    $status = isset($customer->status) ? $customer->status : 'inactive';
                                    $status_badge = ($status === 'active') ? 'success' : 'secondary';
                                    ?>
                                    <tr>
                                        <td><?php echo (int) $customer->id; ?></td>
                                        <td><strong><?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                                        <td><?php echo htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo $status_badge; ?>">
                                                <?php echo ucfirst($status); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($can_edit): ?>
                                            <a href="<?php echo base_url('customers/view/' . (int) $customer->id); ?>" class="btn btn-sm btn-info" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('customers/edit/' . (int) $customer->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>
                                            <a href="<?php echo base_url('customers/delete/' . (int) $customer->id); ?>" class="btn btn-sm btn-danger" title="Delete"
                                               onclick="return confirm('Are you sure you want to delete this customer/guest?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No customers/guests found</td>
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

    function initCustomersDesktopTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        if (window.matchMedia && !window.matchMedia('(min-width: 992px)').matches) {
            return;
        }

        var $table = $('#customersTable');
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
                    emptyTable: 'No customers/guests found'
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        } catch (e) {
            console.warn('Customers DataTable init failed', e);
        }
    }

    if ($) {
        $(initCustomersDesktopTable);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomersDesktopTable);
    } else {
        initCustomersDesktopTable();
    }
})(window, window.jQuery);
</script>
