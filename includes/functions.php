<?php

// Function of dynamic crud operations (insert, select, delete and update)

/**
 * Inserts a record into a specified table in the database.
 *
 * This function uses prepared statements to prevent SQL injection.
 *
 * @param mysqli $mysqli The MySQLi connection object.
 * @param string $table The name of the table where the record will be inserted.
 * @param array $data An associative array where the keys are column names and the values are the data to be inserted.
 *
 * @return int The ID of the inserted record.
 *
 * @throws Exception If there is an error in the prepared statement.
 */
function insertRecord($mysqli, $table, $data)
{
    // Use prepared statements to prevent SQL injection
    $columns = implode(',', array_keys($data));
    $values = implode(',', array_fill(0, count($data), '?'));

    $sql = "INSERT INTO $table($columns) VALUES($values)";

    $stmt = mysqli_prepare($mysqli, $sql);

    if (!$stmt) {
        die("Error in prepared statement: " . mysqli_error($mysqli));
    }

    // Bind parameters to the prepared statement
    $types = str_repeat('s', count($data));
    $params = array_values($data);
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);
    $result = mysqli_insert_id($mysqli);
    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}


/**
 * Updates a record in the specified table.
 *
 * This function uses prepared statements to prevent SQL injection.
 *
 * @param mysqli $mysqli The MySQLi connection object.
 * @param string $table The name of the table to update.
 * @param array $data An associative array of column-value pairs to update.
 * @param int $id The ID of the record to update.
 * @return bool Returns true on success or false on failure.
 */
function updateRecord($mysqli, $table, $data, $id)
{
    // Use prepared statements to prevent SQL injection
    $args = array();

    foreach ($data as $key => $value) {
        $args[] = "$key = ?";
    }

    $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";

    $stmt = mysqli_prepare($mysqli, $sql);

    if (!$stmt) {
        die("Error in prepared statement: " . mysqli_error($mysqli));
    }

    // Bind parameters to the prepared statement
    $types = str_repeat('s', count($data) + 1);
    $params = array_values($data);
    $params[] = $id;
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}

/**
 * Deletes a record from the specified table in the database.
 *
 * This function uses prepared statements to prevent SQL injection.
 *
 * @param mysqli $mysqli The MySQLi connection object.
 * @param string $table The name of the table from which to delete the record.
 * @param int $id The ID of the record to delete.
 * @return bool Returns true on success or false on failure.
 */
function deleteRecord($mysqli, $table, $id)
{
    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM $table WHERE id = ?";

    $stmt = mysqli_prepare($mysqli, $sql);

    if (!$stmt) {
        die("Error in prepared statement: " . mysqli_error($mysqli));
    }

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}

/**
 * Select records from a specified table in the database.
 *
 * This function uses prepared statements to prevent SQL injection.
 *
 * @param mysqli $mysqli The MySQLi connection object.
 * @param string $table The name of the table to select records from.
 * @param string $columns Optional. The columns to select, defaults to "*".
 * @param string|null $where Optional. The WHERE clause to filter records.
 *
 * @return mysqli_result|false The result set from the executed query, or false on failure.
 */
function selectRecords($mysqli, $table, $columns = "*", $where = null)
{
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT $columns FROM $table";

    if ($where !== null) {
        $sql .= " WHERE $where";
    }

    $stmt = mysqli_prepare($mysqli, $sql);

    if (!$stmt) {
        die("Error in prepared statement: " . mysqli_error($mysqli));
    }

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}
