<form action="add.php" method="get">
    <input type="text" placeholder="todo text" name="todoText"/>
    <input type="submit" name="submit"/>
</form>

<a href="logout.php">Logout</a>

<?php
session_start();

include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $name = $_SESSION['username'];

    $toDos = getTodoItems(getUserId($name));
}

if (!empty($toDos)) {
    echo "<ul>";
    foreach ($toDos as $toDo) {
        $todoItem = $toDo['todo_item'];
        $todoId = $toDo['id'];
        echo "<li> '$todoItem'<a href='delete.php?todo_id=$todoId'>delete</a> </li>" ;
    }
    echo "</ul>";
} else {
    echo "No to do items.";
}


