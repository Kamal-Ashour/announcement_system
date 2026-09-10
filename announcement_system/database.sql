-- Simple Announcement Board System (PHP & MySQL)
-- Database: announcement_db

CREATE DATABASE IF NOT EXISTS announcement_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE announcement_db;

DROP TABLE IF EXISTS announcements;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB;

CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ملاحظة:
-- في هذا المشروع، يمكنكِ تسجيل حساب عادي ثم تغيير role في جدول users الى 'admin' من phpMyAdmin.
