</main>
<!-- End Content -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url('assets/js/admin-layout.js?v=20260907'); ?>"></script>

<script>
    // Auto-hide flash messages after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Confirmation Modal System
    function showConfirmModal(options) {
        const {
            title = 'Confirm Action',
            message = 'Are you sure you want to proceed?',
            confirmText = 'Confirm',
            cancelText = 'Cancel',
            confirmClass = 'btn-primary',
            icon = 'bi-exclamation-triangle',
            iconClass = 'modal-icon-warning',
            onConfirm = null,
            onCancel = null
        } = options;

        const modalId = 'confirmModal_' + Date.now();
        const modalHtml = `
            <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="${modalId}Label">${title}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-confirm">
                            <div class="modal-icon ${iconClass}">
                                <i class="bi ${icon}"></i>
                            </div>
                            <p>${message}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> ${cancelText}
                            </button>
                            <button type="button" class="btn ${confirmClass} confirm-btn">
                                <i class="bi bi-check-circle"></i> ${confirmText}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        const existingModal = document.querySelector('[id^="confirmModal_"]');
        if (existingModal) {
            existingModal.remove();
        }

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modalElement = document.getElementById(modalId);
        const modal = new bootstrap.Modal(modalElement);

        const confirmBtn = modalElement.querySelector('.confirm-btn');
        confirmBtn.addEventListener('click', function() {
            modal.hide();
            if (onConfirm && typeof onConfirm === 'function') {
                onConfirm();
            }
        });

        modalElement.addEventListener('hidden.bs.modal', function() {
            if (onCancel && typeof onCancel === 'function') {
                onCancel();
            }
            this.remove();
        });

        modal.show();
    }

    function confirmDelete(message, onConfirm, onCancel) {
        showConfirmModal({
            title: 'Confirm Delete',
            message: message || 'Are you sure you want to delete this item? This action cannot be undone.',
            confirmText: 'Delete',
            cancelText: 'Cancel',
            confirmClass: 'btn-danger',
            icon: 'bi-trash',
            iconClass: 'modal-icon-danger',
            onConfirm: onConfirm,
            onCancel: onCancel
        });
    }

    function dashliteConfirm(message, title) {
        let confirmed = false;
        const modalId = 'dashliteConfirm_' + Date.now();

        const modalHtml = `
            <div class="modal fade" id="${modalId}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${title || 'Confirm'}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-confirm">
                            <div class="modal-icon modal-icon-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <p>${message}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cancel
                            </button>
                            <button type="button" class="btn btn-primary confirm-btn">
                                <i class="bi bi-check-circle"></i> Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        const modalElement = document.getElementById(modalId);
        const modal = new bootstrap.Modal(modalElement, { backdrop: 'static', keyboard: false });

        return new Promise((resolve) => {
            modalElement.querySelector('.confirm-btn').addEventListener('click', function() {
                confirmed = true;
                modal.hide();
                resolve(true);
            });

            modalElement.querySelector('.cancel-btn').addEventListener('click', function() {
                confirmed = false;
                modal.hide();
                resolve(false);
            });

            modalElement.addEventListener('hidden.bs.modal', function() {
                this.remove();
                if (!confirmed) {
                    resolve(false);
                }
            });

            modal.show();
        });
    }

    window.showConfirmModal = showConfirmModal;
    window.confirmDelete = confirmDelete;
    window.dashliteConfirm = dashliteConfirm;

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[onclick*="confirm("]').forEach(function(link) {
            const originalOnclick = link.getAttribute('onclick');
            if (originalOnclick && originalOnclick.includes('confirm(')) {
                const match = originalOnclick.match(/confirm\(['"]([^'"]+)['"]\)/);
                if (match) {
                    const message = match[1];
                    link.removeAttribute('onclick');
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const href = this.getAttribute('href');

                        dashliteConfirm(message, 'Confirm Action').then(function(result) {
                            if (result) {
                                window.location.href = href;
                            }
                        });
                    });
                }
            }
        });

        if (typeof $.fn.DataTable !== 'undefined') {
            $('.table-responsive table.table, .card-inner table.table, .table.table-hover, .table.table-sm').each(function() {
                if ($.fn.DataTable.isDataTable(this)) {
                    return;
                }

                if ($(this).closest('.modal').length > 0 || $(this).hasClass('no-datatables')) {
                    return;
                }

                const $table = $(this);

                if ($table.find('thead').length === 0) {
                    return;
                }

                if ($table.find('tbody tr th').length > 0) {
                    return;
                }

                const theadThs = $table.find('thead th');
                if (theadThs.length === 0) {
                    return;
                }

                const tbodyRows = $table.find('tbody tr');
                if (tbodyRows.length === 0) {
                    return;
                }

                let hasColspanRowsInTbody = false;
                tbodyRows.each(function() {
                    if ($(this).find('td[colspan]').length > 0 || $(this).find('th[colspan]').length > 0) {
                        hasColspanRowsInTbody = true;
                        return false;
                    }
                });

                if (hasColspanRowsInTbody) {
                    return;
                }

                let defaultSortColumn = 0;
                theadThs.each(function(index) {
                    const headerText = $(this).text().toLowerCase();
                    if (headerText.includes('id') || headerText.includes('#')) {
                        defaultSortColumn = index;
                        return false;
                    }
                });

                try {
                    $table.DataTable({
                        pageLength: 10,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        order: [[defaultSortColumn, 'desc']],
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "Showing 0 to 0 of 0 entries",
                            infoFiltered: "(filtered from _MAX_ total entries)",
                            paginate: {
                                first: "First",
                                last: "Last",
                                next: "Next",
                                previous: "Previous"
                            },
                            emptyTable: "No data available in table"
                        },
                        responsive: true,
                        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        drawCallback: function() {
                            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                                $('[data-bs-toggle="tooltip"]').each(function() {
                                    const tooltipInstance = bootstrap.Tooltip.getInstance(this);
                                    if (tooltipInstance) {
                                        tooltipInstance.dispose();
                                    }
                                    new bootstrap.Tooltip(this);
                                });
                            }
                        }
                    });
                } catch (e) {
                    console.warn('DataTables initialization failed for table:', $table[0], e);
                }
            });
        }
    });
</script>
<?php
$poll_admin_id = $this->session->userdata('admin_id');
if ($poll_admin_id && method_exists($this->Admin_model, 'has_permission') && $this->Admin_model->has_permission($poll_admin_id, 'view_inquiries')):
?>
<script>window.INQUIRY_POLL_URL = <?php echo json_encode(base_url('inquiries/poll')); ?>;</script>
<script src="<?php echo base_url('assets/js/inquiry-poll.js'); ?>"></script>
<?php endif; ?>
</body>
</html>
