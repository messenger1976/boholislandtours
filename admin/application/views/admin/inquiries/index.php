<?php
$filter_status = isset($filter_status) ? $filter_status : '';
$filter_range = isset($filter_range) ? $filter_range : 'today';
$filter_date_from = isset($filter_date_from) ? $filter_date_from : date('Y-m-d');
$filter_date_to = isset($filter_date_to) ? $filter_date_to : date('Y-m-d');
$date_query = isset($date_query) ? $date_query : ('range=today&date_from=' . date('Y-m-d') . '&date_to=' . date('Y-m-d'));
$can_delete = !empty($can_delete);
$can_edit = !empty($can_edit);

$statusLinkBase = base_url('inquiries');
$buildStatusUrl = function ($status = '') use ($statusLinkBase, $date_query) {
    $params = array();
    if ($status !== '') {
        $params[] = 'status=' . urlencode($status);
    }
    if ($date_query !== '') {
        $params[] = $date_query;
    }
    return $statusLinkBase . (!empty($params) ? ('?' . implode('&', $params)) : '');
};

$fetchRedirect = 'inquiries';
$fetchParams = array();
if ($filter_status) {
    $fetchParams[] = 'status=' . urlencode($filter_status);
}
if ($date_query) {
    $fetchParams[] = $date_query;
}
if (!empty($fetchParams)) {
    $fetchRedirect .= '?' . implode('&', $fetchParams);
}

$statusBadge = function ($status) {
    if ($status === 'new') return 'danger';
    if ($status === 'guest_replied') return 'primary';
    if ($status === 'read') return 'warning';
    if ($status === 'replied') return 'success';
    if ($status === 'closed') return 'info';
    return 'secondary';
};
?>

<style>
    .inquiries-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .inquiries-page .page-actions .btn,
    .inquiries-page .page-actions form {
        width: 100%;
    }

    .inquiries-page .page-actions .btn {
        width: 100%;
    }

    .inquiries-page .form-section-card {
        margin-bottom: 1rem;
    }

    .inquiries-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .inquiries-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .inquiries-page .mob-filter-chips .btn {
        border-radius: 999px;
    }

    .inquiries-page .inquiries-list-wrap .dataTables_wrapper .dataTables_length,
    .inquiries-page .inquiries-list-wrap .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.75rem;
    }

    .inquiries-page .inquiries-list-wrap .dataTables_wrapper .dataTables_info,
    .inquiries-page .inquiries-list-wrap .dataTables_wrapper .dataTables_paginate {
        margin-top: 0.75rem;
    }

    @media (min-width: 768px) {
        .inquiries-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .inquiries-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .inquiries-page .page-actions,
        .inquiries-page .page-actions form,
        .inquiries-page .page-actions .btn {
            width: auto;
        }
    }

    /* Mobile: keep DataTables controls, hide table, show card rows */
    @media (max-width: 991.98px) {
        .inquiries-page .mob-desktop-table {
            display: block !important;
            overflow: visible !important;
        }

        .inquiries-page .mob-desktop-table > table,
        .inquiries-page .dataTables_wrapper > table,
        .inquiries-page table.dataTable {
            display: none !important;
        }

        .inquiries-page .mob-card-list {
            display: block !important;
            width: 100%;
            margin: 0.25rem 0 0.5rem;
        }
    }

    @media (min-width: 992px) {
        .inquiries-page .mob-card-list {
            display: none !important;
        }
    }
</style>

<div class="nk-block inquiries-page"
     id="inquiries-live-root"
     data-live-list="1"
     data-revision="<?php echo htmlspecialchars(isset($list_revision) ? $list_revision : '', ENT_QUOTES, 'UTF-8'); ?>"
     data-status="<?php echo htmlspecialchars($filter_status, ENT_QUOTES, 'UTF-8'); ?>"
     data-range="<?php echo htmlspecialchars($filter_range, ENT_QUOTES, 'UTF-8'); ?>"
     data-date-from="<?php echo htmlspecialchars($filter_date_from, ENT_QUOTES, 'UTF-8'); ?>"
     data-date-to="<?php echo htmlspecialchars($filter_date_to, ENT_QUOTES, 'UTF-8'); ?>"
     data-can-delete="<?php echo $can_delete ? '1' : '0'; ?>"
     data-can-edit="<?php echo $can_edit ? '1' : '0'; ?>">

    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title" id="inquiries-live-title">
                    <i class="bi bi-envelope"></i> Contact Inquiries
                    (<span id="inquiries-live-count"><?php echo (int) $counts['all']; ?></span>)
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Latest inquiry on <span id="inquiries-live-latest"><?php echo getCreateDate('inquiryid', 'inquiry'); ?></span>
                        <span id="inquiries-live-updated" class="ms-2 text-success" style="display:none;"></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_edit): ?>
                <form action="<?php echo base_url('inquiries/fetchinbound'); ?>" method="post" class="m-0">
                    <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($fetchRedirect, ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-repeat"></i> Check Email Replies
                    </button>
                </form>
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
            <span class="header-title"><i class="bi bi-funnel"></i> Filters</span>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex flex-wrap gap-1 mob-filter-chips" id="inquiries-status-chips">
                <a href="<?php echo $buildStatusUrl(''); ?>" class="btn btn-sm <?php echo empty($filter_status) ? 'btn-primary' : 'btn-outline-primary'; ?>" data-status="">All (<span data-count="all"><?php echo (int) $counts['all']; ?></span>)</a>
                <a href="<?php echo $buildStatusUrl('new'); ?>" class="btn btn-sm <?php echo $filter_status === 'new' ? 'btn-danger' : 'btn-outline-danger'; ?>" data-status="new">New (<span data-count="new"><?php echo (int) $counts['new']; ?></span>)</a>
                <a href="<?php echo $buildStatusUrl('guest_replied'); ?>" class="btn btn-sm <?php echo $filter_status === 'guest_replied' ? 'btn-primary' : 'btn-outline-primary'; ?>" data-status="guest_replied">Guest Replied (<span data-count="guest_replied"><?php echo (int) $counts['guest_replied']; ?></span>)</a>
                <a href="<?php echo $buildStatusUrl('read'); ?>" class="btn btn-sm <?php echo $filter_status === 'read' ? 'btn-warning' : 'btn-outline-warning'; ?>" data-status="read">Read (<span data-count="read"><?php echo (int) $counts['read']; ?></span>)</a>
                <a href="<?php echo $buildStatusUrl('replied'); ?>" class="btn btn-sm <?php echo $filter_status === 'replied' ? 'btn-success' : 'btn-outline-success'; ?>" data-status="replied">Replied (<span data-count="replied"><?php echo (int) $counts['replied']; ?></span>)</a>
                <a href="<?php echo $buildStatusUrl('closed'); ?>" class="btn btn-sm <?php echo $filter_status === 'closed' ? 'btn-secondary' : 'btn-outline-secondary'; ?>" data-status="closed">Closed (<span data-count="closed"><?php echo (int) $counts['closed']; ?></span>)</a>
            </div>

            <form id="inquiry-date-filter" class="inquiry-date-filter row g-2 align-items-end" method="get" action="<?php echo base_url('inquiries'); ?>">
                <?php if ($filter_status) { ?>
                    <input type="hidden" name="status" value="<?php echo htmlspecialchars($filter_status, ENT_QUOTES, 'UTF-8'); ?>">
                <?php } ?>
                <div class="col-6 col-md-auto">
                    <label class="form-label mb-0 small" for="inquiry-range">Date range</label>
                    <select name="range" id="inquiry-range" class="form-select form-select-sm">
                        <option value="today" <?php echo $filter_range === 'today' ? 'selected' : ''; ?>>Today</option>
                        <option value="7" <?php echo $filter_range === '7' ? 'selected' : ''; ?>>Last 7 Days</option>
                        <option value="30" <?php echo $filter_range === '30' ? 'selected' : ''; ?>>Last 30 Days</option>
                        <option value="custom" <?php echo $filter_range === 'custom' ? 'selected' : ''; ?>>Custom</option>
                    </select>
                </div>
                <div class="col-6 col-md-auto">
                    <label class="form-label mb-0 small" for="inquiry-date-from">From</label>
                    <input type="date" class="form-control form-control-sm" name="date_from" id="inquiry-date-from" value="<?php echo htmlspecialchars($filter_date_from, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $filter_range !== 'custom' ? 'readonly' : ''; ?>>
                </div>
                <div class="col-6 col-md-auto">
                    <label class="form-label mb-0 small" for="inquiry-date-to">To</label>
                    <input type="date" class="form-control form-control-sm" name="date_to" id="inquiry-date-to" value="<?php echo htmlspecialchars($filter_date_to, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $filter_range !== 'custom' ? 'readonly' : ''; ?>>
                </div>
                <div class="col-6 col-md-auto">
                    <button type="submit" class="btn btn-sm btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-inbox"></i> Inbox</span>
        </div>
        <div class="card-body inquiries-list-wrap">
            <div class="table-responsive mob-desktop-table">
                <table class="table table-hover no-datatables" id="inquiriesTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inquiries-live-tbody">
                        <?php
                        $i = 0;
                        foreach ($inquiries as $row) {
                            $i++;
                            $badge = $statusBadge($row->status);
                            $href = base_url('inquiries/' . (int) $row->inquiryid);
                            $dateDisplay = !empty($row->created_at) ? date('M j, Y g:i A', strtotime($row->created_at)) : $row->cdate;
                            $isBold = in_array($row->status, array('new', 'guest_replied'), TRUE);
                            ?>
                            <tr class="inquiry-row-link"
                                data-href="<?php echo $href; ?>"
                                data-name="<?php echo htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8'); ?>"
                                data-email="<?php echo htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8'); ?>"
                                data-subject="<?php echo htmlspecialchars($row->subject, ENT_QUOTES, 'UTF-8'); ?>"
                                data-status="<?php echo htmlspecialchars($row->status, ENT_QUOTES, 'UTF-8'); ?>"
                                data-date="<?php echo htmlspecialchars($dateDisplay, ENT_QUOTES, 'UTF-8'); ?>"
                                data-delete-url="<?php echo $can_delete ? htmlspecialchars(base_url('inquiries/delete/' . (int) $row->inquiryid), ENT_QUOTES, 'UTF-8') : ''; ?>"
                                style="cursor:pointer;<?php echo $isBold ? 'font-weight:600;' : ''; ?>">
                                <td><?php echo $i; ?></td>
                                <td><?php echo htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars(character_limiter($row->subject, 40), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><span class="badge bg-<?php echo $badge; ?>"><?php echo ucwords(str_replace('_', ' ', $row->status)); ?></span></td>
                                <td><?php echo htmlspecialchars($dateDisplay, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="inquiry-row-actions" onclick="event.stopPropagation();">
                                    <a href="<?php echo $href; ?>" class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i></a>
                                    <?php if ($can_delete): ?>
                                    <a href="<?php echo base_url('inquiries/delete/' . (int) $row->inquiryid); ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Delete this inquiry permanently?');"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($inquiries)): ?>
                            <tr><td colspan="7" class="text-center text-muted">No inquiries found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mob-card-list" id="inquiries-live-cards" aria-live="polite"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var range = document.getElementById('inquiry-range');
    var from = document.getElementById('inquiry-date-from');
    var to = document.getElementById('inquiry-date-to');
    if (range) {
        range.addEventListener('change', function () {
            var custom = range.value === 'custom';
            from.readOnly = !custom;
            to.readOnly = !custom;
        });
    }

    if (typeof window.initInquiriesDataTable === 'function') {
        window.initInquiriesDataTable();
    }
});
</script>
