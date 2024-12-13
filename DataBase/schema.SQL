DROP DATABASE IF EXISTS todo_list

CREATE DATABASE todo_list;
USE todo_list


-- Create tables
CREATE TABLE IF NOT EXISTS tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    task_name VARCHAR(30),
    status ENUM("To Do", "In Progress", "Done"),
    create_at DATETIME NOW()
)