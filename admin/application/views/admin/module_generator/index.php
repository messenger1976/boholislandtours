<style>
    .module-gen-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .module-gen-page .page-actions .btn {
        width: 100%;
    }

    .module-gen-page .form-section-card {
        margin-bottom: 1rem;
    }

    .module-gen-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .module-gen-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .module-gen-page .field-row {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        margin-bottom: 0.85rem;
        background: var(--surface-2, #f3f7fa);
    }

    .module-gen-page .field-row:last-child {
        margin-bottom: 0;
    }

    .module-gen-page .field-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem 1rem;
        padding-top: 0.35rem;
    }

    .module-gen-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .module-gen-page .field-row,
    body.dark-mode .module-gen-page .field-row {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    @media (min-width: 768px) {
        .module-gen-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .module-gen-page .page-actions {
            width: auto;
            grid-template-columns: auto;
        }

        .module-gen-page .page-actions .btn {
            width: auto;
        }

        .module-gen-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .module-gen-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .module-gen-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block module-gen-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-magic"></i> Module Generator
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">Generate complete CRUD modules (Controller, Model, Views) for the admin app.</p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php echo form_open('module_generator/generate', array('id' => 'module-generator-form', 'class' => 'module-generator-form')); ?>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-info-circle"></i> Module Information</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="module_name_singular" class="form-label">Module Name (Singular) *</label>
                        <input type="text" class="form-control" id="module_name_singular" name="module_name_singular"
                               placeholder="e.g., Product, Category, Invoice" required>
                        <small class="form-text text-muted">Use PascalCase (e.g., Product, Category)</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="module_name_plural" class="form-label">Module Name (Plural)</label>
                        <input type="text" class="form-control" id="module_name_plural" name="module_name_plural"
                               placeholder="Auto-generated if left empty">
                        <small class="form-text text-muted">Will auto-generate by adding 's' or 'es'</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="table_name" class="form-label">Database Table Name *</label>
                        <input type="text" class="form-control" id="table_name" name="table_name"
                               placeholder="e.g., products, categories, invoices" required>
                        <small class="form-text text-muted">Lowercase with underscores</small>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="primary_key" class="form-label">Primary Key Column</label>
                        <input type="text" class="form-control" id="primary_key" name="primary_key" value="id">
                        <small class="form-text text-muted">Default: id</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-bordered form-section-card">
            <div class="card-header">
                <span class="header-title"><i class="bi bi-table"></i> Database Fields</span>
                <button type="button" class="btn btn-sm btn-primary" onclick="addField()">
                    <i class="bi bi-plus-circle"></i> Add Field
                </button>
            </div>
            <div class="card-body">
                <div id="fields-container"></div>
                <input type="hidden" name="fields_json" id="fields_json">
            </div>
        </div>

        <div class="sticky-actions">
            <div class="action-row page-actions">
                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">Reset</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-gear"></i> Generate Module
                </button>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>

<script>
var fieldCounter = 0;
var fields = [];

var fieldTypes = [
    {value: 'text', label: 'Text'},
    {value: 'textarea', label: 'Textarea'},
    {value: 'number', label: 'Number'},
    {value: 'email', label: 'Email'},
    {value: 'date', label: 'Date'},
    {value: 'datetime', label: 'DateTime'},
    {value: 'select', label: 'Select/Dropdown'},
    {value: 'checkbox', label: 'Checkbox'},
    {value: 'radio', label: 'Radio'},
    {value: 'file', label: 'File Upload'},
    {value: 'password', label: 'Password'},
    {value: 'hidden', label: 'Hidden'}
];

function addField() {
    var container = document.getElementById('fields-container');
    var fieldId = 'field_' + fieldCounter;

    var fieldHtml =
        '<div class="field-row" id="' + fieldId + '">' +
            '<div class="row g-2">' +
                '<div class="col-12 col-sm-6 col-lg-3">' +
                    '<label class="form-label small">Field Name *</label>' +
                    '<input type="text" class="form-control form-control-sm" name="field_name[]" placeholder="e.g., name, price" required>' +
                '</div>' +
                '<div class="col-12 col-sm-6 col-lg-3">' +
                    '<label class="form-label small">Label *</label>' +
                    '<input type="text" class="form-control form-control-sm" name="field_label[]" placeholder="e.g., Product Name" required>' +
                '</div>' +
                '<div class="col-12 col-sm-6 col-lg-3">' +
                    '<label class="form-label small">Input Type</label>' +
                    '<select class="form-select form-select-sm" name="field_type[]">' +
                        fieldTypes.map(function (t) {
                            return '<option value="' + t.value + '">' + t.label + '</option>';
                        }).join('') +
                    '</select>' +
                '</div>' +
                '<div class="col-12 col-sm-6 col-lg-3">' +
                    '<label class="form-label small">DB Type</label>' +
                    '<input type="text" class="form-control form-control-sm" name="field_db_type[]" value="VARCHAR(255)" placeholder="VARCHAR(255)">' +
                '</div>' +
                '<div class="col-12">' +
                    '<label class="form-label small">Options</label>' +
                    '<div class="field-options">' +
                        '<div class="form-check">' +
                            '<input class="form-check-input" type="checkbox" name="field_required[]" value="' + fieldCounter + '">' +
                            '<label class="form-check-label small">Required</label>' +
                        '</div>' +
                        '<div class="form-check">' +
                            '<input class="form-check-input" type="checkbox" name="field_show_in_list[]" value="' + fieldCounter + '" checked>' +
                            '<label class="form-check-label small">Show in List</label>' +
                        '</div>' +
                        '<div class="form-check">' +
                            '<input class="form-check-input" type="checkbox" name="field_editable[]" value="' + fieldCounter + '" checked>' +
                            '<label class="form-check-label small">Editable</label>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-12">' +
                    '<label class="form-label small">Validation Rules</label>' +
                    '<input type="text" class="form-control form-control-sm" name="field_validation[]" placeholder="e.g., trim|min_length[3]|max_length[100]">' +
                    '<small class="form-text text-muted">Pipe-separated validation rules</small>' +
                '</div>' +
                '<div class="col-12">' +
                    '<button type="button" class="btn btn-sm btn-outline-danger w-100 w-md-auto" onclick="removeField(\'' + fieldId + '\')">' +
                        '<i class="bi bi-trash"></i> Remove Field' +
                    '</button>' +
                '</div>' +
            '</div>' +
        '</div>';

    container.insertAdjacentHTML('beforeend', fieldHtml);
    fieldCounter++;
}

function removeField(fieldId) {
    var el = document.getElementById(fieldId);
    if (el) {
        el.remove();
    }
}

function resetForm() {
    if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
        document.getElementById('module-generator-form').reset();
        document.getElementById('fields-container').innerHTML = '';
        fieldCounter = 0;
        fields = [];
        addField();
    }
}

document.getElementById('module_name_singular').addEventListener('blur', function () {
    var singular = this.value;
    var pluralField = document.getElementById('module_name_plural');
    var tableField = document.getElementById('table_name');

    if (singular && !pluralField.value) {
        if (singular.endsWith('y')) {
            pluralField.value = singular.slice(0, -1) + 'ies';
        } else if (singular.endsWith('s') || singular.endsWith('x') || singular.endsWith('ch') || singular.endsWith('sh')) {
            pluralField.value = singular + 'es';
        } else {
            pluralField.value = singular + 's';
        }
    }

    if (singular && !tableField.value) {
        var tableName = singular.replace(/([A-Z])/g, '_$1').toLowerCase().replace(/^_/, '');
        if (!tableName.endsWith('s')) {
            if (tableName.endsWith('y')) {
                tableName = tableName.slice(0, -1) + 'ies';
            } else {
                tableName = tableName + 's';
            }
        }
        tableField.value = tableName;
    }
});

document.getElementById('module-generator-form').addEventListener('submit', function (e) {
    var fieldRows = document.querySelectorAll('.field-row');
    fields = [];

    for (var i = 0; i < fieldRows.length; i++) {
        var row = fieldRows[i];
        var fieldName = row.querySelector('input[name="field_name[]"]').value;
        var fieldLabel = row.querySelector('input[name="field_label[]"]').value;

        if (!fieldName || !fieldLabel) {
            alert('Please fill in all required field information');
            e.preventDefault();
            return false;
        }

        fields.push({
            name: fieldName,
            label: fieldLabel,
            type: row.querySelector('select[name="field_type[]"]').value,
            db_type: row.querySelector('input[name="field_db_type[]"]').value || 'VARCHAR(255)',
            required: row.querySelector('input[name="field_required[]"]').checked,
            show_in_list: row.querySelector('input[name="field_show_in_list[]"]').checked,
            editable: row.querySelector('input[name="field_editable[]"]').checked,
            validation: row.querySelector('input[name="field_validation[]"]').value
        });
    }

    if (fields.length === 0) {
        alert('Please add at least one field');
        e.preventDefault();
        return false;
    }

    document.getElementById('fields_json').value = JSON.stringify(fields);
});

window.addEventListener('DOMContentLoaded', function () {
    addField();
});
</script>
