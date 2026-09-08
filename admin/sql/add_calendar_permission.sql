-- Calendar module permission
-- Adds view_calendar so it appears under Roles → Assign Permissions.
-- Assigned to Super Admin, Admin, Manager, and Staff by default.

INSERT INTO `permissions` (`name`, `slug`, `description`, `module`) VALUES
('View Calendar', 'view_calendar', 'Permission to view the bookings calendar (package stays and tours)', 'calendar')
ON DUPLICATE KEY UPDATE
  `name` = VALUES(`name`),
  `description` = VALUES(`description`),
  `module` = VALUES(`module`);

-- Grant View Calendar to common roles
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT r.id, p.id
FROM `roles` r
CROSS JOIN `permissions` p
WHERE r.slug IN ('super_admin', 'admin', 'manager', 'staff')
  AND p.slug = 'view_calendar'
  AND NOT EXISTS (
    SELECT 1 FROM `role_permissions` rp
    WHERE rp.role_id = r.id
      AND rp.permission_id = p.id
  );
