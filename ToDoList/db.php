<?php

function connectDB() {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $conn = mysqli_connect('localhost', 'todo', '123', 'ToDo');

    return $conn;
}

function createUser($username, $password) {
    $conn = connectDB();

    if (!empty($username) && !empty($password)){

        $eUsername = mysqli_real_escape_string($conn, $username);
        $sql = "SELECT username FROM users WHERE username = '$eUsername';";

        $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysql_error());;

        if(mysqli_num_rows($query) == 0) {

            $password = md5($password);
            $sql = "INSERT INTO users VALUES ('', '$eUsername', '$password');";

            $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysql_error());

            $conn->close();

            return true;
        }
        return false;
    }
}

function getUserId($username) {
    $conn = connectDB();

    $sql = "SELECT id FROM users WHERE username = '$username';";
    $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysql_error());;
    $id = mysqli_fetch_assoc($query)['id'];

    if($query) {
        $conn->close();

        return $id;
    } else {
        return false;
    }
}

function isUserValid($username, $password) {
    $conn = connectDB();

    if (!empty($username) && !empty($password)) {
        $eUsername = mysqli_real_escape_string($conn, $username);
        $password = md5($password);

        $sql = "SELECT id FROM users WHERE username LIKE '$eUsername' AND passwordHash LIKE '$password';";
        $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysqli_error($conn));

        if (mysqli_num_rows($query) == 1) {
            $conn->close();

            return true;
        } else {
            return false;
        }

    }

}

function getTodoItems($user_id) {
    $conn = connectDB();

    $output = array();
    $sql = "SELECT todo_item, id FROM todos WHERE user_id = '$user_id';";
    $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysqli_error($conn));

    if ($query) {
        while ($todo = mysqli_fetch_assoc($query)) {
            array_push($output, $todo);
        }
        $conn->close();
        return $output;
    } else {
        return false;
    }

}

function addTodoItem($user_id, $todo_text) {
    $conn = connectDB();

    $eTodoText = mysqli_real_escape_string($conn, $todo_text);

    $sql = "SELECT id FROM users WHERE id = '$user_id';";
    $query = mysqli_query($conn, $sql) or trigger_error("Query Failed :" . mysqli_error($conn));

    if(mysqli_num_rows($query) == 1) {

        $sql = "INSERT INTO todos (user_id, todo_item) VALUES ('$user_id', '$eTodoText');";
        $query = mysqli_query($conn, $sql) or trigger_error("Query Failed :" . mysqli_error($conn));

        $conn->close();

        return true;
    } else {
        return false;
    }


}

function deleteTodoItem($user_id, $todo_id) {
    $conn = connectDB();

    $sql = "DELETE FROM todos WHERE user_id = '$user_id' AND id = '$todo_id';";
    $query = mysqli_query($conn, $sql) or trigger_error("Query Failed: " . mysqli_error($conn));

    if ($query) {
        $conn->close();
        return true;
    } else {
        return false;
    }
}