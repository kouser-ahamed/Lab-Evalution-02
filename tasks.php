<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $conn->query("INSERT INTO tasks (user_id, task_title, task_description) VALUES ($user_id, '$title', '$desc')");
}

if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE id=$task_id AND user_id=$user_id");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Task Manager</title>
</head>

<body>
    <h2>Welcome to Your Task Manager</h2>
    <a href="logout.php">Logout</a>


    <form method="POST">
        Title: <input type="text" name="title" required>
        Description: <input type="text" name="desc" required>
        <button type="submit" name="add">Add Task</button>
    </form>

    <h3>Your Tasks:</h3>
    <ul>
        <?php
        $result = $conn->query("SELECT * FROM tasks WHERE user_id=$user_id");
        while ($task = $result->fetch_assoc()) {
            echo "<li><b>{$task['task_title']}</b> - {$task['task_description']} 
    <a href='?delete={$task['id']}'>Delete</a></li>";
        }
        ?>
    </ul>
</body>

</html>