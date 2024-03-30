<?php
session_start();

use App\Category;
require '../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=todo', 'root', 'password');

$userId = $_SESSION['id'];
$categoryModel = new Category($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /../category/index.php');
    exit();
}

$category_id = $_POST['category_id'];
$categoryModel->deleteCategory($category_id);
header('Location: /../category/index.php');
exit();