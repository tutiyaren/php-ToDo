<?php
session_start();

use App\Signup;
require '../../../app/Signup.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
    $password_confirmation = htmlspecialchars($_POST['password_confirmation'], ENT_QUOTES);

    $userModel = new Signup($pdo);
    $userModel->createUser($name, $email, $password, $password_confirmation);
}
