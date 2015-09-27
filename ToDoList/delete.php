<?php
include 'db.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $todoId = $_GET['todo_id'];
    $userId = getUserId($_SESSION['username']);

    if (deleteTodoItem($userId, $todoId)) {
        header("Location: toDos.php");
    } else {
        echo "The item was not deleted. <a href='toDos.php'>Return to ToDos</a>";

    }

}