<?php
$pageTitle = 'Rooms - Stay in Bohol | Bohol Island Tours';
$pageDescription = 'Browse comfortable rooms and suites available for your Bohol stay.';
$includeApiConfig = true;
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg');">
    <div class="container">
        <h1>Our Rooms</h1>
        <p class="lead mb-0 opacity-90">Find the perfect space for your stay</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div id="availability-banner" class="alert alert-info border-0 shadow-sm mb-4" style="display:none;">
            <h5 class="alert-heading text-primary">Availability Results</h5>
            <p id="availability-message" class="mb-1"></p>
            <p id="availability-dates" class="small text-muted mb-0"></p>
        </div>

        <div id="rooms-container" class="row g-4">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-3 text-muted">Loading rooms...</p>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$extraScripts = <<<'JS'
<script>
async function loadRooms() {
    const roomsContainer = document.getElementById('rooms-container');
    try {
        if (typeof API === 'undefined') throw new Error('API configuration not loaded');
        const response = await API.booking.getRooms();
        if (response.success && response.rooms && response.rooms.length > 0) {
            roomsContainer.innerHTML = '';
            response.rooms.forEach(room => {
                const roomCode = room.room_code || room.room_name.toLowerCase().replace(/\s+/g, '');
                const imagePath = `img/${roomCode}.jpg`;
                const priceDisplay = room.price ? `₱${parseFloat(room.price).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})} per night` : 'Price on request';
                const capacityText = room.capacity ? `Good for ${room.capacity} person${room.capacity > 1 ? 's' : ''}` : 'Capacity varies';
                const amenitiesText = room.amenities || 'Complimentary Wifi, Television, Private Bathroom';
                const description = room.description || `${room.room_name} offers a comfortable and well-appointed space for your stay.`;
                const col = document.createElement('div');
                col.className = 'col-md-6 col-lg-4';
                col.innerHTML = `
                    <div class="card room-card-modern room-detail-card h-100">
                        <img src="${imagePath}" class="card-img-top" alt="${room.room_name}" onerror="this.src='img/default-room.jpg'" style="height:220px;object-fit:cover;">
                        <div class="card-body room-info d-flex flex-column">
                            <h5 class="card-title">${room.room_name || 'Room'}</h5>
                            <p class="room-price text-primary fw-bold">${priceDisplay}</p>
                            <p class="card-text small text-muted">${description}</p>
                            <ul class="small text-muted flex-grow-1">
                                <li><strong>Capacity:</strong> ${capacityText}</li>
                                <li><strong>Bed Type:</strong> Normal Beds</li>
                                <li><strong>Services:</strong> ${amenitiesText}</li>
                            </ul>
                            <a href="room-detail.php?room=${roomCode}" class="btn btn-primary cta-button mt-auto">View Details</a>
                        </div>
                    </div>`;
                roomsContainer.appendChild(col);
            });
        } else {
            roomsContainer.innerHTML = '<div class="col-12 text-center py-5"><p class="text-muted">No rooms available at the moment. Please check back later.</p></div>';
        }
    } catch (error) {
        console.error('Error loading rooms:', error);
        roomsContainer.innerHTML = '<div class="col-12 text-center py-5"><p class="text-danger">Unable to load rooms. Please refresh the page.</p></div>';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadRooms();
    const availabilityBanner = document.getElementById('availability-banner');
    const availabilityMessage = document.getElementById('availability-message');
    const availabilityDates = document.getElementById('availability-dates');
    const availabilityData = localStorage.getItem('availabilityData');
    const urlParams = new URLSearchParams(window.location.search);
    if (availabilityData || (urlParams.get('checkin') && urlParams.get('checkout'))) {
        let checkIn, checkOut, guests, rooms = [];
        if (availabilityData) {
            try {
                const data = JSON.parse(availabilityData);
                checkIn = data.checkIn; checkOut = data.checkOut; guests = data.guests; rooms = data.rooms || [];
                localStorage.removeItem('availabilityData');
            } catch (e) { console.error(e); }
        } else {
            checkIn = urlParams.get('checkin'); checkOut = urlParams.get('checkout'); guests = urlParams.get('guests');
        }
        if (checkIn && checkOut) {
            const checkInDate = new Date(checkIn + 'T00:00:00');
            const checkOutDate = new Date(checkOut + 'T00:00:00');
            const fmt = { year: 'numeric', month: 'long', day: 'numeric' };
            const nights = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
            availabilityDates.textContent = `Check-in: ${checkInDate.toLocaleDateString('en-US', fmt)} | Check-out: ${checkOutDate.toLocaleDateString('en-US', fmt)} | ${nights} night${nights !== 1 ? 's' : ''} | ${guests || '2'} guest${guests !== '1' ? 's' : ''}`;
            if (rooms && rooms.length > 0) {
                availabilityMessage.innerHTML = `<strong>${rooms.length} room${rooms.length !== 1 ? 's' : ''} available:</strong> ${rooms.map(r => r.room_name || r.room_type || 'Room').join(', ')}`;
                availabilityBanner.className = 'alert alert-success border-0 shadow-sm mb-4';
            } else {
                availabilityMessage.innerHTML = '<strong>Checking availability...</strong>';
                availabilityBanner.className = 'alert alert-warning border-0 shadow-sm mb-4';
                if (urlParams.get('checkin') && typeof API !== 'undefined') {
                    API.booking.checkAvailability(checkIn, checkOut, guests).then(response => {
                        if (response.success && response.rooms) {
                            if (response.rooms.length > 0) {
                                availabilityMessage.innerHTML = `<strong>${response.rooms.length} rooms available:</strong> ${response.rooms.map(r => r.room_name || 'Room').join(', ')}`;
                                availabilityBanner.className = 'alert alert-success border-0 shadow-sm mb-4';
                            } else {
                                availabilityMessage.innerHTML = '<strong>No rooms available</strong> for the selected dates.';
                                availabilityBanner.className = 'alert alert-danger border-0 shadow-sm mb-4';
                            }
                        }
                    }).catch(() => {
                        availabilityMessage.innerHTML = '<strong>Unable to check availability.</strong>';
                        availabilityBanner.className = 'alert alert-danger border-0 shadow-sm mb-4';
                    });
                }
            }
            availabilityBanner.style.display = 'block';
        }
    }
});
</script>
JS;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
