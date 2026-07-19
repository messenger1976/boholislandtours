<?php
$pageTitle = 'Shopping Cart | Bohol Island Tours';
$pageDescription = 'Review your selected rooms and services.';
$includeApiConfig = true;
include __DIR__ . '/includes/head.php';
?>
<body>
<?php include __DIR__ . '/header.php'; ?>

<section class="page-hero" style="background-image:url('images/panglao-beach.jpg'); min-height:30vh;">
    <div class="container">
        <h1>Shopping Cart</h1>
        <p class="lead mb-0 opacity-90">Review your selected rooms and services</p>
    </div>
</section>

<main class="section">
    <div class="container">
        <div class="steps-indicator">
            <div class="step done"><i class="bi bi-check-lg"></i> Select</div>
            <div class="step active"><i class="bi bi-cart"></i> Cart</div>
            <div class="step"><i class="bi bi-credit-card"></i> Checkout</div>
            <div class="step"><i class="bi bi-check-circle"></i> Confirm</div>
        </div>

        <div id="cart-container">
            <div id="empty-cart-message" class="cart-empty" style="display:none;">
                <i class="bi bi-cart-x display-3 text-muted d-block mb-3"></i>
                <h2>Your cart is empty</h2>
                <p class="text-muted mb-4">Start adding rooms to your cart to continue.</p>
                <a href="rooms.php" class="btn btn-primary cta-button">Browse Rooms</a>
            </div>

            <div id="cart-items-container" style="display:none;">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cart-items"></div>

                        <div class="cart-services-section card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h3 class="h5 mb-3">Extra Services</h3>
                                <div class="services-grid row g-3">
                                    <div class="col-md-4">
                                        <div class="service-item-cart form-check p-3 border rounded-3 h-100">
                                            <input type="checkbox" class="form-check-input" id="service-pet" data-name="Pet-Friendly Amenities" data-cost="500" onchange="updateCartServices()">
                                            <label class="form-check-label" for="service-pet">
                                                <strong>Pet-Friendly Amenities</strong><br><span class="text-muted small">₱500 / stay</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-item-cart form-check p-3 border rounded-3 h-100">
                                            <input type="checkbox" class="form-check-input" id="service-spa" data-name="Spa Services" data-cost="1000" onchange="updateCartServices()">
                                            <label class="form-check-label" for="service-spa">
                                                <strong>Spa Services</strong><br><span class="text-muted small">₱1,000 / person</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-item-cart form-check p-3 border rounded-3 h-100">
                                            <input type="checkbox" class="form-check-input" id="service-laundry" data-name="Laundry and Cleaning" data-cost="250" onchange="updateCartServices()">
                                            <label class="form-check-label" for="service-laundry">
                                                <strong>Laundry and Cleaning</strong><br><span class="text-muted small">₱250 / stay</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="services-total" class="mt-3 pt-3 border-top">
                                    <strong>Services Total: <span id="services-total-amount">₱0.00</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <div class="summary-card sticky-top" style="top:calc(var(--header-height) + 1rem);">
                                <h3 class="h5 mb-3">Order Summary</h3>
                                <div class="d-flex justify-content-between mb-2 summary-row"><span>Rooms Subtotal</span><span id="cart-subtotal">₱0.00</span></div>
                                <div class="d-flex justify-content-between mb-2 summary-row"><span>Services</span><span id="cart-services-total">₱0.00</span></div>
                                <div class="d-flex justify-content-between mb-2 summary-row"><span>Total Items</span><span id="cart-item-count">0</span></div>
                                <hr>
                                <div class="d-flex justify-content-between summary-total-row mb-3"><span class="fw-bold">Total</span><strong id="cart-total" class="text-primary fs-5">₱0.00</strong></div>
                                <a href="checkout.php" class="btn btn-accent w-100 cta-button mb-2">Proceed to Checkout</a>
                                <a href="rooms.php" class="btn btn-outline-primary w-100 cta-button-secondary">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
<?php
$includeApiConfig = true;
$extraScripts = <<<'JS'
<script>
function loadCartItems() {
    const cart = getCart();
    const cartItemsContainer = document.querySelector('.cart-items');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const cartItemsDiv = document.getElementById('cart-items-container');
    if (!cart || cart.length === 0) {
        emptyCartMessage.style.display = 'block';
        cartItemsDiv.style.display = 'none';
        return;
    }
    emptyCartMessage.style.display = 'none';
    cartItemsDiv.style.display = 'block';
    cartItemsContainer.innerHTML = '';
    cart.forEach(item => cartItemsContainer.appendChild(createCartItemElement(item)));
    updateCartSummary();
}
function createCartItemElement(item) {
    const div = document.createElement('div');
    div.className = 'cart-item cart-item-card card border-0 mb-3';
    div.dataset.cartId = item.cartId;
    div.innerHTML = `
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-3 cart-item-image"><img src="${item.imageUrl}" alt="${item.roomName}" class="img-fluid rounded-3" style="height:100px;width:100%;object-fit:cover;"></div>
                <div class="col-md-6 cart-item-details">
                    <h3 class="h5 mb-2">${item.roomName}</h3>
                    <div class="cart-item-info small text-muted">
                        <p class="mb-1"><strong>Check-in:</strong> ${formatDateDisplay(item.checkin)}</p>
                        <p class="mb-1"><strong>Check-out:</strong> ${formatDateDisplay(item.checkout)}</p>
                        <p class="mb-1"><strong>Nights:</strong> ${item.nights} · <strong>Rooms:</strong> ${item.rooms}</p>
                        <p class="mb-0"><strong>Guests:</strong> ${item.adults} Adult(s), ${item.children} Child(ren)${item.extraBeds > 0 ? ` · Extra Beds: ${item.extraBeds}` : ''}</p>
                    </div>
                </div>
                <div class="col-md-3 cart-item-price text-md-end">
                    <strong class="d-block mb-2">${item.total}</strong>
                    <button class="btn btn-sm btn-outline-danger remove-item-btn" onclick="removeCartItem('${item.cartId}')" title="Remove item"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>`;
    return div;
}
function formatDateDisplay(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}
function removeCartItem(cartId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        removeFromCart(cartId);
        loadCartItems();
    }
}
const availableServices = [
    { id: 'service-pet', name: 'Pet-Friendly Amenities', cost: 500 },
    { id: 'service-spa', name: 'Spa Services', cost: 1000 },
    { id: 'service-laundry', name: 'Laundry and Cleaning', cost: 250 }
];
function updateCartServices() {
    const selectedServices = [];
    availableServices.forEach(service => {
        const checkbox = document.getElementById(service.id);
        if (checkbox && checkbox.checked) selectedServices.push({ name: service.name, cost: service.cost });
    });
    localStorage.setItem('cartServices', JSON.stringify(selectedServices));
    const servicesTotal = selectedServices.reduce((sum, s) => sum + s.cost, 0);
    const fmt = `₱${servicesTotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    const el1 = document.getElementById('services-total-amount');
    const el2 = document.getElementById('cart-services-total');
    if (el1) el1.textContent = fmt;
    if (el2) el2.textContent = fmt;
    updateCartSummary();
}
function loadCartServices() {
    const savedServices = localStorage.getItem('cartServices');
    if (savedServices) {
        const services = JSON.parse(savedServices);
        availableServices.forEach(service => {
            const checkbox = document.getElementById(service.id);
            if (checkbox) checkbox.checked = services.some(s => s.name === service.name);
        });
    }
    updateCartServices();
}
function updateCartSummary() {
    const cart = getCart();
    const roomsSubtotal = getCartTotal();
    const savedServices = localStorage.getItem('cartServices');
    let servicesTotal = 0;
    if (savedServices) servicesTotal = JSON.parse(savedServices).reduce((sum, s) => sum + s.cost, 0);
    const total = roomsSubtotal + servicesTotal;
    document.getElementById('cart-subtotal').textContent = `₱${roomsSubtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('cart-services-total').textContent = `₱${servicesTotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('cart-item-count').textContent = cart.length;
    document.getElementById('cart-total').textContent = `₱${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
}
document.addEventListener('DOMContentLoaded', () => {
    loadCartItems();
    loadCartServices();
    if (typeof updateCartBadge === 'function') updateCartBadge();
});
</script>
JS;
include __DIR__ . '/includes/scripts.php';
?>
</body>
</html>
