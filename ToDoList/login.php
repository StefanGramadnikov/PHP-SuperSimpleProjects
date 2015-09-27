<form action="login.php" method="post">
    <input type="text" placeholder="Username" name="name"/>
    <input type="password" placeholder="Password" name="pass"/>
    <input type="submit" name="submit"/>
</form>

<a href="register.php">Register?</a>

<?php

include 'db.php';

if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $pass = $_POST['pass'];

    if (isUserValid($username, $pass)) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['id'] = getUserId($username);

        header("Location: toDos.php");
        //TODO start session and redirect
        echo 'true';
    } else {
        echo 'Username or password was invalid please try again.';
        //TODO redirect or error message
    }
}

