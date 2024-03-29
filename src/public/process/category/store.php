<?php
session_start();

use App\Category;
require '../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

if(empty(htmlspecialchars($_POST['name']))) {
    Category::validateCategory();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$categoyModel = new Category($pdo);
$createCategory = $categoyModel->addCategory($userId, $name);
if($createCategory !== false) {
    header('Location: /../category/index.php');
}

