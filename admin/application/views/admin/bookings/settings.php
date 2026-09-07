<?php
$s = function ($key, $default = '') use ($settings) {
    return isset($settings[$key]) ? $settings[$key] : $default;
};
?>

<style>
    .booking-settings-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .booking-settings-page .page-actions .btn {
        width: 100%;
    }

    .booking-settings-page .form-section-card {
        margin-bottom: 1rem;
    }

    .booking-settings-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .booking-settings-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    .booking-settings-page .form-check {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.75rem;
    }

    .booking-settings-page .form-check:last-child {
        margin-bottom: 0;
    }

    html.dark-mode .booking-settings-page .form-check,
    body.dark-mode .booking-settings-page .form-check {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .booking-settings-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .booking-settings-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .booking-settings-page .page-actions .btn {
            width: auto;
        }

        .booking-settings-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .booking-settings-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .booking-settings-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block booking-settings-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-gear"></i> Booking Settings</h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Defaults for booking status, schedule, payments, and notifications.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('bookings'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Bookings
                </a>
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

    <?php echo form_open('booking_settings', array('id' => 'booking-settings-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-sliders"></i> General Settings
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="default_status" class="form-label">Default Booking Status *</label>
                        <select class="form-select" id="default_status" name="default_status" required>
                            <option value="pending" <?php echo ($s('default_status') === 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="confirmed" <?php echo ($s('default_status') === 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                            <option value="cancelled" <?php echo ($s('default_status') === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            <option value="completed" <?php echo ($s('default_status') === 'completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                        <small class="form-text text-muted">Status assigned to new bookings.</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="booking_number_prefix" class="form-label">Booking Number Prefix</label>
                        <input type="text" class="form-control" id="booking_number_prefix" name="booking_number_prefix"
                               value="<?php echo htmlspecialchars($s('booking_number_prefix', 'BK')); ?>" maxlength="10">
                        <small class="form-text text-muted">e.g., BK, BIT, TOUR</small>
                    </div>
                    <div class="col-6 col-md-6">
                        <label for="min_booking_days" class="form-label">Minimum Booking Days</label>
                        <input type="number" class="form-control" id="min_booking_days" name="min_booking_days"
                               value="<?php echo htmlspecialchars($s('min_booking_days', '1')); ?>" min="1">
                        <small class="form-text text-muted">Minimum nights / days required.</small>
                    </div>
                    <div class="col-6 col-md-6">
                        <label for="max_booking_days" class="form-label">Maximum Booking Days</label>
                        <input type="number" class="form-control" id="max_booking_days" name="max_booking_days"
                               value="<?php echo htmlspecialchars($s('max_booking_days', '30')); ?>" min="1">
                        <small class="form-text text-muted">Maximum nights / days allowed.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-clock"></i> Check-in / Check-out Times
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="check_in_time" class="form-label">Check-in Time</label>
                        <input type="time" class="form-control" id="check_in_time" name="check_in_time"
                               value="<?php echo htmlspecialchars($s('check_in_time', '14:00')); ?>">
                        <small class="form-text text-muted">Default check-in time.</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="check_out_time" class="form-label">Check-out Time</label>
                        <input type="time" class="form-control" id="check_out_time" name="check_out_time"
                               value="<?php echo htmlspecialchars($s('check_out_time', '12:00')); ?>">
                        <small class="form-text text-muted">Default check-out time.</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="cancellation_hours" class="form-label">Cancellation Hours</label>
                        <input type="number" class="form-control" id="cancellation_hours" name="cancellation_hours"
                               value="<?php echo htmlspecialchars($s('cancellation_hours', '24')); ?>" min="0">
                        <small class="form-text text-muted">Hours before check-in for free cancellation.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-credit-card"></i> Payment Settings
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="require_payment" name="require_payment" value="1"
                                <?php echo ($s('require_payment') === '1') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="require_payment">
                                Require Payment Confirmation
                            </label>
                            <small class="form-text text-muted d-block">Require payment before confirming a booking.</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <label for="tax_rate" class="form-label">Tax Rate (%)</label>
                        <input type="number" class="form-control" id="tax_rate" name="tax_rate"
                               value="<?php echo htmlspecialchars($s('tax_rate', '0')); ?>" step="0.01" min="0" max="100">
                        <small class="form-text text-muted">Tax percentage added to booking total.</small>
                    </div>
                    <div class="col-6 col-md-6">
                        <label for="service_charge" class="form-label">Service Charge (%)</label>
                        <input type="number" class="form-control" id="service_charge" name="service_charge"
                               value="<?php echo htmlspecialchars($s('service_charge', '0')); ?>" step="0.01" min="0" max="100">
                        <small class="form-text text-muted">Service charge percentage.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-bell"></i> Notification Settings
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="send_email_notifications" name="send_email_notifications" value="1"
                        <?php echo ($s('send_email_notifications') === '1') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="send_email_notifications">
                        Send Email Notifications
                    </label>
                    <small class="form-text text-muted d-block">Email guests when a booking is created or updated.</small>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="auto_confirm_bookings" name="auto_confirm_bookings" value="1"
                        <?php echo ($s('auto_confirm_bookings') === '1') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="auto_confirm_bookings">
                        Auto-Confirm Bookings
                    </label>
                    <small class="form-text text-muted d-block">Automatically confirm new bookings.</small>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-file-text"></i> Additional Information
            </div>
            <div class="card-body">
                <label for="booking_notes" class="form-label">Booking Notes / Policy</label>
                <textarea class="form-control" id="booking_notes" name="booking_notes" rows="5"
                          placeholder="Enter booking policy, terms and conditions, or additional notes..."><?php echo htmlspecialchars($s('booking_notes')); ?></textarea>
                <small class="form-text text-muted">Optional text that can be shown to guests during booking.</small>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('bookings'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Settings
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
