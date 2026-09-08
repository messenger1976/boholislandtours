(function (window, $) {
    'use strict';

    var pollTimer = null;
    var pollInFlight = false;
    var pollTick = 0;
    var lastListRevision = null;
    var updatedHintTimer = null;

    function getLiveRoot() {
        return document.getElementById('inquiries-live-root');
    }

    function seedListRevision() {
        if (lastListRevision !== null) {
            return;
        }
        var root = getLiveRoot();
        if (root && root.getAttribute('data-revision')) {
            lastListRevision = root.getAttribute('data-revision');
        }
    }

    function isLiveListPage() {
        var root = getLiveRoot();
        return !!(root && root.getAttribute('data-live-list') === '1');
    }

    function getPollUrl(withMail) {
        var url = window.INQUIRY_POLL_URL || '';
        if (!url) {
            return '';
        }
        if (withMail) {
            url += (url.indexOf('?') >= 0 ? '&' : '?') + 'mail=1';
        }

        var root = getLiveRoot();
        if (root && root.getAttribute('data-live-list') === '1') {
            var params = [
                'list=1',
                'range=' + encodeURIComponent(root.getAttribute('data-range') || 'custom'),
                'date_from=' + encodeURIComponent(root.getAttribute('data-date-from') || ''),
                'date_to=' + encodeURIComponent(root.getAttribute('data-date-to') || '')
            ];
            var status = root.getAttribute('data-status') || '';
            if (status) {
                params.push('status=' + encodeURIComponent(status));
            }
            url += (url.indexOf('?') >= 0 ? '&' : '?') + params.join('&');
        }

        return url;
    }

    function updateInquiryBadge(count) {
        var badge = document.getElementById('inquiry-menu-badge');
        if (!badge) {
            return;
        }

        count = parseInt(count, 10) || 0;
        if (count > 0) {
            badge.textContent = String(count);
            badge.style.display = '';
        } else {
            badge.style.display = 'none';
            badge.textContent = '';
        }
    }

    function escapeHtml(value) {
        return String(value == null ? '' : value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function limitText(value, max) {
        var text = String(value == null ? '' : value);
        if (text.length <= max) {
            return text;
        }
        return text.substring(0, Math.max(0, max - 3)).replace(/\s+\S*$/, '') + '...';
    }

    function statusBadgeClass(status) {
        if (status === 'new') return 'danger';
        if (status === 'guest_replied') return 'primary';
        if (status === 'read') return 'warning';
        if (status === 'replied') return 'success';
        if (status === 'closed') return 'info';
        return 'secondary';
    }

    function statusLabel(status) {
        return String(status || '')
            .replace(/_/g, ' ')
            .replace(/\b\w/g, function (ch) { return ch.toUpperCase(); });
    }

    function canDelete() {
        var root = getLiveRoot();
        return !!(root && root.getAttribute('data-can-delete') === '1');
    }

    function buildTableRow(item, index) {
        var bold = (item.status === 'new' || item.status === 'guest_replied');
        var badge = statusBadgeClass(item.status);
        var deleteUrl = item.delete_url || '';
        var deleteBtn = canDelete() && deleteUrl
            ? '<a href="' + escapeHtml(deleteUrl) + '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Delete this inquiry permanently?\');"><i class="bi bi-trash"></i></a>'
            : '';

        return '' +
            '<tr class="inquiry-row-link"' +
                ' data-href="' + escapeHtml(item.url) + '"' +
                ' data-name="' + escapeHtml(item.name) + '"' +
                ' data-email="' + escapeHtml(item.email) + '"' +
                ' data-subject="' + escapeHtml(item.subject) + '"' +
                ' data-status="' + escapeHtml(item.status) + '"' +
                ' data-date="' + escapeHtml(item.date_display) + '"' +
                ' data-delete-url="' + escapeHtml(canDelete() ? deleteUrl : '') + '"' +
                ' style="cursor:pointer;' + (bold ? 'font-weight:600;' : '') + '">' +
                '<td>' + index + '</td>' +
                '<td>' + escapeHtml(item.name) + '</td>' +
                '<td>' + escapeHtml(item.email) + '</td>' +
                '<td>' + escapeHtml(limitText(item.subject, 40)) + '</td>' +
                '<td><span class="badge bg-' + badge + '">' + escapeHtml(statusLabel(item.status)) + '</span></td>' +
                '<td>' + escapeHtml(item.date_display) + '</td>' +
                '<td class="inquiry-row-actions" onclick="event.stopPropagation();">' +
                    '<a href="' + escapeHtml(item.url) + '" class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i></a> ' +
                    deleteBtn +
                '</td>' +
            '</tr>';
    }

    function buildMobileCardFromRow(row) {
        var href = row.getAttribute('data-href') || '';
        var name = row.getAttribute('data-name') || '';
        var email = row.getAttribute('data-email') || '';
        var subject = row.getAttribute('data-subject') || '';
        var status = row.getAttribute('data-status') || '';
        var dateDisplay = row.getAttribute('data-date') || '';
        var deleteUrl = row.getAttribute('data-delete-url') || '';
        var bold = (status === 'new' || status === 'guest_replied');
        var badge = statusBadgeClass(status);
        var deleteBtn = canDelete() && deleteUrl
            ? '<a href="' + escapeHtml(deleteUrl) + '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Delete this inquiry permanently?\');"><i class="bi bi-trash"></i> Delete</a>'
            : '';

        return '' +
            '<div class="mob-list-card inquiry-row-link" data-href="' + escapeHtml(href) + '" style="cursor:pointer;' + (bold ? 'font-weight:600;' : '') + '">' +
                '<div class="mob-list-card-header">' +
                    '<div class="min-w-0 flex-grow-1">' +
                        '<div class="mob-list-card-title">' + escapeHtml(subject) + '</div>' +
                        '<div class="mob-list-card-meta">' + escapeHtml(name) + ' &middot; ' + escapeHtml(email) + '</div>' +
                    '</div>' +
                    '<span class="badge bg-' + badge + '">' + escapeHtml(statusLabel(status)) + '</span>' +
                '</div>' +
                '<div class="mob-list-card-meta"><i class="bi bi-clock"></i> ' + escapeHtml(dateDisplay) + '</div>' +
                '<div class="mob-list-card-actions inquiry-row-actions" onclick="event.stopPropagation();">' +
                    '<a href="' + escapeHtml(href) + '" class="btn btn-sm btn-primary" title="View"><i class="bi bi-eye"></i> View</a> ' +
                    deleteBtn +
                '</div>' +
            '</div>';
    }

    function bindCardClicks() {
        var cards = document.querySelectorAll('#inquiries-live-cards .inquiry-row-link');
        Array.prototype.forEach.call(cards, function (row) {
            row.onclick = function () {
                var href = row.getAttribute('data-href');
                if (href) {
                    window.location = href;
                }
            };
        });
    }

    function syncInquiryCardsFromDataTable(api) {
        var cards = document.getElementById('inquiries-live-cards');
        if (!cards || !api) {
            return;
        }

        var pageRows = api.rows({ page: 'current', search: 'applied' }).nodes().toArray();
        var usable = pageRows.filter(function (row) {
            return row && !row.querySelector('td[colspan]');
        });

        if (!usable.length) {
            cards.innerHTML = '<div class="mob-list-card text-center text-muted py-4">No inquiries found</div>';
            return;
        }

        cards.innerHTML = usable.map(buildMobileCardFromRow).join('');
        bindCardClicks();
    }

    function placeInquiryCardsHost($table) {
        var $cards = $('#inquiries-live-cards');
        if (!$cards.length || !$table.length) {
            return;
        }
        $cards.insertAfter($table);
    }

    function getInquiryDataTableOptions() {
        return {
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            order: [[0, 'asc']],
            responsive: false,
            autoWidth: false,
            language: {
                search: 'Search:',
                lengthMenu: 'Show _MENU_ entries',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                emptyTable: 'No inquiries found',
                zeroRecords: 'No matching inquiries'
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function () {
                syncInquiryCardsFromDataTable(this.api());
            }
        };
    }

    function initInquiriesDataTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return null;
        }

        var $table = $('#inquiriesTable');
        if (!$table.length) {
            return null;
        }

        if ($.fn.DataTable.isDataTable($table)) {
            var existing = $table.DataTable();
            placeInquiryCardsHost($table);
            syncInquiryCardsFromDataTable(existing);
            return existing;
        }

        if ($table.find('thead th').length === 0) {
            return null;
        }

        var tbodyRows = $table.find('tbody tr');
        if (tbodyRows.length === 0) {
            return null;
        }

        var hasOnlyEmpty = tbodyRows.length === 1 && tbodyRows.find('td[colspan]').length > 0;
        if (hasOnlyEmpty) {
            var cards = document.getElementById('inquiries-live-cards');
            if (cards) {
                cards.innerHTML = '<div class="mob-list-card text-center text-muted py-4">No inquiries found</div>';
            }
            return null;
        }

        try {
            var dt = $table.DataTable(getInquiryDataTableOptions());
            placeInquiryCardsHost($table);
            syncInquiryCardsFromDataTable(dt);

            $table.on('click', 'tr.inquiry-row-link', function (e) {
                if ($(e.target).closest('.inquiry-row-actions').length) {
                    return;
                }
                var href = this.getAttribute('data-href');
                if (href) {
                    window.location = href;
                }
            });

            return dt;
        } catch (e) {
            console.warn('Inquiry DataTable init failed', e);
            return null;
        }
    }

    function destroyInquiryDataTable() {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return null;
        }
        var $table = $('#inquiriesTable');
        if ($table.length && $.fn.DataTable.isDataTable($table)) {
            return $table.DataTable();
        }
        return null;
    }

    function reinitInquiryDataTable() {
        initInquiriesDataTable();
    }

    function refreshInquiryTableRows(inquiries) {
        var dt = destroyInquiryDataTable();
        var htmlRows = inquiries.length
            ? inquiries.map(function (item, idx) { return buildTableRow(item, idx + 1); }).join('')
            : '<tr><td colspan="7" class="text-center text-muted">No inquiries found</td></tr>';

        if (dt) {
            dt.clear();
            if (inquiries.length) {
                inquiries.forEach(function (item, idx) {
                    dt.row.add($(buildTableRow(item, idx + 1)));
                });
            }
            dt.draw(false);
            placeInquiryCardsHost($('#inquiriesTable'));
            return;
        }

        var tbody = document.getElementById('inquiries-live-tbody');
        if (tbody) {
            tbody.innerHTML = htmlRows;
        }
        reinitInquiryDataTable();
    }

    function showUpdatedHint(message) {
        var hint = document.getElementById('inquiries-live-updated');
        if (!hint) {
            return;
        }
        hint.textContent = message || 'Updated just now';
        hint.style.display = '';
        if (updatedHintTimer) {
            clearTimeout(updatedHintTimer);
        }
        updatedHintTimer = setTimeout(function () {
            hint.style.display = 'none';
        }, 4000);
    }

    function updateStatusCounts(counts) {
        if (!counts) {
            return;
        }
        Object.keys(counts).forEach(function (key) {
            var nodes = document.querySelectorAll('#inquiries-status-chips [data-count="' + key + '"]');
            Array.prototype.forEach.call(nodes, function (node) {
                node.textContent = String(parseInt(counts[key], 10) || 0);
            });
        });

        var total = document.getElementById('inquiries-live-count');
        if (total && typeof counts.all !== 'undefined') {
            total.textContent = String(parseInt(counts.all, 10) || 0);
        }
    }

    function refreshInquiryList(data) {
        if (!isLiveListPage() || !data || !data.list) {
            return;
        }

        seedListRevision();

        if (lastListRevision === null) {
            lastListRevision = data.revision || '';
            return;
        }

        if (data.revision && data.revision === lastListRevision) {
            return;
        }

        lastListRevision = data.revision || lastListRevision;

        var root = getLiveRoot();
        if (root && data.revision) {
            root.setAttribute('data-revision', data.revision);
        }

        var inquiries = Array.isArray(data.inquiries) ? data.inquiries : [];
        var latest = document.getElementById('inquiries-live-latest');

        refreshInquiryTableRows(inquiries);

        if (latest && data.latest_label) {
            latest.textContent = data.latest_label;
        }

        updateStatusCounts(data.counts);

        var imported = parseInt(data.imported, 10) || 0;
        if (imported > 0) {
            showUpdatedHint(imported === 1 ? '1 new email reply imported' : (imported + ' new email replies imported'));
        } else {
            showUpdatedHint('List updated');
        }
    }

    function handlePollResponse(data) {
        if (data && typeof data.count !== 'undefined') {
            updateInquiryBadge(data.count);
        }
        refreshInquiryList(data);
    }

    function pollWithFetch(url) {
        return fetch(url, {
            method: 'GET',
            credentials: 'same-origin',
            cache: 'no-store',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('Poll failed');
            }
            return response.json();
        }).then(handlePollResponse).catch(function () {
            /* silent - keep UI responsive */
        });
    }

    function pollWithJquery(url) {
        return $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            cache: false,
            timeout: 20000
        }).done(handlePollResponse).fail(function () {
            /* silent - keep UI responsive */
        });
    }

    function pollInquiries() {
        if (pollInFlight || !document.getElementById('inquiry-menu-badge')) {
            return;
        }

        pollTick += 1;
        var checkMail = (pollTick % 6 === 0);
        var url = getPollUrl(checkMail);
        if (!url) {
            return;
        }

        pollInFlight = true;
        if ($ && $.ajax) {
            pollWithJquery(url).always(function () {
                pollInFlight = false;
            });
            return;
        }

        pollWithFetch(url).finally(function () {
            pollInFlight = false;
        });
    }

    function startInquiryPolling() {
        if (!document.getElementById('inquiry-menu-badge') || !getPollUrl(false)) {
            return;
        }

        seedListRevision();
        pollInquiries();
        if (pollTimer) {
            clearInterval(pollTimer);
        }
        pollTimer = setInterval(pollInquiries, 5000);
    }

    window.initInquiriesDataTable = initInquiriesDataTable;
    window.syncInquiryCardsFromDataTable = function () {
        if (!$ || !$.fn || !$.fn.DataTable) {
            return;
        }
        var $table = $('#inquiriesTable');
        if ($table.length && $.fn.DataTable.isDataTable($table)) {
            syncInquiryCardsFromDataTable($table.DataTable());
        }
    };

    if ($) {
        $(function () {
            if (isLiveListPage()) {
                initInquiriesDataTable();
            }
            startInquiryPolling();
        });
    } else if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startInquiryPolling);
    } else {
        startInquiryPolling();
    }

    window.addEventListener('beforeunload', function () {
        if (pollTimer) {
            clearInterval(pollTimer);
        }
    });
})(window, window.jQuery);
