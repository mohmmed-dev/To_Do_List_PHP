-- This file contains the SQL commands to create the tables for the application.

DROP DATABASE IF EXISTS to_do_list_db;

CREATE DATABASE IF NOT EXISTS to_do_list_db;

USE to_do_list_db;

CREATE TABLE tasks (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50),
    description VARCHAR(50) UNIQUE,
    status_type INT,
    complete BOOLEAN NOT NULL DEFAULT 0,
    user_id INT NOT NULL,
    task_date DATE
);

CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(200),
    create_account DATE
);

CREATE TABLE sessions (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    token VARCHAR(200) NOT NULL,
    create_session DATE
);

ALTER TABLE tasks  ADD CONSTRAINT fk_user_task FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE sessions  ADD CONSTRAINT fk_user_session FOREIGN KEY (user_id) REFERENCES users(id);