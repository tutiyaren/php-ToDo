<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    header('Location: /../user/signin.php');
    exit();
}