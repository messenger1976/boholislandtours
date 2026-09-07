<?php
$attachments_by_reply = isset($attachments_by_reply) ? $attachments_by_reply : array();
$can_delete = !empty($can_delete);
$can_edit = !empty($can_edit);

$badge = 'secondary';
if ($inquiry->status === 'new') $badge = 'danger';
elseif ($inquiry->status === 'guest_replied') $badge = 'primary';
elseif ($inquiry->status === 'read') $badge = 'warning';
elseif ($inquiry->status === 'replied') $badge = 'success';
elseif ($inquiry->status === 'closed') $badge = 'info';

$created_label = !empty($inquiry->created_at)
    ? date('F j, Y g:i A', strtotime($inquiry->created_at))
    : $inquiry->cdate;
?>

<style>
    .inquiry-view-page .page-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.65rem;
        width: 100%;
    }

    .inquiry-view-page .page-actions .btn,
    .inquiry-view-page .page-actions form {
        width: 100%;
    }

    .inquiry-view-page .page-actions .btn {
        width: 100%;
    }

    .inquiry-view-page .form-section-card {
        margin-bottom: 1rem;
    }

    .inquiry-view-page .form-section-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        font-size: 0.95rem;
    }

    .inquiry-view-page .form-section-card .card-header .header-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .inquiry-view-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.85rem;
    }

    .inquiry-view-page .detail-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: var(--muted, #64748b);
        margin-bottom: 0.25rem;
    }

    .inquiry-view-page .detail-item .value {
        color: var(--heading, #1e293b);
        font-weight: 500;
        word-break: break-word;
    }

    .inquiry-view-page .message-box,
    .inquiry-view-page .empty-thread {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.75rem;
        padding: 0.9rem 1rem;
        background: var(--surface-2, #f3f7fa);
        color: var(--text, #334155);
        white-space: pre-wrap;
        word-break: break-word;
    }

    .inquiry-view-page .empty-thread {
        text-align: center;
        color: var(--muted, #64748b);
        white-space: normal;
    }

    .inquiry-view-page .reply-bubble {
        border: 1px solid var(--card-border, #dbe4ee);
        border-radius: 0.85rem;
        padding: 1rem;
        margin-bottom: 0.85rem;
        background: var(--card-bg, #fff);
    }

    .inquiry-view-page .reply-bubble:last-child {
        margin-bottom: 0;
    }

    .inquiry-view-page .reply-bubble.is-inbound {
        background: var(--surface-2, #f3f7fa);
        border-color: rgba(25, 135, 84, 0.35);
    }

    .inquiry-view-page .reply-bubble-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 0.75rem;
    }

    .inquiry-view-page .reply-bubble-meta {
        font-size: 0.8125rem;
        color: var(--muted, #64748b);
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        align-items: center;
    }

    .inquiry-view-page .inquiry-reply-body {
        white-space: normal;
        line-height: 1.55;
        word-break: break-word;
    }

    .inquiry-view-page .inquiry-reply-body p { margin: 0 0 10px; }
    .inquiry-view-page .inquiry-reply-body p:last-child { margin-bottom: 0; }
    .inquiry-view-page .inquiry-reply-body ul,
    .inquiry-view-page .inquiry-reply-body ol { margin: 0 0 10px 18px; padding: 0; }

    .inquiry-view-page .inquiry-attachments {
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px dashed var(--card-border, #d7dde8);
    }

    .inquiry-view-page .inquiry-attachments ul {
        margin: 0.35rem 0 0;
        padding: 0;
        list-style: none;
    }

    .inquiry-view-page .inquiry-attachments li {
        margin: 0 0 6px;
    }

    .inquiry-view-page .inquiry-attachment-hint {
        color: var(--muted, #8091a7);
        font-size: 12px;
        margin-top: 6px;
    }

    .inquiry-view-page .status-actions {
        display: grid;
        gap: 0.75rem;
    }

    .inquiry-view-page .status-actions .status-form {
        display: grid;
        gap: 0.65rem;
    }

    .inquiry-view-page .sticky-actions {
        position: sticky;
        bottom: 0;
        z-index: 20;
        background: var(--card-bg, #fff);
        border-top: 1px solid var(--card-border, #dbe4ee);
        padding: 0.85rem 0;
        margin-top: 0.5rem;
    }

    html.dark-mode .inquiry-view-page .message-box,
    body.dark-mode .inquiry-view-page .message-box,
    html.dark-mode .inquiry-view-page .empty-thread,
    body.dark-mode .inquiry-view-page .empty-thread,
    html.dark-mode .inquiry-view-page .reply-bubble.is-inbound,
    body.dark-mode .inquiry-view-page .reply-bubble.is-inbound {
        background: var(--surface-2, #0f172a);
        border-color: var(--card-border, #334155);
    }

    html.dark-mode .inquiry-view-page .detail-item .value,
    body.dark-mode .inquiry-view-page .detail-item .value {
        color: var(--heading, #e2e8f0);
    }

    @media (min-width: 576px) {
        .inquiry-view-page .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .inquiry-view-page .status-actions .status-form {
            grid-template-columns: 1fr auto auto;
            align-items: end;
        }
    }

    @media (min-width: 768px) {
        .inquiry-view-page .page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .inquiry-view-page .page-actions {
            width: auto;
            grid-template-columns: auto auto;
        }

        .inquiry-view-page .page-actions,
        .inquiry-view-page .page-actions form,
        .inquiry-view-page .page-actions .btn {
            width: auto;
        }

        .inquiry-view-page .detail-grid.cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .inquiry-view-page .status-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 0.65rem;
        }

        .inquiry-view-page .sticky-actions {
            position: static;
            border-top: 0;
            padding: 0;
            background: transparent;
        }

        .inquiry-view-page .sticky-actions .action-row {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
        }

        .inquiry-view-page .sticky-actions .btn {
            width: auto;
            min-width: 8.5rem;
        }
    }
</style>

<div class="nk-block inquiry-view-page">
    <div class="nk-block-head">
        <div class="page-head">
            <div class="nk-block-head-content mb-3 mb-md-0">
                <h3 class="nk-block-title page-title">
                    <i class="bi bi-envelope-open"></i> Inquiry #<?php echo (int) $inquiry->inquiryid; ?>
                </h3>
                <div class="nk-block-des text-soft">
                    <p class="mb-0">
                        <span class="badge bg-<?php echo $badge; ?>"><?php echo ucwords(str_replace('_', ' ', $inquiry->status)); ?></span>
                        <span class="ms-2"><?php echo htmlspecialchars($created_label, ENT_QUOTES, 'UTF-8'); ?></span>
                    </p>
                </div>
            </div>
            <div class="page-actions">
                <a href="<?php echo base_url('inquiries'); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <?php if ($can_edit): ?>
                <form action="<?php echo base_url('inquiries/fetchinbound'); ?>" method="post" class="m-0">
                    <input type="hidden" name="redirect" value="inquiries/<?php echo (int) $inquiry->inquiryid; ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-repeat"></i> Check Email Replies
                    </button>
                </form>
                <?php endif; ?>
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

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-person"></i> Guest Details</span>
        </div>
        <div class="card-body">
            <div class="detail-grid cols-3">
                <div class="detail-item">
                    <label>Name</label>
                    <div class="value"><?php echo htmlspecialchars($inquiry->name, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <div class="value">
                        <a href="mailto:<?php echo htmlspecialchars($inquiry->email, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($inquiry->email, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </div>
                </div>
                <div class="detail-item">
                    <label>Subject</label>
                    <div class="value"><?php echo htmlspecialchars($inquiry->subject, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-chat-left-text"></i> Original Message</span>
        </div>
        <div class="card-body">
            <div class="message-box"><?php echo htmlspecialchars($inquiry->message, ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-sliders"></i> Manage</span>
        </div>
        <div class="card-body">
            <div class="status-actions">
                <?php if ($can_edit): ?>
                <form action="<?php echo base_url('inquiries/updatestatus'); ?>" method="post" class="status-form">
                    <input type="hidden" name="inquiryid" value="<?php echo (int) $inquiry->inquiryid; ?>">
                    <div>
                        <label for="inquiry-status" class="form-label">Status</label>
                        <select id="inquiry-status" name="status" class="form-select" required>
                            <option value="new" <?php echo $inquiry->status === 'new' ? 'selected' : ''; ?>>New</option>
                            <option value="guest_replied" <?php echo $inquiry->status === 'guest_replied' ? 'selected' : ''; ?>>Guest Replied</option>
                            <option value="read" <?php echo $inquiry->status === 'read' ? 'selected' : ''; ?>>Read</option>
                            <option value="replied" <?php echo $inquiry->status === 'replied' ? 'selected' : ''; ?>>Replied</option>
                            <option value="closed" <?php echo $inquiry->status === 'closed' ? 'selected' : ''; ?>>Closed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check2"></i> Update Status
                    </button>
                    <?php if ($can_delete): ?>
                    <a href="<?php echo base_url('inquiries/delete/' . (int) $inquiry->inquiryid); ?>"
                       class="btn btn-outline-danger"
                       onclick="return confirm('Delete this inquiry permanently?');">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                    <?php endif; ?>
                </form>
                <?php elseif ($can_delete): ?>
                <a href="<?php echo base_url('inquiries/delete/' . (int) $inquiry->inquiryid); ?>"
                   class="btn btn-outline-danger"
                   onclick="return confirm('Delete this inquiry permanently?');">
                    <i class="bi bi-trash"></i> Delete
                </a>
                <?php else: ?>
                <p class="text-muted mb-0 small">You can view this inquiry but do not have edit permissions.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-chat-dots"></i> Conversation</span>
            <span class="badge bg-secondary"><?php echo count((array) $replies); ?> reply(ies)</span>
        </div>
        <div class="card-body">
            <?php if (empty($replies)): ?>
                <div class="empty-thread">No replies yet.</div>
            <?php else: ?>
                <?php foreach ($replies as $reply): ?>
                    <?php
                    $isInbound = isset($reply->direction) && $reply->direction === 'inbound';
                    if ($isInbound) {
                        $displayName = trim($reply->sender_name ? $reply->sender_name : $inquiry->name);
                    } else {
                        $displayName = !empty($reply->admin_name) ? $reply->admin_name : 'Staff';
                    }
                    $replyAttachments = !empty($attachments_by_reply[(int) $reply->replyid])
                        ? $attachments_by_reply[(int) $reply->replyid]
                        : array();
                    ?>
                    <div class="reply-bubble <?php echo $isInbound ? 'is-inbound' : ''; ?>">
                        <div class="reply-bubble-head">
                            <strong><?php echo htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8'); ?></strong>
                            <div class="reply-bubble-meta">
                                <span><?php echo !empty($reply->created_at) ? date('M j, Y g:i A', strtotime($reply->created_at)) : $reply->cdate; ?></span>
                                <?php if ($isInbound): ?>
                                    <span class="badge bg-info">Received via Email</span>
                                <?php elseif (!(int) $reply->email_sent): ?>
                                    <span class="badge bg-warning text-dark">Email Failed</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Email Sent</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-2 small text-muted">
                            <strong>Subject:</strong> <?php echo htmlspecialchars($reply->reply_subject, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <div class="inquiry-reply-body"><?php echo format_inquiry_reply_body($reply->reply_message, $isInbound); ?></div>
                        <?php if (!empty($replyAttachments)): ?>
                            <div class="inquiry-attachments">
                                <strong>Attachments:</strong>
                                <ul>
                                    <?php foreach ($replyAttachments as $attachment): ?>
                                        <li>
                                            <a href="<?php echo base_url('inquiries/downloadattachment/' . (int) $attachment->attachmentid); ?>">
                                                <i class="bi bi-paperclip"></i>
                                                <?php echo htmlspecialchars($attachment->original_filename, ENT_QUOTES, 'UTF-8'); ?>
                                                <span class="text-muted">(<?php echo format_inquiry_file_size($attachment->file_size); ?>)</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($can_edit): ?>
    <div class="card card-bordered form-section-card">
        <div class="card-header">
            <span class="header-title"><i class="bi bi-send"></i> Send Reply</span>
        </div>
        <div class="card-body">
            <p class="text-muted small mb-3">
                Reply will be emailed to
                <strong><?php echo htmlspecialchars($inquiry->email, ENT_QUOTES, 'UTF-8'); ?></strong>
            </p>

            <form action="<?php echo base_url('inquiries/reply'); ?>" method="post" enctype="multipart/form-data" id="inquiry-reply-form">
                <input type="hidden" name="inquiryid" value="<?php echo (int) $inquiry->inquiryid; ?>">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="reply_subject">Subject *</label>
                        <input type="text" class="form-control" id="reply_subject" name="reply_subject"
                               value="Re: <?php echo htmlspecialchars($inquiry->subject, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="reply_message">Message *</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="8" required placeholder="Type your reply..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="reply_attachments">Attachments</label>
                        <input type="file" class="form-control" id="reply_attachments" name="attachments[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.jpg,.jpeg,.png">
                        <p class="inquiry-attachment-hint mb-0">Up to 5 files, 10 MB each, 20 MB total. Allowed: PDF, Word, Excel, TXT, JPG, PNG.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="sticky-actions">
        <div class="action-row d-grid gap-2 d-md-flex">
            <a href="<?php echo base_url('inquiries'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Inbox
            </a>
            <button type="submit" form="inquiry-reply-form" class="btn btn-primary">
                <i class="bi bi-send"></i> Send Reply
            </button>
        </div>
    </div>
    <?php else: ?>
    <div class="sticky-actions">
        <div class="action-row d-grid gap-2 d-md-flex">
            <a href="<?php echo base_url('inquiries'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Inbox
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>
