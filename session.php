<?php
session_start();

$user = $_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header("location:index.php");
    die();
}
?>