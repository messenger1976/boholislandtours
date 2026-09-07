<?php
$booking_number = isset($booking->booking_number) && $booking->booking_number !== ''
    ? $booking->booking_number
    : str_pad($booking->id, 6, '0', STR_PAD_LEFT);

$existing_items = isset($booking_items) && !empty($booking_items) ? $booking_items : array();
$grouped_items = array();
$room_index = 0;

if (!empty($existing_items)) {
    foreach ($existing_items as $item) {
        $key = $item->room_id . '_' . $item->check_in . '_' . $item->check_out . '_' . $item->price_per_night;
        if (!isset($grouped_items[$key])) {
            $grouped_items[$key] = array(
                'room_id' => $item->room_id,
                'room_name' => $item->room_name,
                'price_per_night' => $item->price_per_night,
                'check_in' => $item->check_in,
                'check_out' => $item->check_out,
                'guests' => $booking->guests,
                'quantity' => 0,
            );
        }
        $grouped_items[$key]['quantity']++;
    }
}

$package_options_html = '<option value="">-- Choose a package --</option>';
foreach ($rooms as $room) {
    $package_options_html .= '<option value="' . (int) $room->id . '" data-price="' . htmlspecialchars((string) $room->price, ENT_QUOTES, 'UTF-8') . '" data-name="' . htmlspecialchars($room->room_name, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($room->room_name . ' (' . $room->room_type . ') - ₱' . number_format($room->price, 2), ENT_QUOTES, 'UTF-8')
        . '</option>';
}

$selected_customer_id = '';
if (!empty($customers)) {
    foreach ($customers as $customer) {
        if (!empty($customer->email) && strtolower(trim($customer->email)) === strtolower(trim($booking->guest_email))) {
            $selected_customer_id = $customer->id;
            break;
        }
    }
}
?>

<style>
    .booking-edit-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .booking-edit-page .page-actions .btn {
        width: 100%;
    }

    .booking-edit-page .form-section-card {
        margin-bottom: 1rem;
    }

    .booking-edit-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .booking-edit-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .booking-edit-page .package-row {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        background: var(--surface-2, #f3f7fa);
        margin-bottom: 0.85rem;
    }

    .booking-edit-page .package-row:last-child {
        margin-bottom: 0;
    }

    .booking-edit-page .package-row-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        margin-bottom: 0.85rem;
    }

    .booking-edit-page .package-row-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--heading, #1e293b);
        margin: 0;
    }

    .booking-edit-page .summary-value {
        min-height: 2.5rem;
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.5rem;
        background: var(--card-bg, #fff);
        font-weight: 500;
    }

    .booking-edit-page .summary-value.total-amount {
        color: var(--success, #198754);
        font-size: 1.15rem;
        font-weight: 700;
    }

    .booking-edit-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .booking-edit-page .package-row,
    body.dark-mode .booking-edit-page .package-row {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .booking-edit-page .package-row-title,
    body.dark-mode .booking-edit-page .package-row-title {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 768px) {
        .booking-edit-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .booking-edit-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .booking-edit-page .page-actions .btn {
            width: auto;
        }

        .booking-edit-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .booking-edit-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .booking-edit-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block booking-edit-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title"><i class="bi bi-pencil-square"></i> Edit Booking #<?php echo htmlspecialchars($booking_number); ?></h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Update guest details, packages, and booking status.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-eye"></i> View
                </a>
                <a href="<?php echo base_url('bookings'); ?>" class="btn btn-outline-secondary">
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

    <?php echo form_open('bookings/edit/' . $booking->id, array('id' => 'booking-form', 'class' => 'booking-edit-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-person"></i> Guest Information</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="customer_id" class="form-label">Select Existing Customer (Optional)</label>
                        <select class="form-select" id="customer_id" name="customer_id">
                            <option value="">-- Select a customer or enter manually --</option>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $customer): ?>
                                    <?php
                                    $customer_name = trim($customer->first_name . ' ' . $customer->last_name);
                                    $customer_email = !empty($customer->email) ? $customer->email : '';
                                    $customer_phone = !empty($customer->phone) ? $customer->phone : '';
                                    $display_text = $customer_name;
                                    if ($customer_email) {
                                        $display_text .= ' (' . $customer_email . ')';
                                    }
                                    ?>
                                    <option value="<?php echo $customer->id; ?>"
                                            data-name="<?php echo htmlspecialchars($customer_name); ?>"
                                            data-email="<?php echo htmlspecialchars($customer_email); ?>"
                                            data-phone="<?php echo htmlspecialchars($customer_phone); ?>"
                                            data-address="<?php echo htmlspecialchars(isset($customer->address) ? $customer->address : ''); ?>"
                                            data-city="<?php echo htmlspecialchars(isset($customer->city) ? $customer->city : ''); ?>"
                                            data-province="<?php echo htmlspecialchars(isset($customer->province) ? $customer->province : ''); ?>"
                                            data-country="<?php echo htmlspecialchars(isset($customer->country) ? $customer->country : ''); ?>"
                                            data-zipcode="<?php echo htmlspecialchars(isset($customer->postal_code) ? $customer->postal_code : ''); ?>"
                                            <?php echo ($selected_customer_id == $customer->id) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($display_text); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <small class="form-text text-muted">Selecting a customer auto-fills the guest fields below.</small>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="guest_name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" value="<?php echo set_value('guest_name', $booking->guest_name); ?>" required placeholder="Enter guest name">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="guest_email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="guest_email" name="guest_email" value="<?php echo set_value('guest_email', $booking->guest_email); ?>" required placeholder="guest@example.com">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="guest_phone" class="form-label">Phone Number *</label>
                        <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="<?php echo set_value('guest_phone', $booking->guest_phone); ?>" required placeholder="+63 XXX XXX XXXX">
                    </div>
                    <div class="col-12">
                        <label for="guest_address" class="form-label">Address</label>
                        <textarea class="form-control" id="guest_address" name="guest_address" rows="2" placeholder="Enter street address"><?php echo set_value('guest_address', isset($booking->guest_address) ? $booking->guest_address : ''); ?></textarea>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="guest_city" class="form-label">City</label>
                        <input type="text" class="form-control" id="guest_city" name="guest_city" value="<?php echo set_value('guest_city', isset($booking->guest_city) ? $booking->guest_city : ''); ?>" placeholder="City">
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="guest_province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="guest_province" name="guest_province" value="<?php echo set_value('guest_province', isset($booking->guest_province) ? $booking->guest_province : ''); ?>" placeholder="Province">
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="guest_country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="guest_country" name="guest_country" value="<?php echo set_value('guest_country', isset($booking->guest_country) ? $booking->guest_country : 'Philippines'); ?>" placeholder="Country">
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="guest_zipcode" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="guest_zipcode" name="guest_zipcode" value="<?php echo set_value('guest_zipcode', isset($booking->guest_zipcode) ? $booking->guest_zipcode : ''); ?>" placeholder="Zip">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-map"></i> Package Selection</span>
                <button type="button" class="btn btn-sm btn-outline-primary" id="add-room-btn">
                    <i class="bi bi-plus-circle"></i> Add Package
                </button>
            </div>
            <div class="card-body">
                <div id="rooms-container">
                    <?php if (!empty($grouped_items)): ?>
                        <?php foreach ($grouped_items as $grouped_item): ?>
                            <?php
                            $item_check_in = new DateTime($grouped_item['check_in']);
                            $item_check_out = new DateTime($grouped_item['check_out']);
                            $item_nights = max($item_check_in->diff($item_check_out)->days, 1);
                            $item_subtotal = $grouped_item['price_per_night'] * $item_nights * $grouped_item['quantity'];
                            ?>
                            <div class="package-row room-row" data-room-index="<?php echo $room_index; ?>">
                                <div class="package-row-head">
                                    <p class="package-row-title">Package #<?php echo $room_index + 1; ?></p>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-room-btn">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-lg-4">
                                        <label class="form-label">Select Package *</label>
                                        <select class="form-select room-select" name="room_selections[<?php echo $room_index; ?>][room_id]" data-index="<?php echo $room_index; ?>" required>
                                            <option value="">-- Choose a package --</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?php echo $room->id; ?>"
                                                        data-price="<?php echo $room->price; ?>"
                                                        data-name="<?php echo htmlspecialchars($room->room_name); ?>"
                                                        <?php echo ($grouped_item['room_id'] == $room->id) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($room->room_name . ' (' . $room->room_type . ') - ₱' . number_format($room->price, 2)); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label class="form-label">Check-In *</label>
                                        <input type="date" class="form-control room-checkin" name="room_selections[<?php echo $room_index; ?>][check_in]" value="<?php echo htmlspecialchars($grouped_item['check_in']); ?>" data-index="<?php echo $room_index; ?>" required>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label class="form-label">Check-Out *</label>
                                        <input type="date" class="form-control room-checkout" name="room_selections[<?php echo $room_index; ?>][check_out]" value="<?php echo htmlspecialchars($grouped_item['check_out']); ?>" data-index="<?php echo $room_index; ?>" required>
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label class="form-label">Guests</label>
                                        <input type="number" class="form-control room-guests" name="room_selections[<?php echo $room_index; ?>][guests]" value="<?php echo (int) $grouped_item['guests']; ?>" min="1" data-index="<?php echo $room_index; ?>" required>
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label class="form-label">Qty</label>
                                        <input type="number" class="form-control room-quantity" name="room_selections[<?php echo $room_index; ?>][quantity]" value="<?php echo (int) $grouped_item['quantity']; ?>" min="1" data-index="<?php echo $room_index; ?>" required>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-1">
                                        <label class="form-label">Unit Price</label>
                                        <input type="text" class="form-control room-price-display" readonly value="₱<?php echo number_format($grouped_item['price_per_night'], 2); ?>">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-1">
                                        <label class="form-label">Subtotal</label>
                                        <input type="text" class="form-control room-subtotal fw-bold" readonly value="₱<?php echo number_format($item_subtotal, 2); ?>">
                                    </div>
                                </div>
                            </div>
                            <?php $room_index++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="package-row room-row" data-room-index="0">
                            <div class="package-row-head">
                                <p class="package-row-title">Package #1</p>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-room-btn" style="display: none;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-lg-4">
                                    <label class="form-label">Select Package *</label>
                                    <select class="form-select room-select" name="room_selections[0][room_id]" data-index="0" required>
                                        <option value="">-- Choose a package --</option>
                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?php echo $room->id; ?>"
                                                    data-price="<?php echo $room->price; ?>"
                                                    data-name="<?php echo htmlspecialchars($room->room_name); ?>"
                                                    <?php echo ($booking->room_id == $room->id) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($room->room_name . ' (' . $room->room_type . ') - ₱' . number_format($room->price, 2)); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label class="form-label">Check-In *</label>
                                    <input type="date" class="form-control room-checkin" name="room_selections[0][check_in]" value="<?php echo htmlspecialchars($booking->check_in); ?>" data-index="0" required>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label class="form-label">Check-Out *</label>
                                    <input type="date" class="form-control room-checkout" name="room_selections[0][check_out]" value="<?php echo htmlspecialchars($booking->check_out); ?>" data-index="0" required>
                                </div>
                                <div class="col-6 col-md-2 col-lg-1">
                                    <label class="form-label">Guests</label>
                                    <input type="number" class="form-control room-guests" name="room_selections[0][guests]" value="<?php echo (int) $booking->guests; ?>" min="1" data-index="0" required>
                                </div>
                                <div class="col-6 col-md-2 col-lg-1">
                                    <label class="form-label">Qty</label>
                                    <input type="number" class="form-control room-quantity" name="room_selections[0][quantity]" value="<?php echo isset($booking->rooms) ? (int) $booking->rooms : 1; ?>" min="1" data-index="0" required>
                                </div>
                                <div class="col-6 col-md-4 col-lg-1">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" class="form-control room-price-display" readonly value="₱0.00">
                                </div>
                                <div class="col-6 col-md-4 col-lg-1">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control room-subtotal fw-bold" readonly value="₱0.00">
                                </div>
                            </div>
                        </div>
                        <?php $room_index = 1; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-calculator"></i> Booking Summary</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <label class="form-label">Total Packages</label>
                        <div class="summary-value" id="total-rooms-display">0</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <label class="form-label">Total Guests</label>
                        <div class="summary-value" id="total-guests-display">0</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label class="form-label">Earliest Check-In</label>
                        <div class="summary-value" id="earliest-checkin-display">-</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label class="form-label">Latest Check-Out</label>
                        <div class="summary-value" id="latest-checkout-display">-</div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-2">
                        <label class="form-label">Total Amount</label>
                        <div class="summary-value total-amount" id="total-amount-display">₱<?php echo isset($booking->total_amount) ? number_format($booking->total_amount, 2) : '0.00'; ?></div>
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Booking Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" <?php echo set_select('status', 'pending', $booking->status == 'pending'); ?>>Pending</option>
                            <option value="confirmed" <?php echo set_select('status', 'confirmed', $booking->status == 'confirmed'); ?>>Confirmed</option>
                            <option value="cancelled" <?php echo set_select('status', 'cancelled', $booking->status == 'cancelled'); ?>>Cancelled</option>
                            <option value="completed" <?php echo set_select('status', 'completed', $booking->status == 'completed'); ?>>Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-sticky"></i> Additional Notes</span>
            </div>
            <div class="card-body">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any special requests, payment method, or additional information..."><?php echo set_value('notes', $booking->notes); ?></textarea>
            </div>
        </div>

        <input type="hidden" id="room_id" name="room_id" value="<?php echo (int) $booking->room_id; ?>">
        <input type="hidden" id="rooms" name="rooms" value="<?php echo isset($booking->rooms) ? (int) $booking->rooms : 1; ?>">
        <input type="hidden" id="check_in" name="check_in" value="<?php echo htmlspecialchars($booking->check_in); ?>">
        <input type="hidden" id="check_out" name="check_out" value="<?php echo htmlspecialchars($booking->check_out); ?>">
        <input type="hidden" id="guests" name="guests" value="<?php echo (int) $booking->guests; ?>">

        <div class="sticky-actions">
            <div class="action-row d-grid gap-2 d-md-flex">
                <a href="<?php echo base_url('bookings/' . (int) $booking->id); ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Booking
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let roomIndex = <?php echo (int) $room_index; ?>;
    const roomsContainer = document.getElementById('rooms-container');
    const addRoomBtn = document.getElementById('add-room-btn');
    const packageOptionsHtml = <?php echo json_encode($package_options_html); ?>;
    const today = new Date().toISOString().split('T')[0];

    function renumberPackageRows() {
        document.querySelectorAll('.room-row').forEach(function(row, index) {
            const title = row.querySelector('.package-row-title');
            if (title) {
                title.textContent = 'Package #' + (index + 1);
            }
        });
    }

    function updateRemoveButtons() {
        const roomRows = document.querySelectorAll('.room-row');
        roomRows.forEach(function(row) {
            const removeBtn = row.querySelector('.remove-room-btn');
            if (!removeBtn) return;
            removeBtn.style.display = roomRows.length > 1 ? '' : 'none';
        });
        renumberPackageRows();
    }

    addRoomBtn.addEventListener('click', function() {
        roomIndex++;
        const newRow = document.createElement('div');
        newRow.className = 'package-row room-row';
        newRow.setAttribute('data-room-index', roomIndex);

        const firstCheckIn = document.querySelector('.room-checkin')?.value || today;
        const firstCheckOut = document.querySelector('.room-checkout')?.value || '';
        const tomorrow = firstCheckOut || (function() {
            const t = new Date(firstCheckIn);
            t.setDate(t.getDate() + 1);
            return t.toISOString().split('T')[0];
        })();

        newRow.innerHTML =
            '<div class="package-row-head">' +
                '<p class="package-row-title">Package</p>' +
                '<button type="button" class="btn btn-sm btn-outline-danger remove-room-btn"><i class="bi bi-trash"></i> Remove</button>' +
            '</div>' +
            '<div class="row g-3">' +
                '<div class="col-12 col-lg-4">' +
                    '<label class="form-label">Select Package *</label>' +
                    '<select class="form-select room-select" name="room_selections[' + roomIndex + '][room_id]" data-index="' + roomIndex + '" required>' +
                        packageOptionsHtml +
                    '</select>' +
                '</div>' +
                '<div class="col-6 col-md-4 col-lg-2">' +
                    '<label class="form-label">Check-In *</label>' +
                    '<input type="date" class="form-control room-checkin" name="room_selections[' + roomIndex + '][check_in]" value="' + firstCheckIn + '" data-index="' + roomIndex + '" required>' +
                '</div>' +
                '<div class="col-6 col-md-4 col-lg-2">' +
                    '<label class="form-label">Check-Out *</label>' +
                    '<input type="date" class="form-control room-checkout" name="room_selections[' + roomIndex + '][check_out]" value="' + tomorrow + '" data-index="' + roomIndex + '" required>' +
                '</div>' +
                '<div class="col-6 col-md-2 col-lg-1">' +
                    '<label class="form-label">Guests</label>' +
                    '<input type="number" class="form-control room-guests" name="room_selections[' + roomIndex + '][guests]" value="1" min="1" data-index="' + roomIndex + '" required>' +
                '</div>' +
                '<div class="col-6 col-md-2 col-lg-1">' +
                    '<label class="form-label">Qty</label>' +
                    '<input type="number" class="form-control room-quantity" name="room_selections[' + roomIndex + '][quantity]" value="1" min="1" data-index="' + roomIndex + '" required>' +
                '</div>' +
                '<div class="col-6 col-md-4 col-lg-1">' +
                    '<label class="form-label">Unit Price</label>' +
                    '<input type="text" class="form-control room-price-display" readonly value="₱0.00">' +
                '</div>' +
                '<div class="col-6 col-md-4 col-lg-1">' +
                    '<label class="form-label">Subtotal</label>' +
                    '<input type="text" class="form-control room-subtotal fw-bold" readonly value="₱0.00">' +
                '</div>' +
            '</div>';

        roomsContainer.appendChild(newRow);
        updateRemoveButtons();
        attachRoomRowEvents(newRow);
        calculateTotals();
    });

    roomsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-room-btn')) {
            const roomRow = e.target.closest('.room-row');
            roomRow.remove();
            updateRemoveButtons();
            calculateTotals();
        }
    });

    function attachRoomRowEvents(row) {
        const roomSelect = row.querySelector('.room-select');
        const quantityInput = row.querySelector('.room-quantity');
        const guestsInput = row.querySelector('.room-guests');
        const checkInInput = row.querySelector('.room-checkin');
        const checkOutInput = row.querySelector('.room-checkout');

        roomSelect.addEventListener('change', function() {
            calculateRoomSubtotal(row);
            calculateTotals();
        });

        quantityInput.addEventListener('input', function() {
            calculateRoomSubtotal(row);
            calculateTotals();
        });

        guestsInput.addEventListener('input', function() {
            calculateRoomSubtotal(row);
            calculateTotals();
        });

        if (checkInInput && checkOutInput) {
            checkInInput.addEventListener('change', function() {
                if (checkOutInput.value && checkOutInput.value <= checkInInput.value) {
                    const nextDay = new Date(checkInInput.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    checkOutInput.value = nextDay.toISOString().split('T')[0];
                }
                checkOutInput.setAttribute('min', checkInInput.value);
                calculateRoomSubtotal(row);
                calculateTotals();
            });

            checkOutInput.addEventListener('change', function() {
                checkOutInput.setAttribute('min', checkInInput.value);
                calculateRoomSubtotal(row);
                calculateTotals();
            });
        }
    }

    function calculateRoomSubtotal(row) {
        const roomSelect = row.querySelector('.room-select');
        const quantityInput = row.querySelector('.room-quantity');
        const checkInInput = row.querySelector('.room-checkin');
        const checkOutInput = row.querySelector('.room-checkout');
        const priceDisplay = row.querySelector('.room-price-display');
        const subtotalDisplay = row.querySelector('.room-subtotal');

        const selectedOption = roomSelect.options[roomSelect.selectedIndex];
        const quantity = parseInt(quantityInput.value, 10) || 1;
        const checkIn = checkInInput ? checkInInput.value : '';
        const checkOut = checkOutInput ? checkOutInput.value : '';

        if (!selectedOption || !selectedOption.value || !checkIn || !checkOut) {
            priceDisplay.value = '₱0.00';
            subtotalDisplay.value = '₱0.00';
            return;
        }

        const pricePerNight = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const checkInDate = new Date(checkIn);
        const checkOutDate = new Date(checkOut);
        const nights = Math.max(1, Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)));
        const subtotal = pricePerNight * nights * quantity;

        priceDisplay.value = '₱' + pricePerNight.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        subtotalDisplay.value = '₱' + subtotal.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function calculateTotals() {
        let totalRooms = 0;
        let totalGuests = 0;
        let totalAmount = 0;
        let earliestCheckIn = null;
        let latestCheckOut = null;

        document.querySelectorAll('.room-row').forEach(function(row) {
            const roomSelect = row.querySelector('.room-select');
            const quantityInput = row.querySelector('.room-quantity');
            const guestsInput = row.querySelector('.room-guests');
            const checkInInput = row.querySelector('.room-checkin');
            const checkOutInput = row.querySelector('.room-checkout');
            const subtotalDisplay = row.querySelector('.room-subtotal');

            if (roomSelect.value && checkInInput && checkOutInput && checkInInput.value && checkOutInput.value) {
                const quantity = parseInt(quantityInput.value, 10) || 1;
                const guests = parseInt(guestsInput.value, 10) || 1;
                totalRooms += quantity;
                totalGuests += guests * quantity;

                const subtotalText = subtotalDisplay.value.replace(/[₱,]/g, '');
                totalAmount += parseFloat(subtotalText) || 0;

                const checkIn = checkInInput.value;
                const checkOut = checkOutInput.value;

                if (!earliestCheckIn || checkIn < earliestCheckIn) earliestCheckIn = checkIn;
                if (!latestCheckOut || checkOut > latestCheckOut) latestCheckOut = checkOut;
            }
        });

        document.getElementById('total-rooms-display').textContent = totalRooms;
        document.getElementById('total-guests-display').textContent = totalGuests;
        document.getElementById('earliest-checkin-display').textContent = earliestCheckIn ? new Date(earliestCheckIn).toLocaleDateString() : '-';
        document.getElementById('latest-checkout-display').textContent = latestCheckOut ? new Date(latestCheckOut).toLocaleDateString() : '-';
        document.getElementById('total-amount-display').textContent = '₱' + totalAmount.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        const firstRoomSelect = document.querySelector('.room-select');
        const roomIdField = document.getElementById('room_id');
        const roomsField = document.getElementById('rooms');
        const checkInField = document.getElementById('check_in');
        const checkOutField = document.getElementById('check_out');
        const guestsField = document.getElementById('guests');

        if (firstRoomSelect && firstRoomSelect.value) {
            if (roomIdField) roomIdField.value = firstRoomSelect.value;
            if (roomsField) roomsField.value = totalRooms;
        }

        if (earliestCheckIn && checkInField) checkInField.value = earliestCheckIn;
        if (latestCheckOut && checkOutField) checkOutField.value = latestCheckOut;
        if (guestsField) guestsField.value = totalGuests || 1;
    }

    document.querySelectorAll('.room-row').forEach(function(row) {
        attachRoomRowEvents(row);
    });

    const customerSelect = document.getElementById('customer_id');
    const guestNameInput = document.getElementById('guest_name');
    const guestEmailInput = document.getElementById('guest_email');
    const guestPhoneInput = document.getElementById('guest_phone');
    const guestAddressInput = document.getElementById('guest_address');
    const guestCityInput = document.getElementById('guest_city');
    const guestProvinceInput = document.getElementById('guest_province');
    const guestCountryInput = document.getElementById('guest_country');
    const guestZipcodeInput = document.getElementById('guest_zipcode');

    if (customerSelect) {
        customerSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption && selectedOption.value && selectedOption.value !== '') {
                if (guestNameInput) guestNameInput.value = selectedOption.getAttribute('data-name') || '';
                if (guestEmailInput) guestEmailInput.value = selectedOption.getAttribute('data-email') || '';
                if (guestPhoneInput) guestPhoneInput.value = selectedOption.getAttribute('data-phone') || '';
                if (guestAddressInput) guestAddressInput.value = selectedOption.getAttribute('data-address') || '';
                if (guestCityInput) guestCityInput.value = selectedOption.getAttribute('data-city') || '';
                if (guestProvinceInput) guestProvinceInput.value = selectedOption.getAttribute('data-province') || '';
                if (guestCountryInput) guestCountryInput.value = selectedOption.getAttribute('data-country') || '';
                if (guestZipcodeInput) guestZipcodeInput.value = selectedOption.getAttribute('data-zipcode') || '';
            }
        });
    }

    updateRemoveButtons();
    document.querySelectorAll('.room-row').forEach(function(row) {
        calculateRoomSubtotal(row);
    });
    calculateTotals();
});
</script>
