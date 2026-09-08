<?php
$selected_date = isset($selected_date) ? $selected_date : date('Y-m-d');
$total_revenue = isset($total_revenue) ? (float) $total_revenue : 0;
$total_bookings = isset($total_bookings) ? (int) $total_bookings : 0;
$confirmed_bookings = isset($confirmed_bookings) ? (int) $confirmed_bookings : 0;
$pending_bookings = isset($pending_bookings) ? (int) $pending_bookings : 0;
$daily_sales = !empty($daily_sales) ? $daily_sales : array();
$sales_by_room = !empty($sales_by_room) ? $sales_by_room : array();
$date_label = date('F d, Y', strtotime($selected_date));

$statusBadge = function ($status) {
    $status = strtolower((string) $status);
    if ($status === 'confirmed') return 'success';
    if ($status === 'cancelled') return 'danger';
    if ($status === 'pending') return 'warning';
    if ($status === 'completed') return 'info';
    return 'secondary';
};
?>

<style>
    .daily-sales-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .daily-sales-page .page-actions .btn {
        width: 100%;
    }

    .daily-sales-page .form-section-card {
        margin-bottom: 1rem;
    }

    .daily-sales-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .daily-sales-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .daily-sales-page .report-card {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.85rem;
    }

    .daily-sales-page .report-card:last-child {
        margin-bottom: 0;
    }

    .daily-sales-page .report-card-title {
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0 0 0.25rem;
        word-break: break-word;
    }

    .daily-sales-page .report-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.55rem 0.75rem;
        margin: 0.75rem 0;
        font-size: 0.85rem;
    }

    .daily-sales-page .report-meta span {
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
    }

    .daily-sales-page .sales-desktop-table,
    .daily-sales-page .bookings-desktop-table {
        display: none;
    }

    .daily-sales-page .print-header {
        display: block;
        text-align: center;
        margin-bottom: 1.25rem;
        padding-bottom: 0.85rem;
        border-bottom: 2px solid var(--card-border, #e2e8f0);
    }

    .daily-sales-page .print-footer,
    .daily-sales-page .summary-table {
        display: none;
    }

    html.dark-mode .daily-sales-page .report-card,
    body.dark-mode .daily-sales-page .report-card {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .daily-sales-page .report-card-title,
    body.dark-mode .daily-sales-page .report-card-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 768px) {
        .daily-sales-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .daily-sales-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .daily-sales-page .page-actions .btn {
            width: auto;
        }
    }

    @media (min-width: 992px) {
        .daily-sales-page .sales-mobile-list,
        .daily-sales-page .bookings-mobile-list {
            display: none !important;
        }

        .daily-sales-page .sales-desktop-table,
        .daily-sales-page .bookings-desktop-table {
            display: block !important;
        }
    }

    @media print {
        .nk-sidebar,
        .nk-header,
        .sidebar-overlay,
        .page-actions,
        .no-print,
        .alert,
        form,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            display: none !important;
        }

        .nk-content,
        .main-content,
        .content-area {
            margin-left: 0 !important;
            padding: 20px !important;
            width: 100% !important;
        }

        body {
            background: white !important;
            font-size: 12px !important;
        }

        .daily-sales-page .print-header {
            display: block !important;
            border-bottom: 2px solid #000 !important;
        }

        .daily-sales-page .print-footer {
            display: block !important;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .daily-sales-page .summary-table {
            display: table !important;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .daily-sales-page .summary-table-row {
            display: table-row !important;
        }

        .daily-sales-page .summary-table-cell {
            display: table-cell !important;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .daily-sales-page .summary-table-cell .title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .daily-sales-page .summary-table-cell .amount {
            font-size: 16px;
            font-weight: bold;
        }

        .daily-sales-page .sales-mobile-list,
        .daily-sales-page .bookings-mobile-list {
            display: none !important;
        }

        .daily-sales-page .sales-desktop-table,
        .daily-sales-page .bookings-desktop-table {
            display: block !important;
        }

        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            page-break-inside: avoid;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table th,
        table td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
            font-size: 11px;
        }

        table th {
            background: #f5f5f5 !important;
        }
    }
</style>

<div class="nk-block daily-sales-page">
    <div class="print-header">
        <h1 style="font-size: 1.5rem; margin: 0 0 0.35rem; font-weight: 700;">BOHOL ISLAND TOURS</h1>
        <div class="report-date text-muted">Daily Sales Report — <?php echo $date_label; ?></div>
        <div class="small text-muted">Generated on: <?php echo date('F d, Y g:i A'); ?></div>
    </div>

    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-graph-up"></i> Daily Sales Report
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Sales and booking statistics for a selected date.</p>
                </div>
            </div>
            <div class="page-actions no-print">
                <a href="<?php echo base_url('reports/export_excel?date=' . urlencode($selected_date)); ?>" class="btn btn-outline-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
                <button type="button" onclick="window.print()" class="btn btn-outline-secondary">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show no-print" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show no-print" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card card-bordered form-section-card no-print">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-calendar3"></i> Report Date</span>
        </div>
        <div class="card-body">
            <form method="get" action="<?php echo base_url('reports/daily_sales'); ?>" class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="date" class="form-label">Select Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($selected_date, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-3 no-print">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-card-icon"><i class="bi bi-cash-coin"></i></div>
                <div class="stat-card-value">₱<?php echo number_format($total_revenue, 2); ?></div>
                <div class="stat-card-label">Total Revenue</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card info">
                <div class="stat-card-icon"><i class="bi bi-journal-check"></i></div>
                <div class="stat-card-value"><?php echo $total_bookings; ?></div>
                <div class="stat-card-label">Total Bookings</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card secondary">
                <div class="stat-card-icon"><i class="bi bi-check-circle"></i></div>
                <div class="stat-card-value"><?php echo $confirmed_bookings; ?></div>
                <div class="stat-card-label">Confirmed</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card warning">
                <div class="stat-card-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-card-value"><?php echo $pending_bookings; ?></div>
                <div class="stat-card-label">Pending</div>
            </div>
        </div>
    </div>

    <div class="summary-table">
        <div class="summary-table-row">
            <div class="summary-table-cell">
                <div class="title">Total Revenue</div>
                <div class="amount">₱<?php echo number_format($total_revenue, 2); ?></div>
            </div>
            <div class="summary-table-cell">
                <div class="title">Total Bookings</div>
                <div class="amount"><?php echo $total_bookings; ?></div>
            </div>
            <div class="summary-table-cell">
                <div class="title">Confirmed</div>
                <div class="amount"><?php echo $confirmed_bookings; ?></div>
            </div>
            <div class="summary-table-cell">
                <div class="title">Pending</div>
                <div class="amount"><?php echo $pending_bookings; ?></div>
            </div>
        </div>
    </div>

    <?php if (!empty($sales_by_room)): ?>
    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-map"></i> Sales by Package</span>
        </div>
        <div class="card-body">
            <div class="sales-mobile-list">
                <?php foreach ($sales_by_room as $room_sale): ?>
                    <div class="report-card">
                        <p class="report-card-title"><?php echo htmlspecialchars($room_sale->room_name, ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="small text-muted mb-2"><?php echo htmlspecialchars($room_sale->room_type, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="report-meta">
                            <div>
                                <span>Bookings</span>
                                <strong><?php echo (int) $room_sale->booking_count; ?></strong>
                            </div>
                            <div>
                                <span>Revenue</span>
                                <strong>₱<?php echo number_format($room_sale->total_revenue, 2); ?></strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="table-responsive sales-desktop-table">
                <table class="table table-hover mb-0 no-datatables">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Package</th>
                            <th>Bookings</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales_by_room as $room_sale): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($room_sale->room_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($room_sale->room_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><span class="badge bg-info"><?php echo (int) $room_sale->booking_count; ?></span></td>
                                <td><strong>₱<?php echo number_format($room_sale->total_revenue, 2); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-receipt"></i> Bookings for <?php echo $date_label; ?></span>
            <span class="badge bg-secondary"><?php echo count($daily_sales); ?> record(s)</span>
        </div>
        <div class="card-body">
            <div class="bookings-mobile-list">
                <?php if (!empty($daily_sales)): ?>
                    <?php foreach ($daily_sales as $booking): ?>
                        <?php
                        $booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
                            ? $booking->booking_number
                            : str_pad($booking->id, 6, '0', STR_PAD_LEFT);
                        $badge = $statusBadge($booking->status);
                        ?>
                        <div class="report-card">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                <div class="min-w-0">
                                    <div class="small text-muted">#<?php echo htmlspecialchars($booking_number, ENT_QUOTES, 'UTF-8'); ?></div>
                                    <p class="report-card-title"><?php echo htmlspecialchars($booking->guest_name, ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <span class="badge bg-<?php echo $badge; ?>"><?php echo ucfirst($booking->status); ?></span>
                            </div>
                            <div class="small text-muted mb-2">
                                <?php echo htmlspecialchars($booking->room_name, ENT_QUOTES, 'UTF-8'); ?>
                                <?php if (!empty($booking->room_code)): ?>
                                    · <code><?php echo htmlspecialchars($booking->room_code, ENT_QUOTES, 'UTF-8'); ?></code>
                                <?php endif; ?>
                            </div>
                            <div class="report-meta">
                                <div>
                                    <span>Check-In</span>
                                    <strong><?php echo date('M d, Y', strtotime($booking->check_in)); ?></strong>
                                </div>
                                <div>
                                    <span>Check-Out</span>
                                    <strong><?php echo date('M d, Y', strtotime($booking->check_out)); ?></strong>
                                </div>
                                <div>
                                    <span>Guests</span>
                                    <strong><?php echo (int) $booking->guests; ?></strong>
                                </div>
                                <div>
                                    <span>Amount</span>
                                    <strong>₱<?php echo number_format($booking->total_amount, 2); ?></strong>
                                </div>
                            </div>
                            <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-sm btn-primary w-100 no-print">
                                <i class="bi bi-eye"></i> View Booking
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <div class="report-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Total Revenue</strong>
                            <strong>₱<?php echo number_format($total_revenue, 2); ?></strong>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="report-card text-center text-muted py-4">No bookings found for this date</div>
                <?php endif; ?>
            </div>

            <div class="table-responsive bookings-desktop-table">
                <table class="table table-hover no-datatables" id="dailySalesTable">
                    <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>Guest</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Package</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th class="no-print">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($daily_sales)): ?>
                            <?php foreach ($daily_sales as $booking): ?>
                                <?php
                                $booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
                                    ? $booking->booking_number
                                    : str_pad($booking->id, 6, '0', STR_PAD_LEFT);
                                $badge = $statusBadge($booking->status);
                                ?>
                                <tr>
                                    <td>#<?php echo htmlspecialchars($booking_number, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($booking->guest_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($booking->guest_email, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($booking->guest_phone, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($booking->room_name, ENT_QUOTES, 'UTF-8'); ?>
                                        <?php if (!empty($booking->room_code)): ?>
                                            <br><small class="text-muted"><?php echo htmlspecialchars($booking->room_code, ENT_QUOTES, 'UTF-8'); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($booking->check_in)); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($booking->check_out)); ?></td>
                                    <td><?php echo (int) $booking->guests; ?></td>
                                    <td><span class="badge bg-<?php echo $badge; ?>"><?php echo ucfirst($booking->status); ?></span></td>
                                    <td><strong>₱<?php echo number_format($booking->total_amount, 2); ?></strong></td>
                                    <td><?php echo date('M d, Y g:i A', strtotime($booking->created_at)); ?></td>
                                    <td class="no-print">
                                        <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-sm btn-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center text-muted">No bookings found for this date</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-end"><strong>Total Revenue</strong></td>
                            <td colspan="2"><strong>₱<?php echo number_format($total_revenue, 2); ?></strong></td>
                            <td class="no-print"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="print-footer">
        <div>BOHOL ISLAND TOURS — Daily Sales Report</div>
        <div><?php echo $date_label; ?></div>
    </div>
</div>

<script>
(function (window, $) {
    'use strict';

    function initDailySalesTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        if (window.matchMedia && !window.matchMedia('(min-width: 992px)').matches) {
            return;
        }

        var $table = $('#dailySalesTable');
        if (!$table.length || $.fn.DataTable.isDataTable($table)) {
            return;
        }

        var rows = $table.find('tbody tr');
        if (!rows.length || (rows.length === 1 && rows.find('td[colspan]').length > 0)) {
            return;
        }

        try {
            $table.DataTable({
                order: [[10, 'desc']],
                pageLength: 25,
                responsive: false,
                autoWidth: false,
                language: {
                    search: 'Search:',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    emptyTable: 'No bookings found for this date'
                }
            });
        } catch (e) {
            console.warn('Daily sales DataTable init failed', e);
        }
    }

    if ($) {
        $(initDailySalesTable);
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDailySalesTable);
    } else {
        initDailySalesTable();
    }
})(window, window.jQuery);
</script>
