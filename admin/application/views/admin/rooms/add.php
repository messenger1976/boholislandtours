<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="mb-1"><i class="bi bi-plus-circle"></i> Add Tour Package</h5>
            <p class="text-muted small mb-0">Create a day tour or multi-day package matching website offers.</p>
        </div>
        <a href="<?php echo base_url('rooms'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Packages
        </a>
    </div>
    
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php echo form_open('rooms/add', array('id' => 'room-form')); ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="room_name" class="form-label">Package Name *</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo set_value('room_name'); ?>" placeholder="e.g., Chocolate Hills Adventure" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="room_type" class="form-label">Category *</label>
                <select class="form-select" id="room_type" name="room_type" required>
                    <?php
                    $selected_type = set_value('room_type', 'Day Tour');
                    $type_options = array('Day Tour', 'Multi-Day Package', 'Add-on Activity', 'Transfer');
                    foreach ($type_options as $opt):
                    ?>
                    <option value="<?php echo html_escape($opt); ?>" <?php echo ($selected_type === $opt) ? 'selected' : ''; ?>><?php echo html_escape($opt); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="room_code" class="form-label">Package Code *</label>
                <input type="text" class="form-control" id="room_code" name="room_code" value="<?php echo set_value('room_code'); ?>" placeholder="e.g., chocolate-hills-adventure" required>
                <small class="form-text text-muted">Unique slug used by the booking API and public pages.</small>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Starting Price (₱) *</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>" step="0.01" min="0" required>
                <small class="form-text text-muted">“From” price shown on website cards / quotations.</small>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="capacity" class="form-label">Max Guests *</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo set_value('capacity', 10); ?>" min="1" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="available_rooms" class="form-label">Daily Slots Available *</label>
                <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="<?php echo set_value('available_rooms', 5); ?>" min="1" required>
                <small class="form-text text-muted">How many bookings of this package can run per day (conflict checking).</small>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Short offer summary shown to guests"><?php echo set_value('description'); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="amenities" class="form-label">Inclusions</label>
            <textarea class="form-control" id="amenities" name="amenities" rows="3" placeholder="e.g., Transport; Guide; Entrance fees; Lunch"><?php echo set_value('amenities'); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" <?php echo set_select('status', 'active', TRUE); ?>>Active</option>
                <option value="inactive" <?php echo set_select('status', 'inactive'); ?>>Inactive</option>
            </select>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?php echo base_url('rooms'); ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Package</button>
        </div>
    <?php echo form_close(); ?>
</div>
