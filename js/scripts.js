function fetchTasks() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "public/fetchTasks.php");
  // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencode");

  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var tableBody = document.querySelector("tbody");
      tableBody.innerHTML = "";
      // console.log(response);
      response.forEach(function (task, index) {
        var row = document.createElement("tr");
        // console.log(row);
        row.setAttribute("data-task-id", task.id);

        var buttonText = task.isComplete ? "Completed" : "Complete";
        var buttonClass = task.isComplete ? "bg-gray-500 cursor-not-allowed" : "bg-green-500 hover:bg-green-600";
        var disabledAttr = task.isComplete ? "disabled" : "";

        row.innerHTML = `
          <td class="px-4 py-2">${task.id}</td>
          <td class="px-4 py-2">${task.task_name}</td>
          <td class="px-4 py-2">
            <span class="${
              task.isComplete ? "text-green-500" : "text-red-500"
            } font-bold">
              ${task.isComplete ? "Yes" : "No"}
            </span>
          </td>
          <td class="px-4 py-2">
            <button class="complete-btn ${buttonClass} text-white px-4 py-1 mr-2 rounded hover:bg-green-600" ${disabledAttr} onclick="completeTask(${
              task.id
            })">
              ${buttonText}
            </button>
            <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600" onclick="deleteTask(${
              task.id
            })">
              Delete
            </button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    } else {
      alert("Error fetching tasks");
    }
  };
  xhr.send();
}

window.onload = function () {
  fetchTasks();
};

function addTask() {
  document.getElementById("task-form").onsubmit = function (event) {
    event.preventDefault(); // Prevent normal form submission

    var taskInput = document.getElementById("task-input").value;

    // Check if input is empty
    if (taskInput.trim() === "") {
      alert("Please enter a task!");
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "public/add.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send task data to server
    xhr.onload = function () {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Add new task to the table dynamically
          var table = document.querySelector("tbody");
          var newRow = table.insertRow();
          newRow.innerHTML = `
                <td class="px-4 py-2">${response.id}</td>
                <td class="px-4 py-2">${response.task}</td>
                <td class="px-4 py-2"><span class="text-red-500 font-bold">No</span></td>
                <td class="px-4 py-2">
                    <button onclick="completeTask(${response.id})" class="complete-btn bg-green-500 text-white px-4 py-1 mr-2 rounded hover:bg-green-600">Complete</button>
                    <button onclick="deleteTask(${response.id})" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Delete</button>
                </td>
            `;
          document.getElementById("task-input").value = ""; // Clear input field
        } else {
          alert("Error: " + response.message);
        }
      } else {
        alert("Error submitting task!");
      }
    };
    xhr.send("task=" + encodeURIComponent(taskInput));
  };
}

function completeTask(taskId) {
  var xhr = new XMLHttpRequest();

  xhr.open("POST", "public/complete.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  // console.log(taskId);
  xhr.onload = function () {
    if (xhr.status == 200) {
      try {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {

          var taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);

          if (taskRow) {
            var status = taskRow.querySelector("td:nth-child(3)");
            console.log(status);
            status.innerHTML = '<span class="text-green-500 font-bold">Yes</span>';
            completeBtn = taskRow.querySelector(".complete-btn");
            completeBtn.disabled = true;
            completeBtn.innerHTML = "Completed";
          }
        } else {
          alert("Error " + response.message);
        }
      } catch (e) {
        alert("Error Processing response");
      }
    } else {
      alert("Error completing");
    }
  };
  xhr.send("task_id=" + taskId);
}

function deleteTask(taskId) {
  if (!confirm("Are you sure you want to delete this task?")) {
    return;
  }
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "public/delete.php?task_id=" + taskId, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      try {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          console.log(response);
          document.querySelector(`tr[data-task-id="${taskId}"]`).remove();
        } else {
          alert("Error" + response.message);
        }
      } catch (e) {
        alert(e);
      }
    }
  };
  xhr.send()
}
