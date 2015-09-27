<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
} else {
    unset($_SESSION['name']);
    header("Location: login.php");
}