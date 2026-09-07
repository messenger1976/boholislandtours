<?php
$booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
    ? $booking->booking_number
    : str_pad($booking->id, 6, '0', STR_PAD_LEFT);
$can_edit = !empty($can_edit);
$status = strtolower((string) $booking->status);
$status_badge = 'secondary';
if ($status === 'confirmed') $status_badge = 'success';
elseif ($status === 'cancelled') $status_badge = 'danger';
elseif ($status === 'pending') $status_badge = 'warning';
elseif ($status === 'completed') $status_badge = 'info';

$package_count = !empty($booking_items) ? count($booking_items) : (isset($booking->rooms) ? (int) $booking->rooms : 1);
$has_address = !empty($booking->guest_address)
    || !empty($booking->guest_city)
    || !empty($booking->guest_province)
    || !empty($booking->guest_country)
    || !empty($booking->guest_zipcode);
?>

<style>
    .booking-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .booking-view-page .page-actions .btn {
        width: 100%;
    }

    .booking-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .booking-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .booking-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .booking-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .booking-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .booking-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .booking-view-page .detail-item .value.amount {
        color: var(--success, #198754);
        font-size: 1.15rem;
        font-weight: 700;
    }

    .booking-view-page .package-row {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.85rem;
    }

    .booking-view-page .package-row:last-child {
        margin-bottom: 0;
    }

    .booking-view-page .package-row-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.85rem;
    }

    .booking-view-page .package-row-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0 0 0.2rem;
    }

    .booking-view-page .package-row-meta {
        font-size: 0.8125rem;
        color: var(--muted, #64748b);
        margin: 0;
    }

    .booking-view-page .notes-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        color: var(--text, #334155);
        white-space: pre-wrap;
    }

    .booking-view-page .mob-desktop-table {
        display: none;
    }

    .booking-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .booking-view-page .package-row,
    body.dark-mode .booking-view-page .package-row,
    html.dark-mode .booking-view-page .notes-box,
    body.dark-mode .booking-view-page .notes-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .booking-view-page .detail-item .value,
    body.dark-mode .booking-view-page .detail-item .value,
    html.dark-mode .booking-view-page .package-row-title,
    body.dark-mode .booking-view-page .package-row-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .booking-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .booking-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .booking-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .booking-view-page .page-actions .btn {
            width: auto;
        }

        .booking-view-page .detail-grid.cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .booking-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .booking-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .booking-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }

    @media (min-width: 992px) {
        .booking-view-page .mob-card-list {
            display: none !important;
        }

        .booking-view-page .mob-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block booking-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-receipt"></i> Booking #<?php echo htmlspecialchars($booking_number); ?></h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Created <?php echo date('M j, Y g:i A', strtotime($booking->created_at)); ?>
                        &middot;
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($booking->status); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('bookings'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <?php if ($can_edit): ?>
                <a href="<?php echo base_url('bookings/edit/' . (int) $booking->id); ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-person"></i> Guest Information</span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Full Name</label>
                    <div class="value"><?php echo htmlspecialchars($booking->guest_name); ?></div>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <div class="value">
                        <a href="mailto:<?php echo htmlspecialchars($booking->guest_email); ?>"><?php echo htmlspecialchars($booking->guest_email); ?></a>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Phone</label>
                    <div class="value">
                        <a href="tel:<?php echo htmlspecialchars($booking->guest_phone); ?>"><?php echo htmlspecialchars($booking->guest_phone); ?></a>
                    </div>
                </div>
                <?php if ($has_address): ?>
                <div class="detail-item">
                    <label>Address</label>
                    <div class="value">
                        <?php
                        $address_parts = array_filter(array(
                            isset($booking->guest_address) ? $booking->guest_address : '',
                            isset($booking->guest_city) ? $booking->guest_city : '',
                            isset($booking->guest_province) ? $booking->guest_province : '',
                            isset($booking->guest_country) ? $booking->guest_country : '',
                            isset($booking->guest_zipcode) ? $booking->guest_zipcode : '',
                        ));
                        echo htmlspecialchars(implode(', ', $address_parts));
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-calculator"></i> Booking Summary</span>
        </div>
        <div class="card-body">
            <div class="detail-grid cols-3">
                <div class="detail-item">
                    <label>Booking Number</label>
                    <div class="value">#<?php echo htmlspecialchars($booking_number); ?></div>
                </div>
                <div class="detail-item">
                    <label>Total Packages</label>
                    <div class="value"><?php echo (int) $package_count; ?></div>
                </div>
                <div class="detail-item">
                    <label>Total Guests</label>
                    <div class="value"><?php echo (int) $booking->guests; ?> person(s)</div>
                </div>
                <div class="detail-item">
                    <label>Status</label>
                    <div class="value"><span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($booking->status); ?></span></div>
                </div>
                <div class="detail-item">
                    <label>Booking Date</label>
                    <div class="value"><?php echo date('F d, Y', strtotime($booking->created_at)); ?></div>
                </div>
                <div class="detail-item">
                    <label>Total Amount</label>
                    <div class="value amount">₱<?php echo number_format($booking->total_amount, 2); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-map"></i> Package Details</span>
            <?php if (!empty($booking_items)): ?>
                <span class="badge bg-secondary"><?php echo count($booking_items); ?> package(s)</span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if (!empty($booking_items)): ?>
                <div class="mob-card-list d-lg-none">
                    <?php foreach ($booking_items as $index => $item): ?>
                        <?php
                        $item_status = strtolower((string) $item->status);
                        $item_badge = 'secondary';
                        if ($item_status === 'confirmed') $item_badge = 'success';
                        elseif ($item_status === 'cancelled') $item_badge = 'danger';
                        elseif ($item_status === 'pending') $item_badge = 'warning';
                        elseif ($item_status === 'completed') $item_badge = 'info';
                        $item_name = !empty($item->room_name) ? $item->room_name : 'Package';
                        $item_type = !empty($item->room_type) ? $item->room_type : '';
                        ?>
                        <div class="package-row">
                            <div class="package-row-head">
                                <div>
                                    <p class="package-row-title"><?php echo htmlspecialchars($item_name); ?></p>
                                    <?php if ($item_type): ?>
                                        <p class="package-row-meta"><?php echo htmlspecialchars($item_type); ?></p>
                                    <?php endif; ?>
                                </div>
                                <span class="badge bg-<?php echo $item_badge; ?>"><?php echo ucfirst($item->status); ?></span>
                            </div>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <label>Check-In</label>
                                    <div class="value"><?php echo date('M d, Y', strtotime($item->check_in)); ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Check-Out</label>
                                    <div class="value"><?php echo date('M d, Y', strtotime($item->check_out)); ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Nights / Days</label>
                                    <div class="value"><?php echo (int) $item->nights; ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Guests</label>
                                    <div class="value"><?php echo (int) $booking->guests; ?> person(s)</div>
                                </div>
                                <div class="detail-item">
                                    <label>Unit Price</label>
                                    <div class="value">₱<?php echo number_format($item->price_per_night, 2); ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Subtotal</label>
                                    <div class="value amount">₱<?php echo number_format($item->subtotal, 2); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="table-responsive mob-desktop-table">
                    <table class="table table-hover mb-0 no-datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Nights</th>
                                <th>Guests</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($booking_items as $index => $item): ?>
                                <?php
                                $item_status = strtolower((string) $item->status);
                                $item_badge = 'secondary';
                                if ($item_status === 'confirmed') $item_badge = 'success';
                                elseif ($item_status === 'cancelled') $item_badge = 'danger';
                                elseif ($item_status === 'pending') $item_badge = 'warning';
                                elseif ($item_status === 'completed') $item_badge = 'info';
                                $item_name = !empty($item->room_name) ? $item->room_name : 'Package';
                                $item_type = !empty($item->room_type) ? $item->room_type : '';
                                ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <div class="fw-semibold"><?php echo htmlspecialchars($item_name); ?></div>
                                        <?php if ($item_type): ?>
                                            <small class="text-muted"><?php echo htmlspecialchars($item_type); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($item->check_in)); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($item->check_out)); ?></td>
                                    <td><?php echo (int) $item->nights; ?></td>
                                    <td><?php echo (int) $booking->guests; ?></td>
                                    <td>₱<?php echo number_format($item->price_per_night, 2); ?></td>
                                    <td><strong>₱<?php echo number_format($item->subtotal, 2); ?></strong></td>
                                    <td><span class="badge bg-<?php echo $item_badge; ?>"><?php echo ucfirst($item->status); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-end"><strong>Total Amount</strong></td>
                                <td colspan="2"><strong>₱<?php echo number_format($booking->total_amount, 2); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mb-0">
                    No itemized package details found for this booking.
                    <?php if (!$this->db->table_exists('booking_items')): ?>
                        <br><small>The <code>booking_items</code> table may not exist. Run <code>admin/sql/create_booking_items_table.sql</code>.</small>
                    <?php else: ?>
                        <br><small>This booking may have been created before package itemization was added.</small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($booking->notes)): ?>
    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-sticky"></i> Additional Notes</span>
        </div>
        <div class="card-body">
            <div class="notes-box"><?php echo htmlspecialchars($booking->notes); ?></div>
        </div>
    </div>
    <?php endif; ?>

    <div class="sticky-actions">
        <div class="action-row d-grid gap-2 d-md-flex">
            <a href="<?php echo base_url('bookings'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
            <?php if ($can_edit): ?>
            <a href="<?php echo base_url('bookings/edit/' . (int) $booking->id); ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Booking
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
