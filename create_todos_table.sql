CREATE TABLE `category` (
    `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `color` VARCHAR(10) NOT NULL DEFAULT '#0d6efd',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `color`) VALUES
(1, 'Personal', '#6c757d'),
(2, 'Académicas', '#dc3545'), 
(3, 'Laborales', '#ffc107'),     
(4, 'Hogar', '#28a745');

CREATE TABLE `todos` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `completed` BOOLEAN NOT NULL DEFAULT FALSE,
    `priority` ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'medium',
    `favorite` BOOLEAN NOT NULL DEFAULT FALSE, 
    `category_id` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_category_id` (`category_id`),
    KEY `idx_priority` (`priority`),
    CONSTRAINT `fk_todos_category` 
        FOREIGN KEY (`category_id`) REFERENCES `category`(`id`) 
        ON DELETE RESTRICT 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `todos` (`task`, `description`, `priority`, `favorite`, `category_id`) VALUES
('Aprender el framework', 'Estudiar la estructura MVC del proyecto', 'high', FALSE, 2),
('Crear todo list', 'Implementar funcionalidad completa', 'medium', FALSE, 3),
('Documentar código', 'Crear README con flujo de aplicación', 'low', FALSE, 3);