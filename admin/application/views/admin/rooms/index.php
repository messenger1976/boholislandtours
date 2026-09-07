<div class="nk-block">
    <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><i class="bi bi-map"></i> Tour Packages Offer</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage day tours and multi-day packages offered on the main website (Bohol Island Tours).</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="<?php echo base_url('rooms/calendar'); ?>" class="btn btn-outline-light">
                                    <i class="bi bi-calendar-check"></i> <span>Availability Calendar</span>
                                </a>
                            </li>
                            <?php if (isset($can_add) && $can_add): ?>
                            <li>
                                <a href="<?php echo base_url('room_settings'); ?>" class="btn btn-outline-light">
                                    <i class="bi bi-gear"></i> <span>Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('rooms/add'); ?>" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> <span>Add Package</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
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

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card tour">
                <div class="stat-card-icon"><i class="bi bi-sun"></i></div>
                <div class="stat-card-value">
                    <?php
                    $day_tours = 0;
                    if (!empty($rooms)) {
                        foreach ($rooms as $r) {
                            if (stripos($r->room_type, 'day') !== false) $day_tours++;
                        }
                    }
                    echo $day_tours;
                    ?>
                </div>
                <div class="stat-card-label">Day Tours</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card secondary">
                <div class="stat-card-icon"><i class="bi bi-moon-stars"></i></div>
                <div class="stat-card-value">
                    <?php
                    $multi = 0;
                    if (!empty($rooms)) {
                        foreach ($rooms as $r) {
                            if (stripos($r->room_type, 'multi') !== false || stripos($r->room_type, 'package') !== false) $multi++;
                        }
                    }
                    echo $multi;
                    ?>
                </div>
                <div class="stat-card-label">Multi-Day Packages</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card info">
                <div class="stat-card-icon"><i class="bi bi-check-circle"></i></div>
                <div class="stat-card-value">
                    <?php
                    $active = 0;
                    if (!empty($rooms)) {
                        foreach ($rooms as $r) {
                            if ($r->status === 'active') $active++;
                        }
                    }
                    echo $active;
                    ?>
                </div>
                <div class="stat-card-label">Active Offers</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-card-icon"><i class="bi bi-collection"></i></div>
                <div class="stat-card-value"><?php echo !empty($rooms) ? count($rooms) : 0; ?></div>
                <div class="stat-card-label">Total Packages</div>
            </div>
        </div>
    </div>
    
    <style>
        .packages-mobile-list .package-card {
            margin-bottom: 0.85rem;
        }
        .packages-mobile-list .package-card .card-body {
            padding: 1rem;
        }
        .packages-mobile-list .package-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.55rem 0.75rem;
            margin: 0.75rem 0;
            font-size: 0.85rem;
        }
        .packages-mobile-list .package-meta span {
            color: var(--muted, #64748b);
            display: block;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .packages-mobile-list .package-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }
        .packages-mobile-list .package-actions .btn {
            width: 100%;
        }
        @media (min-width: 768px) {
            .packages-mobile-list { display: none !important; }
        }
        @media (max-width: 767.98px) {
            .packages-desktop-table { display: none !important; }
        }
    </style>

    <!-- Mobile card list -->
    <div class="packages-mobile-list d-md-none">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                $type_badge = 'secondary';
                if (stripos($room->room_type, 'day') !== false) $type_badge = 'info';
                if (stripos($room->room_type, 'multi') !== false) $type_badge = 'success';
                ?>
                <div class="card card-bordered package-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                            <div>
                                <div class="small text-muted">#<?php echo $room->id; ?></div>
                                <h6 class="mb-1"><?php echo htmlspecialchars($room->room_name); ?></h6>
                            </div>
                            <span class="badge bg-<?php echo $room->status == 'active' ? 'success' : 'secondary'; ?>">
                                <?php echo ucfirst($room->status); ?>
                            </span>
                        </div>
                        <span class="badge bg-<?php echo $type_badge; ?>"><?php echo htmlspecialchars($room->room_type); ?></span>
                        <?php if (!empty($room->description)): ?>
                            <p class="small text-muted mt-2 mb-0"><?php echo htmlspecialchars($room->description); ?></p>
                        <?php endif; ?>
                        <div class="package-meta">
                            <div><span>From Price</span><strong>₱<?php echo number_format($room->price, 2); ?></strong></div>
                            <div><span>Code</span><code><?php echo htmlspecialchars(isset($room->room_code) ? $room->room_code : '-'); ?></code></div>
                            <div><span>Max Guests</span><strong><?php echo $room->capacity; ?></strong></div>
                            <div><span>Daily Slots</span><strong><?php echo isset($room->available_rooms) ? (int)$room->available_rooms : 1; ?></strong></div>
                        </div>
                        <div class="package-actions">
                            <?php if (isset($can_edit) && $can_edit): ?>
                            <a href="<?php echo base_url('rooms/edit/' . $room->id); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <?php endif; ?>
                            <?php if (isset($can_delete) && $can_delete): ?>
                            <a href="<?php echo base_url('rooms/delete/' . $room->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tour package?');">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card card-bordered">
                <div class="card-body text-center text-muted">No tour packages found. Add packages that match your website offers.</div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Desktop table -->
    <div class="card card-bordered packages-desktop-table d-none d-md-block">
        <div class="card-inner">
            <div class="table-responsive">
        <table class="table table-hover no-datatables">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Category</th>
                    <th>Code</th>
                    <th>From Price</th>
                    <th>Max Guests</th>
                    <th>Daily Slots</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?php echo $room->id; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($room->room_name); ?></strong>
                                <?php if (!empty($room->description)): ?>
                                    <div class="small text-muted text-truncate" style="max-width: 280px;"><?php echo htmlspecialchars($room->description); ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $type_badge = 'secondary';
                                if (stripos($room->room_type, 'day') !== false) $type_badge = 'info';
                                if (stripos($room->room_type, 'multi') !== false) $type_badge = 'success';
                                ?>
                                <span class="badge bg-<?php echo $type_badge; ?>"><?php echo htmlspecialchars($room->room_type); ?></span>
                            </td>
                            <td><code><?php echo htmlspecialchars(isset($room->room_code) ? $room->room_code : '-'); ?></code></td>
                            <td>₱<?php echo number_format($room->price, 2); ?></td>
                            <td><?php echo $room->capacity; ?> guest(s)</td>
                            <td><?php echo isset($room->available_rooms) ? (int)$room->available_rooms : 1; ?></td>
                            <td>
                                <span class="badge bg-<?php echo $room->status == 'active' ? 'success' : 'secondary'; ?>">
                                    <?php echo ucfirst($room->status); ?>
                                </span>
                            </td>
                            <td>
                                <?php if (isset($can_edit) && $can_edit): ?>
                                <a href="<?php echo base_url('rooms/edit/' . $room->id); ?>" class="btn btn-sm btn-warning" title="Edit package">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (isset($can_delete) && $can_delete): ?>
                                <a href="<?php echo base_url('rooms/delete/' . $room->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tour package?');" title="Delete package">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">No tour packages found. Add packages that match your website offers.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
