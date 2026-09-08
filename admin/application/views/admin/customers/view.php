<?php
$can_edit = !empty($can_edit);
$can_delete = !empty($can_delete);
$full_name = trim($customer->first_name . ' ' . $customer->last_name);
$status = isset($customer->status) ? $customer->status : 'inactive';
$status_badge = ($status === 'active') ? 'success' : 'secondary';
$bookings = !empty($bookings) ? $bookings : array();

$val = function ($field, $fallback = '-') use ($customer) {
    if (!isset($customer->$field) || $customer->$field === '' || $customer->$field === null) {
        return $fallback;
    }
    return $customer->$field;
};
?>

<style>
    .customer-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .customer-view-page .page-actions .btn {
        width: 100%;
    }

    .customer-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .customer-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .customer-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .customer-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .customer-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .customer-view-page .notes-box {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        color: var(--text, #334155);
        white-space: pre-wrap;
        word-break: break-word;
    }

    .customer-view-page .booking-card {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.85rem;
    }

    .customer-view-page .booking-card:last-child {
        margin-bottom: 0;
    }

    .customer-view-page .bookings-desktop-table {
        display: none;
    }

    .customer-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .customer-view-page .notes-box,
    body.dark-mode .customer-view-page .notes-box,
    html.dark-mode .customer-view-page .booking-card,
    body.dark-mode .customer-view-page .booking-card {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .customer-view-page .detail-item .value,
    body.dark-mode .customer-view-page .detail-item .value {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .customer-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .customer-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .customer-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .customer-view-page .page-actions .btn {
            width: auto;
        }

        .customer-view-page .detail-grid.cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .customer-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .customer-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .customer-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }

    @media (min-width: 992px) {
        .customer-view-page .bookings-mobile-list {
            display: none !important;
        }

        .customer-view-page .bookings-desktop-table {
            display: block !important;
        }
    }
</style>

<div class="nk-block customer-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        Customer #<?php echo (int) $customer->id; ?>
                        &middot;
                        <span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('customers'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <?php if ($can_edit): ?>
                <a href="<?php echo base_url('customers/edit/' . (int) $customer->id); ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-person"></i> Personal Information</span>
        </div>
        <div class="card-body">
            <div class="detail-grid cols-3">
                <div class="detail-item">
                    <label>Full Name</label>
                    <div class="value"><?php echo htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <div class="value">
                        <a href="mailto:<?php echo htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Phone</label>
                    <div class="value"><?php echo htmlspecialchars($val('phone'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Date of Birth</label>
                    <div class="value"><?php echo !empty($customer->date_of_birth) ? date('M d, Y', strtotime($customer->date_of_birth)) : '-'; ?></div>
                </div>
                <div class="detail-item">
                    <label>Gender</label>
                    <div class="value"><?php echo !empty($customer->gender) ? ucfirst($customer->gender) : '-'; ?></div>
                </div>
                <div class="detail-item">
                    <label>Nationality</label>
                    <div class="value"><?php echo htmlspecialchars($val('nationality'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Status</label>
                    <div class="value"><span class="badge bg-<?php echo $status_badge; ?>"><?php echo ucfirst($status); ?></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-geo-alt"></i> Address Information</span>
        </div>
        <div class="card-body">
            <div class="detail-grid cols-3">
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <label>Street Address</label>
                    <div class="value"><?php echo htmlspecialchars($val('address'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>City</label>
                    <div class="value"><?php echo htmlspecialchars($val('city'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Province</label>
                    <div class="value"><?php echo htmlspecialchars($val('province'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Postal Code</label>
                    <div class="value"><?php echo htmlspecialchars($val('postal_code'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Country</label>
                    <div class="value"><?php echo htmlspecialchars($val('country', 'Philippines'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-card-text"></i> Identification</span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>ID Type</label>
                    <div class="value"><?php echo !empty($customer->id_type) ? ucfirst(str_replace('_', ' ', $customer->id_type)) : '-'; ?></div>
                </div>
                <div class="detail-item">
                    <label>ID Number</label>
                    <div class="value"><?php echo htmlspecialchars($val('id_number'), ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-clock"></i> Record Information</span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Created</label>
                    <div class="value"><?php echo !empty($customer->created_at) ? date('M d, Y g:i A', strtotime($customer->created_at)) : 'N/A'; ?></div>
                </div>
                <div class="detail-item">
                    <label>Last Updated</label>
                    <div class="value"><?php echo !empty($customer->updated_at) ? date('M d, Y g:i A', strtotime($customer->updated_at)) : 'N/A'; ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($customer->notes)): ?>
    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-sticky"></i> Notes</span>
        </div>
        <div class="card-body">
            <div class="notes-box"><?php echo htmlspecialchars($customer->notes, ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-calendar-check"></i> Booking History</span>
            <span class="badge bg-secondary"><?php echo count($bookings); ?> booking(s)</span>
        </div>
        <div class="card-body">
            <?php if (!empty($bookings)): ?>
                <div class="bookings-mobile-list">
                    <?php foreach ($bookings as $booking): ?>
                        <?php
                        $booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
                            ? $booking->booking_number
                            : str_pad($booking->id, 6, '0', STR_PAD_LEFT);
                        $b_status = strtolower((string) $booking->status);
                        $b_badge = 'secondary';
                        if ($b_status === 'confirmed') $b_badge = 'success';
                        elseif ($b_status === 'cancelled') $b_badge = 'danger';
                        elseif ($b_status === 'pending') $b_badge = 'warning';
                        elseif ($b_status === 'completed') $b_badge = 'info';
                        ?>
                        <div class="booking-card">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <div>
                                    <div class="small text-muted">#<?php echo htmlspecialchars($booking_number, ENT_QUOTES, 'UTF-8'); ?></div>
                                    <strong><?php echo htmlspecialchars($booking->room_name, ENT_QUOTES, 'UTF-8'); ?></strong>
                                </div>
                                <span class="badge bg-<?php echo $b_badge; ?>"><?php echo ucfirst($booking->status); ?></span>
                            </div>
                            <div class="detail-grid mb-3">
                                <div class="detail-item">
                                    <label>Check-In</label>
                                    <div class="value"><?php echo date('M d, Y', strtotime($booking->check_in)); ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Check-Out</label>
                                    <div class="value"><?php echo date('M d, Y', strtotime($booking->check_out)); ?></div>
                                </div>
                                <div class="detail-item">
                                    <label>Amount</label>
                                    <div class="value">₱<?php echo number_format($booking->total_amount, 2); ?></div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-sm btn-primary w-100">
                                <i class="bi bi-eye"></i> View Booking
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="table-responsive bookings-desktop-table">
                    <table class="table table-hover mb-0 no-datatables">
                        <thead>
                            <tr>
                                <th>Booking #</th>
                                <th>Package</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
                                    ? $booking->booking_number
                                    : str_pad($booking->id, 6, '0', STR_PAD_LEFT);
                                $b_status = strtolower((string) $booking->status);
                                $b_badge = 'secondary';
                                if ($b_status === 'confirmed') $b_badge = 'success';
                                elseif ($b_status === 'cancelled') $b_badge = 'danger';
                                elseif ($b_status === 'pending') $b_badge = 'warning';
                                elseif ($b_status === 'completed') $b_badge = 'info';
                                ?>
                                <tr>
                                    <td>#<?php echo htmlspecialchars($booking_number, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($booking->room_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($booking->check_in)); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($booking->check_out)); ?></td>
                                    <td><span class="badge bg-<?php echo $b_badge; ?>"><?php echo ucfirst($booking->status); ?></span></td>
                                    <td>₱<?php echo number_format($booking->total_amount, 2); ?></td>
                                    <td>
                                        <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-sm btn-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted mb-0">No bookings found for this customer/guest.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="sticky-actions">
        <div class="action-row d-grid gap-2 d-md-flex">
            <?php if ($can_delete): ?>
            <a href="<?php echo base_url('customers/delete/' . (int) $customer->id); ?>"
               class="btn btn-outline-danger"
               onclick="return confirm('Are you sure you want to delete this customer/guest?');">
                <i class="bi bi-trash"></i> Delete
            </a>
            <?php endif; ?>
            <a href="<?php echo base_url('customers'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
            <?php if ($can_edit): ?>
            <a href="<?php echo base_url('customers/edit/' . (int) $customer->id); ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Customer
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
