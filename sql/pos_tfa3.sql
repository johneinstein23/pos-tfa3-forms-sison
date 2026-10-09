CREATE DATABASE IF NOT EXISTS pos_tfa3_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE pos_tfa3_db;

CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  avatar VARCHAR(255) NULL,
  created_at DATETIME NOT NULL
);

INSERT INTO customers (full_name, email, phone, created_at) VALUES
('Jon Snow', 'jon.snow@example.test', '09170000001', NOW()),
('Robb Stark', 'robb.stark@example.test', '09170000002', NOW()),
('Ned Stark', 'ned.stark@example.test', '09170000003', NOW()),
('Sansa Stark', 'sansa.stark@example.test', '09170000004', NOW()),
('Arya Stark', 'arya.stark@example.test', '09170000005', NOW());

INSERT INTO users (username, full_name, avatar, created_at) VALUES
('jon.snow', 'Jon Snow', NULL, NOW()),
('robb.stark', 'Robb Stark', NULL, NOW()),
('ned.stark', 'Ned Stark', NULL, NOW()),
('sansa.stark', 'Sansa Stark', NULL, NOW()),
('arya.stark', 'Arya Stark', NULL, NOW());
