<?php
$current_type = set_value('room_type', $room->room_type);
$type_options = array('Day Tour', 'Multi-Day Package', 'Add-on Activity', 'Transfer');
if ($current_type && !in_array($current_type, $type_options, true)) {
    array_unshift($type_options, $current_type);
}
?>

<style>
    .package-edit-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .package-edit-page .page-actions .btn {
        width: 100%;
    }

    .package-edit-page .form-section-card {
        margin-bottom: 1rem;
    }

    .package-edit-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .package-edit-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    .package-edit-page .gallery-upload-card .upload-actions {
        display: grid;
        gap: 0.65rem;
    }

    .package-edit-page .gallery-card {
        height: 100%;
        overflow: hidden;
    }

    .package-edit-page .gallery-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
        background: var(--surface-2, #f3f7fa);
    }

    .package-edit-page .gallery-card .card-body {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    .package-edit-page .gallery-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        align-items: center;
        min-height: 1.5rem;
    }

    .package-edit-page .gallery-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.45rem;
    }

    .package-edit-page .gallery-actions .btn {
        width: 100%;
    }

    .package-edit-page .empty-gallery {
        border: 1px dashed var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1.5rem 1rem;
        text-align: center;
        color: var(--muted, #64748b);
        background: var(--surface-2, #f3f7fa);
    }

    @media (min-width: 576px) {
        .package-edit-page .gallery-card img {
            height: 160px;
        }

        .package-edit-page .gallery-actions {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .package-edit-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .package-edit-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .package-edit-page .page-actions .btn {
            width: auto;
        }

        .package-edit-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .package-edit-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .package-edit-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }

        .package-edit-page .gallery-upload-card .upload-actions {
            display: flex;
            align-items: flex-end;
        }

        .package-edit-page .gallery-upload-card .upload-actions .btn {
            width: auto;
            white-space: nowrap;
        }
    }

    @media (min-width: 992px) {
        .package-edit-page .gallery-card img {
            height: 170px;
        }
    }
</style>

<div class="nk-block package-edit-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-pencil-square"></i> Edit Tour Package</h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Update package details offered on the main website.</p>
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

    <?php echo form_open('rooms/edit/' . $room->id, array('id' => 'room-form', 'class' => 'package-edit-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Basic Info
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="room_name" class="form-label">Package Name *</label>
                        <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo set_value('room_name', $room->room_name); ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="room_type" class="form-label">Category *</label>
                        <select class="form-select" id="room_type" name="room_type" required>
                            <?php foreach ($type_options as $opt): ?>
                                <option value="<?php echo html_escape($opt); ?>" <?php echo ($current_type === $opt) ? 'selected' : ''; ?>><?php echo html_escape($opt); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="room_code" class="form-label">Package Code *</label>
                        <input type="text" class="form-control" id="room_code" name="room_code" value="<?php echo set_value('room_code', isset($room->room_code) ? $room->room_code : ''); ?>" placeholder="e.g., chocolate-hills-adventure" required>
                        <small class="form-text text-muted">Unique slug used by the booking API and public pages.</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" <?php echo set_select('status', 'active', $room->status == 'active'); ?>>Active</option>
                            <option value="inactive" <?php echo set_select('status', 'inactive', $room->status == 'inactive'); ?>>Inactive</option>
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
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo set_value('price', $room->price); ?>" step="0.01" min="0" required>
                        <small class="form-text text-muted">“From” price on website cards.</small>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <label for="capacity" class="form-label">Max Guests *</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo set_value('capacity', $room->capacity); ?>" min="1" required>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="available_rooms" class="form-label">Daily Slots Available *</label>
                        <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="<?php echo set_value('available_rooms', isset($room->available_rooms) ? $room->available_rooms : 1); ?>" min="1" required>
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
                        <textarea class="form-control" id="description" name="description" rows="4"><?php echo set_value('description', $room->description); ?></textarea>
                    </div>
                    <div class="col-12">
                        <label for="amenities" class="form-label">Inclusions</label>
                        <textarea class="form-control" id="amenities" name="amenities" rows="3" placeholder="e.g., Transport; Guide; Entrance fees; Lunch"><?php echo set_value('amenities', $room->amenities); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('rooms'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Package
                </button>
            </div>
        </div>
    <?php echo form_close(); ?>

    <div class="card card-bordered form-section-card gallery-upload-card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span><i class="bi bi-images"></i> Package Image Gallery</span>
            <span class="badge bg-secondary"><?php echo !empty($room_images) ? count($room_images) : 0; ?> image(s)</span>
        </div>
        <div class="card-body">
            <form id="image-upload-form" enctype="multipart/form-data" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-6">
                        <label for="image_file" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image_file" name="image" accept="image/*" required>
                        <small class="form-text text-muted">JPG, PNG, GIF, WEBP · Max 5MB</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="alt_text" class="form-label">Alt Text (Optional)</label>
                        <input type="text" class="form-control" id="alt_text" name="alt_text" placeholder="Image description">
                    </div>
                    <div class="col-12 col-md-2 upload-actions">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                    </div>
                </div>
            </form>

            <div id="image-gallery" class="row g-3">
                <?php if (!empty($room_images)): ?>
                    <?php foreach ($room_images as $image): ?>
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 image-item" data-image-id="<?php echo $image->id; ?>">
                            <div class="card gallery-card card-bordered">
                                <a href="<?php echo base_url($image->image_path); ?>" data-lightbox="room-gallery" data-title="<?php echo htmlspecialchars($image->alt_text ? $image->alt_text : $room->room_name); ?>">
                                    <img src="<?php echo base_url($image->image_path); ?>" alt="<?php echo htmlspecialchars($image->alt_text); ?>">
                                </a>
                                <div class="card-body">
                                    <div class="gallery-meta">
                                        <?php if ($image->is_primary): ?>
                                            <span class="badge bg-success">Primary</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-dark border">Gallery</span>
                                        <?php endif; ?>
                                        <?php if (!empty($image->alt_text)): ?>
                                            <small class="text-muted text-truncate"><?php echo htmlspecialchars($image->alt_text); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="gallery-actions">
                                        <?php if (!$image->is_primary): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary set-primary-btn" data-image-id="<?php echo $image->id; ?>">
                                                <i class="bi bi-star"></i> Set Primary
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-image-btn" data-image-id="<?php echo $image->id; ?>">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12" id="empty-gallery-wrap">
                        <div class="empty-gallery">
                            <i class="bi bi-image fs-3 d-block mb-2"></i>
                            No images uploaded yet. Add photos to showcase this package.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script>
(function() {
    function initLightbox() {
        if (typeof lightbox !== 'undefined' && typeof lightbox.option === 'function') {
            lightbox.option({
                resizeDuration: 200,
                wrapAround: true,
                fadeDuration: 300,
                imageFadeDuration: 300
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLightbox);
    } else {
        initLightbox();
    }

    var uploadForm = document.getElementById('image-upload-form');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var fileInput = document.getElementById('image_file');
            if (!fileInput.files.length) {
                alert('Please choose an image to upload.');
                return;
            }

            var formData = new FormData();
            formData.append('image', fileInput.files[0]);
            formData.append('alt_text', document.getElementById('alt_text').value);

            var uploadBtn = this.querySelector('button[type="submit"]');
            var originalText = uploadBtn.innerHTML;
            uploadBtn.disabled = true;
            uploadBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Uploading...';

            fetch('<?php echo base_url("rooms/upload_image/" . $room->id); ?>', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                    uploadBtn.disabled = false;
                    uploadBtn.innerHTML = originalText;
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('An error occurred while uploading the image.');
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = originalText;
            });
        });
    }

    document.querySelectorAll('.delete-image-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm('Are you sure you want to delete this image?')) {
                return;
            }

            var imageId = this.getAttribute('data-image-id');
            var imageItem = this.closest('.image-item');

            fetch('<?php echo base_url("rooms/delete_image/"); ?>' + imageId, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    imageItem.remove();
                    if (document.querySelectorAll('.image-item').length === 0) {
                        document.getElementById('image-gallery').innerHTML =
                            '<div class="col-12"><div class="empty-gallery"><i class="bi bi-image fs-3 d-block mb-2"></i>No images uploaded yet. Add photos to showcase this package.</div></div>';
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('An error occurred while deleting the image.');
            });
        });
    });

    document.querySelectorAll('.set-primary-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var imageId = this.getAttribute('data-image-id');

            fetch('<?php echo base_url("rooms/set_primary_image/" . $room->id . "/"); ?>' + imageId, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('An error occurred while setting the primary image.');
            });
        });
    });
})();
</script>
