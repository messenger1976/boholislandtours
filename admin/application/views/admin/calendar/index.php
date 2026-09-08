<?php
$summary = isset($today_summary) ? $today_summary : array(
    'check_ins' => 0,
    'check_outs' => 0,
    'in_house' => 0,
    'pending_bookings' => 0
);
$rooms = !empty($rooms) ? $rooms : array();
$can_add_bookings = !empty($can_add_bookings);
$can_view_bookings = !empty($can_view_bookings);
?>

<style>
    .calendar-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .calendar-page .page-actions .btn {
        width: 100%;
    }

    .calendar-page .form-section-card {
        margin-bottom: 1rem;
    }

    .calendar-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .calendar-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .calendar-page .stat-mini {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 0.85rem 1rem;
        background: var(--surface-2, #f3f7fa);
        height: 100%;
    }

    .calendar-page .stat-mini .label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .calendar-page .stat-mini .value {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--heading, #1e293b);
    }

    .calendar-page .legend-badge {
        width: 1rem;
        height: 1rem;
        border-radius: 0.25rem;
        display: inline-block;
        flex-shrink: 0;
    }

    .calendar-page .legend-success { background: #16a34a; }
    .calendar-page .legend-warning { background: #d97706; }
    .calendar-page .legend-info { background: #0ea5e9; }
    .calendar-page .legend-danger { background: #dc2626; }
    .calendar-page .legend-secondary { background: #64748b; }

    /* Modal is outside .calendar-page — style it directly */
    #calendarDetailModal .booking-detail-list {
        display: grid;
        gap: 0.75rem;
    }

    #calendarDetailModal .booking-detail-item {
        display: grid;
        gap: 0.2rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--card-border, #e2e8f0);
    }

    #calendarDetailModal .booking-detail-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    #calendarDetailModal .booking-detail-item .detail-label {
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
    }

    #calendarDetailModal .booking-detail-item .detail-value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    html.dark-mode #calendarDetailModal .booking-detail-item .detail-value,
    body.dark-mode #calendarDetailModal .booking-detail-item .detail-value {
        color: var(--heading, #e2e8f0);
    }

    html.dark-mode #calendarDetailModal .booking-detail-item,
    body.dark-mode #calendarDetailModal .booking-detail-item {
        border-color: var(--card-border, #334155);
    }

    #hotel-calendar {
        min-height: 520px;
    }

    .fc-event.cal-status-confirmed {
        background-color: #16a34a !important;
        border-color: #15803d !important;
    }

    .fc-event.cal-status-pending {
        background-color: #d97706 !important;
        border-color: #b45309 !important;
    }

    .fc-event.cal-status-checked_in {
        background-color: #0ea5e9 !important;
        border-color: #0284c7 !important;
    }

    .fc-event.cal-status-checked_out,
    .fc-event.cal-status-completed {
        background-color: #6366f1 !important;
        border-color: #4f46e5 !important;
    }

    .fc-event.cal-status-cancelled {
        background-color: #dc2626 !important;
        border-color: #b91c1c !important;
    }

    .fc-daygrid-event.cal-timed-stay {
        border-radius: 0.35rem;
        margin: 1px 0;
    }

    html.dark-mode .calendar-page .stat-mini,
    body.dark-mode .calendar-page .stat-mini {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .calendar-page .stat-mini .value,
    body.dark-mode .calendar-page .stat-mini .value {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 768px) {
        .calendar-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .calendar-page .page-actions {
            width: auto;
            grid-template-columns: auto auto auto;
        }

        .calendar-page .page-actions .btn {
            width: auto;
        }
    }
</style>

<div class="nk-block calendar-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-calendar3"></i> Calendar
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">View package bookings and tour stays in calendar format.</p>
                </div>
            </div>
            <div class="page-actions">
                <?php if ($can_add_bookings): ?>
                <a href="<?php echo base_url('bookings/add'); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> New Booking
                </a>
                <?php endif; ?>
                <?php if ($can_view_bookings): ?>
                <a href="<?php echo base_url('rooms/calendar'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-map"></i> Availability
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3" id="calendar-summary-cards">
        <div class="col-6 col-md-3">
            <div class="stat-mini">
                <div class="label">Check-ins</div>
                <div class="value text-success" id="sum-check-ins"><?php echo (int) $summary['check_ins']; ?></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-mini">
                <div class="label">Check-outs</div>
                <div class="value text-danger" id="sum-check-outs"><?php echo (int) $summary['check_outs']; ?></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-mini">
                <div class="label">In progress</div>
                <div class="value text-primary" id="sum-in-house"><?php echo (int) $summary['in_house']; ?></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-mini">
                <div class="label">Pending</div>
                <div class="value text-warning" id="sum-pending"><?php echo (int) $summary['pending_bookings']; ?></div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-funnel"></i> Filters</span>
        </div>
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="cal-status-filter" class="form-label">Status</label>
                    <select id="cal-status-filter" class="form-select">
                        <option value="">All statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="checked_in">Checked In</option>
                        <option value="checked_out">Checked Out</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label for="cal-room-filter" class="form-label">Package</label>
                    <select id="cal-room-filter" class="form-select">
                        <option value="">All packages</option>
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo (int) $room->id; ?>">
                                <?php echo htmlspecialchars($room->room_name, ENT_QUOTES, 'UTF-8'); ?>
                                <?php if (!empty($room->room_code)): ?>
                                    (<?php echo htmlspecialchars($room->room_code, ENT_QUOTES, 'UTF-8'); ?>)
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cal-include-cancelled">
                        <label class="form-check-label" for="cal-include-cancelled">Include cancelled</label>
                    </div>
                    <button type="button" id="cal-refresh" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-info-circle"></i> Legend</span>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-6 col-md-3 d-flex align-items-center gap-2">
                    <span class="legend-badge legend-success"></span> Confirmed
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center gap-2">
                    <span class="legend-badge legend-warning"></span> Pending
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center gap-2">
                    <span class="legend-badge legend-info"></span> Checked In
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center gap-2">
                    <span class="legend-badge legend-danger"></span> Cancelled
                </div>
            </div>
            <small class="text-muted d-block mt-2">Check-in day shades from the right; checkout day shades to the left.</small>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-calendar3"></i> Booking Calendar</span>
        </div>
        <div class="card-body">
            <div id="calendar-feed-error" class="alert alert-warning" style="display:none;"></div>
            <div id="hotel-calendar"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="calendarDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarDetailTitle">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="calendarDetailBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-primary" id="calendarDetailLink">Open booking</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('hotel-calendar');
    if (!calendarEl || typeof FullCalendar === 'undefined') {
        return;
    }

    var calendarFeedUrl = <?php
        $feed_url = site_url('calendar/feed');
        $feed_path = parse_url($feed_url, PHP_URL_PATH);
        echo json_encode($feed_path ? $feed_path : '/admin/calendar/feed');
    ?>;
    var calendarSummaryUrl = <?php
        $summary_url = site_url('calendar/summary');
        $summary_path = parse_url($summary_url, PHP_URL_PATH);
        echo json_encode($summary_path ? $summary_path : '/admin/calendar/summary');
    ?>;

    var initialEvents = <?php
        $json_flags = JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
        if (defined('JSON_INVALID_UTF8_SUBSTITUTE')) {
            $json_flags |= JSON_INVALID_UTF8_SUBSTITUTE;
        }
        echo json_encode(isset($initial_calendar_events) ? array_values($initial_calendar_events) : array(), $json_flags);
    ?>;

    var statusFilter = document.getElementById('cal-status-filter');
    var roomFilter = document.getElementById('cal-room-filter');
    var includeCancelled = document.getElementById('cal-include-cancelled');
    var refreshBtn = document.getElementById('cal-refresh');
    var detailModalEl = document.getElementById('calendarDetailModal');
    var detailModal = detailModalEl ? new bootstrap.Modal(detailModalEl) : null;

    function buildFeedUrl(info) {
        var params = new URLSearchParams();
        params.set('start', info.startStr);
        params.set('end', info.endStr);
        if (statusFilter.value) {
            params.set('status', statusFilter.value);
        }
        if (roomFilter.value) {
            params.set('room_id', roomFilter.value);
        }
        if (includeCancelled.checked) {
            params.set('include_cancelled', '1');
        }
        return calendarFeedUrl + '?' + params.toString();
    }

    function formatMoney(amount) {
        return '₱' + (amount || '0.00');
    }

    function capitalize(str) {
        if (!str) return '';
        return String(str).replace(/_/g, ' ').replace(/\b\w/g, function (c) { return c.toUpperCase(); });
    }

    function decorateEvents(events) {
        return (events || []).map(function (event) {
            var next = Object.assign({}, event);
            var status = (next.extendedProps && next.extendedProps.status) ? next.extendedProps.status : '';
            if (status === 'confirmed') {
                next.backgroundColor = next.backgroundColor || '#16a34a';
                next.borderColor = next.borderColor || '#15803d';
                next.textColor = '#ffffff';
            } else if (status === 'pending') {
                next.backgroundColor = next.backgroundColor || '#d97706';
                next.borderColor = next.borderColor || '#b45309';
                next.textColor = '#ffffff';
            }
            return next;
        });
    }

    function statusBadge(status) {
        switch (status) {
            case 'confirmed': return 'success';
            case 'checked_in': return 'info';
            case 'checked_out':
            case 'completed': return 'primary';
            case 'pending': return 'warning';
            case 'cancelled': return 'danger';
            default: return 'secondary';
        }
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text == null ? '' : String(text);
        return div.innerHTML;
    }

    function formatTime12(timeStr) {
        if (!timeStr) return '';
        var parts = String(timeStr).split(':');
        var hours = parseInt(parts[0], 10);
        var minutes = parts.length > 1 ? parseInt(parts[1], 10) : 0;
        if (isNaN(hours)) return timeStr;
        if (isNaN(minutes)) minutes = 0;
        var suffix = hours >= 12 ? 'PM' : 'AM';
        var h12 = hours % 12;
        if (h12 === 0) h12 = 12;
        return h12 + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + suffix;
    }

    function showDetail(event) {
        var p = event.extendedProps || {};
        var stayHtml =
            escapeHtml(p.checkIn || '') +
            (p.checkInTime ? (' <span class="text-muted">' + escapeHtml(formatTime12(p.checkInTime)) + '</span>') : '') +
            ' → ' +
            escapeHtml(p.checkOut || '') +
            (p.checkOutTime ? (' <span class="text-muted">' + escapeHtml(formatTime12(p.checkOutTime)) + '</span>') : '');

        var body =
            '<div class="booking-detail-list">' +
                '<div class="booking-detail-item"><span class="detail-label">Guest</span><div class="detail-value"><strong>' + escapeHtml(p.guestName || '-') + '</strong></div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Booking #</span><div class="detail-value"><code>' + escapeHtml(p.bookingNumber || '-') + '</code></div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Package</span><div class="detail-value">' + escapeHtml(p.roomName || '-') +
                    (p.roomCode ? (' <span class="text-muted">(' + escapeHtml(p.roomCode) + ')</span>') : '') +
                '</div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Type</span><div class="detail-value">' + escapeHtml(p.roomType || '-') + '</div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Stay</span><div class="detail-value">' + stayHtml + '</div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Guests</span><div class="detail-value">' + (p.guests || 1) + '</div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Status</span><div class="detail-value"><span class="badge bg-' + statusBadge(p.status) + '">' + capitalize(p.status) + '</span></div></div>' +
                '<div class="booking-detail-item"><span class="detail-label">Amount</span><div class="detail-value"><strong>' + formatMoney(p.amount) + '</strong></div></div>' +
            '</div>';

        document.getElementById('calendarDetailTitle').textContent = 'Booking Details';
        document.getElementById('calendarDetailBody').innerHTML = body;
        document.getElementById('calendarDetailLink').href = p.url || '#';
        if (detailModal) {
            detailModal.show();
        }
    }

    function timeToDayPercent(timeStr) {
        if (!timeStr) return 0;
        var parts = String(timeStr).split(':');
        var hours = parseInt(parts[0], 10);
        var minutes = parts.length > 1 ? parseInt(parts[1], 10) : 0;
        if (isNaN(hours)) return 0;
        if (isNaN(minutes)) minutes = 0;
        return Math.max(0, Math.min(100, ((hours * 60 + minutes) / (24 * 60)) * 100));
    }

    function countHarnessDays(harness) {
        if (!harness || !calendarEl) return 1;
        var dayCell = calendarEl.querySelector('.fc-daygrid-day');
        if (!dayCell) return 1;
        var dayWidth = dayCell.getBoundingClientRect().width;
        var harnessWidth = harness.getBoundingClientRect().width;
        if (dayWidth < 1) return 1;
        return Math.max(1, Math.round(harnessWidth / dayWidth));
    }

    function applyPartialDayBar(info) {
        var p = info.event.extendedProps || {};
        if (p.source !== 'room') return;
        if (!info.view || String(info.view.type).indexOf('dayGrid') !== 0) return;

        var el = info.el;
        if (!el) return;

        var startPct = timeToDayPercent(p.checkInTime || '14:00');
        var endPct = timeToDayPercent(p.checkOutTime || '12:00');
        var isStart = el.classList.contains('fc-event-start');
        var isEnd = el.classList.contains('fc-event-end');
        if (!isStart && !isEnd) {
            el.style.marginLeft = '';
            el.style.width = '';
            el.style.maxWidth = '';
            return;
        }

        var harness = el.closest ? el.closest('.fc-daygrid-event-harness') : el.parentElement;
        var days = countHarnessDays(harness);
        var leftInset = isStart ? (startPct / days) : 0;
        var rightInset = isEnd ? ((100 - endPct) / days) : 0;
        var width = Math.max(100 - leftInset - rightInset, 6);

        el.style.boxSizing = 'border-box';
        el.style.marginLeft = leftInset + '%';
        el.style.width = width + '%';
        el.style.maxWidth = width + '%';
    }

    function refreshSummary(dateStr) {
        fetch(calendarSummaryUrl + '?date=' + encodeURIComponent(dateStr || '<?php echo date("Y-m-d"); ?>'), { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (!data.success || !data.summary) return;
                var s = data.summary;
                document.getElementById('sum-check-ins').textContent = s.check_ins;
                document.getElementById('sum-check-outs').textContent = s.check_outs;
                document.getElementById('sum-in-house').textContent = s.in_house;
                document.getElementById('sum-pending').textContent = s.pending_bookings;
            })
            .catch(function () {});
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        height: 'auto',
        timeZone: 'Asia/Manila',
        editable: false,
        navLinks: true,
        dayMaxEvents: true,
        nowIndicator: true,
        eventDisplay: 'block',
        displayEventTime: false,
        nextDayThreshold: '00:00:00',
        events: function (info, successCallback, failureCallback) {
            var errorEl = document.getElementById('calendar-feed-error');
            fetch(buildFeedUrl(info), { credentials: 'same-origin' })
                .then(function (response) {
                    if (response.redirected && response.url.indexOf('login') !== -1) {
                        throw new Error('Your admin session expired. Please refresh and log in again.');
                    }
                    if (!response.ok) {
                        throw new Error('Calendar feed failed (HTTP ' + response.status + ')');
                    }
                    return response.text();
                })
                .then(function (text) {
                    var data;
                    try {
                        data = JSON.parse(text);
                    } catch (parseError) {
                        throw new Error('Calendar feed returned invalid JSON.');
                    }
                    if (errorEl) {
                        errorEl.style.display = 'none';
                        errorEl.textContent = '';
                    }
                    var events = Array.isArray(data) ? data : [];
                    if (events.length === 0 && initialEvents.length > 0) {
                        events = initialEvents;
                    }
                    successCallback(decorateEvents(events));
                })
                .catch(function (err) {
                    if (errorEl) {
                        errorEl.style.display = 'block';
                        errorEl.textContent = (err && err.message) ? err.message : 'Unable to load calendar bookings.';
                    }
                    if (initialEvents.length > 0) {
                        successCallback(decorateEvents(initialEvents));
                        return;
                    }
                    failureCallback(err);
                });
        },
        eventDidMount: function (info) {
            requestAnimationFrame(function () {
                applyPartialDayBar(info);
            });
        },
        eventClick: function (info) {
            info.jsEvent.preventDefault();
            showDetail(info.event);
        },
        datesSet: function (info) {
            if (info.view.type === 'timeGridDay') {
                refreshSummary(info.startStr.substring(0, 10));
            }
        }
    });

    calendar.render();

    function refetch() {
        calendar.refetchEvents();
    }

    statusFilter.addEventListener('change', refetch);
    roomFilter.addEventListener('change', refetch);
    includeCancelled.addEventListener('change', refetch);
    refreshBtn.addEventListener('click', function () {
        refetch();
        refreshSummary('<?php echo date("Y-m-d"); ?>');
    });
});
</script>
