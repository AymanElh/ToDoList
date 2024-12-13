<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <main class="h-screen flex justify-center items-center">
        <div class="w-4/5 lg:w-1/2 bg-gray-800 rounded-lg p-6 shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-6">To-Do List</h1>
            
            <!-- Form to add tasks -->
            <form method="POST" action="index.php" class="mb-6">
                <div class="flex items-center">
                    <input 
                        type="text" 
                        name="task" 
                        placeholder="Enter a new task ..." 
                        class="flex-1 px-4 py-2 text-gray-900 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <button 
                        name="submit-btn"
                        type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-bold rounded-r-lg hover:bg-blue-700">
                        Add
                    </button>
                </div>
            </form>

            <!-- Tasks Table -->
            <div>
                <table class="w-full text-left table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-700 text-blue-300">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Task</th>
                            <th class="px-4 py-2">Completed</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tasks -->
                        <?php
                            include("./DataBase/db.php");
                            $query = "SELECT * FROM tasks";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['task_name']}</td>";
                                echo "<td>{$row['status']}</td>";
                                echo "<td>{$row['create_at']}</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

<?php
    include("./DataBase/db.php");

    if(isset($_POST["submit-btn"])) {
        $task = $_POST["task"];
        $query = "INSERT INTO tasks (task_name, status, create_at) VALUES ('{$task}', 'ToDo', NOW())";
        
        try {
            mysqli_query($conn, $query);
            echo "Task Inserted successfully <br>";
        } catch(mysqli_sql_exception) {
            echo "Error: " . mysqli_error($conn);
        }
        
    }
?>