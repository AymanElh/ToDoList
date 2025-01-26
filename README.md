# To-Do List Application

A simple and user-friendly To-Do List application built using **PHP**, **MySQL**, and **TailwindCSS**. This project allows users to manage their daily tasks effectively by providing features such as adding new tasks, marking tasks as complete, and deleting tasks.

---

## Features

- **Add Tasks**: Users can add new tasks with a title.
- **Complete Tasks**: Mark tasks as complete with a single click.
- **Delete Tasks**: Remove tasks from the list when no longer needed.
- **Responsive Design**: The application is styled using TailwindCSS for a clean and modern UI.

---

## Technologies Used

- **PHP**: Server-side scripting for backend functionality.
- **MySQL**: Database for storing tasks.
- **TailwindCSS**: For responsive and modern styling.
- **HTML/CSS**: Structuring and styling the frontend.
- **AJAX**: For asynchronous task updates without reloading the page.

---

## Installation

Follow these steps to set up the project locally:

### Prerequisites

- **PHP 8.0+**
- **MySQL 5.7+** or compatible database
- A local server like **XAMPP** or **Laragon**
- A web browser

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/AymanElh/ToDoList.git
   cd ToDoList
   ```

2. Set up the database:
   - Create a new database called `todo_list`.
   - Import the `schema.sql` file from the `DataBase/` folder into your database.

3. Configure the database connection:
   - Open `DataBase/db.php`.
   - Update the database credentials if needed:
     ```php
     $db_sever = "localhost";
     $db_user = "root";
     $db_password = "your-password";
     $db_name = "todo_list";
     ```

4. Start your local server and navigate to the project folder:
   - Place the project in the server's root directory (e.g., `htdocs` for XAMPP).
   - Start the server and open `http://localhost/todo-list-app/public/index.php` in your browser.

---

## Project Structure

```
project/
    └── 📁DataBase
        └── schema.SQL      # Database schema
    └── 📁includes
        └── config.php      # Database connection
        └── functions.php   # Dynamic Crud functions
    └── 📁js
        └── scripts.js      # AJAX requests
    └── 📁public
        └── add.php         # Add a new task
        └── complete.php    # Mark task as complete
        └── delete.php      # Delete a task
        └── fetchTasks.php  # Fetch tasks from the database
    └── index.php
    └── README.md         # Project documentation
```

---

## Usage

### Add a New Task
1. Enter the task name in the input field.
2. Click the **Add** button.

### Mark Task as Complete
1. Click the **Complete** button next to the task.
2. The task's status will change to "Yes" under the "Completed" column.

### Delete a Task
1. Click the **Delete** button next to the task.
2. The task will be removed from the list.

---

## License

This project is licensed under the MIT License. Feel free to use, modify, and distribute it as needed.
