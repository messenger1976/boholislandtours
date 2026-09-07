<?php
$s = function ($key, $default = '') use ($settings) {
    return isset($settings[$key]) ? $settings[$key] : $default;
};
?>

<style>
    .package-settings-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .package-settings-page .page-actions .btn {
        width: 100%;
    }

    .package-settings-page .form-section-card {
        margin-bottom: 1rem;
    }

    .package-settings-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .package-settings-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    .package-settings-page .form-check {
        padding: 0.85rem 1rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.75rem;
    }

    .package-settings-page .form-check:last-child {
        margin-bottom: 0;
    }

    html.dark-mode .package-settings-page .form-check,
    body.dark-mode .package-settings-page .form-check {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .package-settings-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .package-settings-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .package-settings-page .page-actions .btn {
            width: auto;
        }

        .package-settings-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .package-settings-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .package-settings-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block package-settings-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-gear"></i> Package Settings</h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Defaults and display options for tour packages.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Packages
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

    <?php echo form_open('room_settings', array('id' => 'package-settings-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-sliders"></i> General Settings
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="default_status" class="form-label">Default Package Status *</label>
                        <select class="form-select" id="default_status" name="default_status" required>
                            <option value="active" <?php echo ($s('default_status') === 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo ($s('default_status') === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            <option value="maintenance" <?php echo ($s('default_status') === 'maintenance') ? 'selected' : ''; ?>>Maintenance</option>
                        </select>
                        <small class="form-text text-muted">Status assigned to newly created packages.</small>
                    </div>
                    <div class="col-6 col-md-4">
                        <label for="default_capacity" class="form-label">Default Capacity</label>
                        <input type="number" class="form-control" id="default_capacity" name="default_capacity"
                               value="<?php echo htmlspecialchars($s('default_capacity', '2')); ?>" min="1">
                        <small class="form-text text-muted">Default max guests.</small>
                    </div>
                    <div class="col-6 col-md-4">
                        <label for="max_capacity" class="form-label">Maximum Capacity</label>
                        <input type="number" class="form-control" id="max_capacity" name="max_capacity"
                               value="<?php echo htmlspecialchars($s('max_capacity', '10')); ?>" min="1">
                        <small class="form-text text-muted">Upper limit for guests.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Pricing Settings
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="price_currency" class="form-label">Currency Symbol</label>
                        <input type="text" class="form-control" id="price_currency" name="price_currency"
                               value="<?php echo htmlspecialchars($s('price_currency', '₱')); ?>" maxlength="5">
                        <small class="form-text text-muted">e.g., ₱, $, €</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="price_display_format" class="form-label">Price Display Format</label>
                        <select class="form-select" id="price_display_format" name="price_display_format">
                            <option value="per_night" <?php echo ($s('price_display_format') === 'per_night') ? 'selected' : ''; ?>>Per Night / Day</option>
                            <option value="per_person" <?php echo ($s('price_display_format') === 'per_person') ? 'selected' : ''; ?>>Per Person</option>
                            <option value="per_room" <?php echo ($s('price_display_format') === 'per_room') ? 'selected' : ''; ?>>Per Package</option>
                        </select>
                        <small class="form-text text-muted">How package prices are labeled.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-tags"></i> Categories &amp; Inclusions
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="room_types" class="form-label">Package Categories</label>
                        <textarea class="form-control" id="room_types" name="room_types" rows="6"
                                  placeholder="Day Tour&#10;Multi-Day Package&#10;Add-on Activity&#10;Transfer"><?php
                            echo htmlspecialchars($s(
                                'room_types',
                                "Day Tour\nMulti-Day Package\nAdd-on Activity\nTransfer"
                            ));
                        ?></textarea>
                        <small class="form-text text-muted">One category per line (suggestions when creating packages).</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="amenities_list" class="form-label">Common Inclusions</label>
                        <textarea class="form-control" id="amenities_list" name="amenities_list" rows="6"
                                  placeholder="Transport&#10;Guide&#10;Entrance fees&#10;Lunch"><?php
                            echo htmlspecialchars($s(
                                'amenities_list',
                                "Transport\nGuide\nEntrance fees\nLunch\nHotel accommodation"
                            ));
                        ?></textarea>
                        <small class="form-text text-muted">One inclusion per line (suggestions when creating packages).</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-images"></i> Image Settings
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label for="image_upload_path" class="form-label">Image Upload Path</label>
                        <input type="text" class="form-control" id="image_upload_path" name="image_upload_path"
                               value="<?php echo htmlspecialchars($s('image_upload_path', 'img/rooms/')); ?>">
                        <small class="form-text text-muted">Directory for package images (relative to site root).</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="max_images_per_room" class="form-label">Max Images Per Package</label>
                        <input type="number" class="form-control" id="max_images_per_room" name="max_images_per_room"
                               value="<?php echo htmlspecialchars($s('max_images_per_room', '5')); ?>" min="1" max="20">
                        <small class="form-text text-muted">Gallery limit per package.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-display"></i> Display Settings
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="allow_online_booking" name="allow_online_booking" value="1"
                        <?php echo ($s('allow_online_booking') === '1') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="allow_online_booking">
                        Allow Online Booking
                    </label>
                    <small class="form-text text-muted d-block">Allow guests to book packages online.</small>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="show_availability_calendar" name="show_availability_calendar" value="1"
                        <?php echo ($s('show_availability_calendar') === '1') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="show_availability_calendar">
                        Show Availability Calendar
                    </label>
                    <small class="form-text text-muted d-block">Display package availability on the public site.</small>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-file-text"></i> Additional Information
            </div>
            <div class="card-body">
                <label for="room_notes" class="form-label">Package Notes / Policy</label>
                <textarea class="form-control" id="room_notes" name="room_notes" rows="5"
                          placeholder="Enter package policy, terms, or additional notes..."><?php echo htmlspecialchars($s('room_notes')); ?></textarea>
                <small class="form-text text-muted">Optional text that can be shown to guests.</small>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Settings
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
