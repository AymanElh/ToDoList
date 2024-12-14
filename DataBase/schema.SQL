DROP DATABASE IF EXISTS todo_list

CREATE DATABASE todo_list;
USE todo_list


-- Create tables
CREATE TABLE IF NOT EXISTS tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    task_name VARCHAR(30),
    status ENUM("To Do", "In Progress", "Done"),
    create_at DATETIME DEFAULT NOW()
)

ALTER TABLE tasks MODIFY isComplete TINYINT(1);

ALTER TABLE tasks RENAME COLUMN status TO isComplete;

UPDATE tasks SET `isComplete` = 0;