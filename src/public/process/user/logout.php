<?php
session_start();

use App\Logout;
require '../../../app/Logout.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    header('Location: /../user/signin.php');
    exit();
}