<?php
session_start();

// Initialize tasks array if not already set
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle form submission to add a task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']); // Sanitize input
    $_SESSION['tasks'][] = $task;
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    if (isset($_SESSION['tasks'][$deleteIndex])) {
        unset($_SESSION['tasks'][$deleteIndex]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elvis Task Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 5px 0; }
        .delete { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Task Manager</h1>

    <form action="" method="POST">
        <input type="text" name="task" required>
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <ul>
        <?php if (empty($_SESSION['tasks'])): ?>
            <li>No tasks found</li>
        <?php else: ?>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li>
                    <?php echo htmlspecialchars($task); ?>
                    <a href="?delete=<?php echo $index; ?>" class="delete">Delete</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>
