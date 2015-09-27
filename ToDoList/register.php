<form action="register.php" method="post">
    <input type="text" placeholder="username" name="username"/>
    <input type="password" placeholder="password" name="pass"/>
    <input type="password" placeholder="re-enter password" name="repPass"/>
    <input type="submit" name="submit"/>
</form>

<?php
include "db.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $repPass = $_POST['repPass'];

    if (passwordsMatch($pass, $repPass) && createUser($username, $pass)) {
        if (isUserValid($username, $pass)) {
            session_start();
            $_SESSION['username'] = $username;

            header("Location: toDos.php");
        }
    } else {
        echo "Something went wrong please try again.";
    }
}

function passwordsMatch($pass, $rptPass) {
    return ($pass == $rptPass);
}