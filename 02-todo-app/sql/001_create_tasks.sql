USE todo_app;

CREATE TABLE IF NOT EXISTS tasks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    description TEXT NULL,
    priority ENUM('low','medium','high') NOT NULL DEFAULT 'medium',
    status ENUM('pending','completed') NOT NULL DEFAULT 'pending',
    due_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_tasks_status (status),
    INDEX idx_tasks_due_date (due_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tasks (title, description, priority, status, due_date)
VALUES
('Review assessment requirements', 'Check all folders and submission instructions.', 'high', 'completed', NULL),
('Complete CRUD application', 'Test create, read, update and delete actions.', 'high', 'pending', DATE_ADD(CURDATE(), INTERVAL 3 DAY)),
('Upload project to GitHub', 'Add repository description and screenshots.', 'medium', 'pending', DATE_ADD(CURDATE(), INTERVAL 7 DAY));
