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
            <form id="task-form" class="mb-6">
                <div class="flex items-center">
                    <input
                        type="text"
                        name="task"
                        id="task-input"
                        placeholder="Enter a new task ..."
                        class="flex-1 px-4 py-2 text-gray-900 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <button
                        name="add-btn"
                        type="submit"
                        onclick="addTask()"
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="js/scripts.js"></script>
</body>

</html>