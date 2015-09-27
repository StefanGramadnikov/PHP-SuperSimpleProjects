<?php
include 'db.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {

    $userId = getUserId($_SESSION['username']);
    $todoText = $_GET['todoText'];

    if (addTodoItem($userId, $todoText)) {
        header("Location: toDos.php");
    } else {
        echo "The item was not created. <a href='toDos.php'>Return to ToDos</a>";
    }
}