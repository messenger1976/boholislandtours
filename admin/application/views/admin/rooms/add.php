<?php
$selected_type = set_value('room_type', 'Day Tour');
$type_options = array('Day Tour', 'Multi-Day Package', 'Add-on Activity', 'Transfer');
if ($selected_type && !in_array($selected_type, $type_options, true)) {
    array_unshift($type_options, $selected_type);
}
?>

<style>
    .package-add-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .package-add-page .page-actions .btn {
        width: 100%;
    }

    .package-add-page .form-section-card {
        margin-bottom: 1rem;
    }

    .package-add-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .package-add-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    @media (min-width: 768px) {
        .package-add-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .package-add-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .package-add-page .page-actions .btn {
            width: auto;
        }

        .package-add-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .package-add-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .package-add-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block package-add-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-plus-circle"></i> Add Tour Package</h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Create a day tour or multi-day package matching website offers.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="<?php echo base_url('rooms/calendar'); ?>" class="btn btn-outline-light">
                    <i class="bi bi-calendar-check"></i> Calendar
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

    <?php echo form_open('rooms/add', array('id' => 'room-form', 'class' => 'package-add-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Basic Info
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="room_name" class="form-label">Package Name *</label>
                        <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo set_value('room_name'); ?>" placeholder="e.g., Chocolate Hills Adventure" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="room_type" class="form-label">Category *</label>
                        <select class="form-select" id="room_type" name="room_type" required>
                            <?php foreach ($type_options as $opt): ?>
                                <option value="<?php echo html_escape($opt); ?>" <?php echo ($selected_type === $opt) ? 'selected' : ''; ?>><?php echo html_escape($opt); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="room_code" class="form-label">Package Code *</label>
                        <input type="text" class="form-control" id="room_code" name="room_code" value="<?php echo set_value('room_code'); ?>" placeholder="e.g., chocolate-hills-adventure" required>
                        <small class="form-text text-muted">Unique slug used by the booking API and public pages.</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" <?php echo set_select('status', 'active', TRUE); ?>>Active</option>
                            <option value="inactive" <?php echo set_select('status', 'inactive'); ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Pricing &amp; Capacity
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <label for="price" class="form-label">Starting Price (₱) *</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>" step="0.01" min="0" required>
                        <small class="form-text text-muted">“From” price on website cards.</small>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <label for="capacity" class="form-label">Max Guests *</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo set_value('capacity', 10); ?>" min="1" required>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="available_rooms" class="form-label">Daily Slots Available *</label>
                        <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="<?php echo set_value('available_rooms', 5); ?>" min="1" required>
                        <small class="form-text text-muted">Bookings allowed per day for conflict checking.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-card-text"></i> Description &amp; Inclusions
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Short offer summary shown to guests"><?php echo set_value('description'); ?></textarea>
                    </div>
                    <div class="col-12">
                        <label for="amenities" class="form-label">Inclusions</label>
                        <textarea class="form-control" id="amenities" name="amenities" rows="3" placeholder="e.g., Transport; Guide; Entrance fees; Lunch"><?php echo set_value('amenities'); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Add Package
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
