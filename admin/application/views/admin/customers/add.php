<style>
    .customer-add-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .customer-add-page .page-actions .btn {
        width: 100%;
    }

    .customer-add-page .form-section-card {
        margin-bottom: 1rem;
    }

    .customer-add-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .customer-add-page .switch-box {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
    }

    .customer-add-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .customer-add-page .switch-box,
    body.dark-mode .customer-add-page .switch-box {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .customer-add-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .customer-add-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .customer-add-page .page-actions .btn {
            width: auto;
        }

        .customer-add-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .customer-add-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .customer-add-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block customer-add-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-plus-circle"></i> Add Customer / Guest
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Register a new guest profile for bookings and inquiries.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('customers'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php echo form_open('customers/add', array('id' => 'customer-add-form', 'class' => 'customer-add-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-person"></i> Personal Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="e.g., +63 912 345 6789">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo set_value('date_of_birth'); ?>">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="male" <?php echo set_select('gender', 'male'); ?>>Male</option>
                            <option value="female" <?php echo set_select('gender', 'female'); ?>>Female</option>
                            <option value="other" <?php echo set_select('gender', 'other'); ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo set_value('nationality'); ?>" placeholder="e.g., Filipino">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-geo-alt"></i> Address Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="address" class="form-label">Street Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2"><?php echo set_value('address'); ?></textarea>
                    </div>
                    <div class="col-6 col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city'); ?>">
                    </div>
                    <div class="col-6 col-md-4">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" name="province" value="<?php echo set_value('province'); ?>">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo set_value('postal_code'); ?>">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo set_value('country', 'Philippines'); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-card-text"></i> Identification
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="id_type" class="form-label">ID Type</label>
                        <select class="form-select" id="id_type" name="id_type">
                            <option value="">Select ID Type</option>
                            <option value="passport" <?php echo set_select('id_type', 'passport'); ?>>Passport</option>
                            <option value="driver_license" <?php echo set_select('id_type', 'driver_license'); ?>>Driver's License</option>
                            <option value="national_id" <?php echo set_select('id_type', 'national_id'); ?>>National ID</option>
                            <option value="philhealth" <?php echo set_select('id_type', 'philhealth'); ?>>PhilHealth ID</option>
                            <option value="sss" <?php echo set_select('id_type', 'sss'); ?>>SSS ID</option>
                            <option value="tin" <?php echo set_select('id_type', 'tin'); ?>>TIN ID</option>
                            <option value="other" <?php echo set_select('id_type', 'other'); ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="id_number" class="form-label">ID Number</label>
                        <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo set_value('id_number'); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-sticky"></i> Additional Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any additional notes about this customer/guest..."><?php echo set_value('notes'); ?></textarea>
                    </div>
                    <div class="col-12">
                        <div class="switch-box">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" <?php echo set_checkbox('status', '1', TRUE); ?>>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('customers'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Register Customer
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
